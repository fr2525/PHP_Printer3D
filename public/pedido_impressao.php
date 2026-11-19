<?php

include_once '../banco_de_dados/conexao.php';

// CLIENTES
$clientes = $link->query("SELECT id, nome FROM tb_clientes ORDER BY nome");

// IMPRESSORAS
$impressoras = $link->query("SELECT id, marca, modelo,qtrolos FROM tb_impressoras ORDER BY marca");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Pedido de Impressão 3D</title>

<style>
body {
    font-family: Arial;
    background: #f2f4f7;
    margin: 20px;
}
fieldset {
    background: #fff;
    border-radius: 6px;
    padding: 15px;
    border: 1px solid #ccc;
}
label { font-weight: bold; margin-top: 10px; display: block; }
input, select, textarea { width: 100%; padding: 6px; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
th, td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
}
th { background: #eee; }

.buttons {
    margin-top: 15px;
    text-align: right;
}
button {
    padding: 8px 14px;
    margin-left: 5px;
    cursor: pointer;
}

/* TREEVIEW */
.tree {
    margin-top: 15px;
    border: 1px solid #ccc;
    background: #fafafa;
    padding: 10px;
}
.tree ul {
    list-style: none;
    padding-left: 20px;
}
.tree li {
    margin: 4px 0;
}
.tree .printer {
    font-weight: bold;
}
</style>
</head>

<body>

<form method="post" action="gravar_pedido_multi.php" id="formPedido">

<fieldset>
<legend><strong>Pedido de Impressão 3D</strong></legend>

<label>Cliente</label>
<select name="cliente_id" required>
    <option value="">Selecione</option>
    <?php while ($c = $clientes->fetch_assoc()): ?>
        <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
    <?php endwhile; ?>
</select>

<label>Descrição do Projeto</label>
<textarea name="descricao" rows="3" required></textarea>

<label>Data de Início</label>
<input type="date" name="data_inicio" required>

<label>Data Prevista</label>
<input type="date" name="data_prevista" required>

<!-- ================= IMPRESSORAS ================= -->
<h3>Impressoras</h3>
<table>
<thead>
<tr>
    <th>Usar</th>
    <th>Marca</th>
    <th>Qtd Rolos</th>
</tr>
</thead>
<tbody>
<?php while ($i = $impressoras->fetch_assoc()): ?>
<tr>
    <td>
        <input type="checkbox"
               class="chkImpressora"
               value="<?= $i['id'] ?>"
               data-marca="<?= $i['marca'] ?>"
               onchange="toggleImpressora(this)">
    </td>
    <td><?= $i['marca'] ?></td>
    <td><?= $i['qtrolos'] ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<!-- ================= FILAMENTOS ================= -->
<h3>Filamentos</h3>
<table id="gridFilamentos">
<thead>
<tr>
    <th>Descrição</th>
    <th>Tipo</th>
    <th>Cor</th>
    <th>Estoque</th>
    <th>Qtd Usar</th>
</tr>
</thead>
<tbody>
<tr><td colspan="5">Selecione ao menos uma impressora</td></tr>
</tbody>
</table>

<!-- ================= TREEVIEW ================= -->
<h3>Resumo (TreeView)</h3>
<div class="tree" id="treeView">
    <em>Nenhuma impressora selecionada</em>
</div>

<div class="buttons">
    <button type="submit">💾 Gravar</button>
    <button type="button" onclick="limparFormulario()">🧹 Limpar</button>
    <button type="button" onclick="sair()">🚪 Sair</button>
</div>

</fieldset>
</form>

<script>
const gridFilamentos = document.querySelector('#gridFilamentos tbody');
const treeView = document.getElementById('treeView');

// Carrega filamentos por impressora
function toggleImpressora(chk) {

    const selecionadas = document.querySelectorAll('.chkImpressora:checked');

    if (selecionadas.length === 0) {
        gridFilamentos.innerHTML = '<tr><td colspan="5">Selecione ao menos uma impressora</td></tr>';
        treeView.innerHTML = '<em>Nenhuma impressora selecionada</em>';
        return;
    }

    gridFilamentos.innerHTML = '';

    selecionadas.forEach(chk => {
        fetch('ajax_filamentos.php?impressora_id=' + chk.value)
            .then(res => res.json())
            .then(data => {
                data.forEach(f => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${f.descricao}</td>
                        <td>${f.tipo}</td>
                        <td>${f.cor}</td>
                        <td>${f.qtde_estoque}</td>
                        <td>
                            <input type="number"
                                   min="0"
                                   max="${f.qtde_estoque}"
                                   value="0"
                                   data-impressora="${chk.value}"
                                   data-impressora-nome="${chk.dataset.marca}"
                                   data-filamento="${f.descricao}"
                                   onchange="atualizarTree()"
                                   name="filamento[${chk.value}][${f.id}]">
                        </td>
                    `;
                    gridFilamentos.appendChild(tr);
                });
            });
    });
}

// Atualiza TreeView
function atualizarTree() {

    const inputs = document.querySelectorAll('#gridFilamentos input[type=number]');
    const mapa = {};

    inputs.forEach(i => {
        const qtd = parseInt(i.value);
        if (qtd > 0) {
            const imp = i.dataset.impressoraNome;
            if (!mapa[imp]) mapa[imp] = [];
            mapa[imp].push(`${i.dataset.filamento} (${qtd})`);
        }
    });

    if (Object.keys(mapa).length === 0) {
        treeView.innerHTML = '<em>Nenhum filamento selecionado</em>';
        return;
    }

    let html = '<ul>';
    for (const imp in mapa) {
        html += `<li class="printer">${imp}<ul>`;
        mapa[imp].forEach(f => html += `<li>${f}</li>`);
        html += '</ul></li>';
    }
    html += '</ul>';

    treeView.innerHTML = html;
}

function limparFormulario() {
    document.getElementById('formPedido').reset();
    gridFilamentos.innerHTML = '<tr><td colspan="5">Selecione ao menos uma impressora</td></tr>';
    treeView.innerHTML = '<em>Nenhuma impressora selecionada</em>';
}

function sair() {
    if (confirm("Deseja sair da página?")) {
        window.location.href = 'index.php';
    }
}
</script>

</body>
</html>
