<?php
include_once 'conexao.php';



//Monta o SQL com LIMIT para exibição dos dados  
$strsql = "select id, marca, tipo, cor, qtde_estoque,peso, valor from tb_filamentos order by marca";
$querySelect = $link->query($strsql);

while ($registros = $querySelect->fetch_assoc()):

    $id = $registros['id'];
    $marca = $registros['marca'];
    $tipo = $registros['tipo'];
    $cor = $registros['cor'];
    $qtde_estoque = $registros['qtde_estoque'];
    $peso  = $registros['peso'];
    $valor = $registros['valor'];

    $quantidade = floatval(0);
 
    echo '<tr>';
    echo '  <td>' . $id . '</td>';
    echo '  <td>' . trim($marca) . '/' . trim($tipo) . '/' . trim($cor) .  '</td>';
    echo '  <td>' . $qtde_estoque . '</td>'; 
    echo '  <td><input type="number" name="qtde" value="quantidade"></td>';
	echo '</tr>';
    
endwhile;

 ?> 
 <script language="javascript">
function changeFunc(selectedValue) {
    alert("The selected value is: " + selectedValue);
    // You can add more code here to perform other actions
}
</script>