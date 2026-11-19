<?php
include_once 'conexao.php';

//A quantidade de valor a ser exibida
$quantidade = 7;
//a pagina atual
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
//Calcula a pagina de qual valor será exibido
$inicio     = ($quantidade * $pagina) - $quantidade;
//SQL para saber o total
$sqlTotal   = "SELECT id FROM tb_fornecedores";

//Monta o SQL com LIMIT para exibição dos dados  
$strsql ="select id, cpf_cnpj, nome, endereco, email, celular from tb_fornecedores ORDER BY nome LIMIT $inicio, $quantidade";
//Executa o SQL
$querySelect = $link->query($strsql);

while ($registros = $querySelect->fetch_assoc()):

    $id = $registros['id'];
    $cpf_cnpj = $registros['cpf_cnpj'];
    $nome = $registros['nome'];
    $endereco = $registros['endereco'];
    $email = $registros['email'];
    $celular = $registros['celular'];

    echo "<tr>";
    echo "<td>$cpf_cnpj</td>";
    echo "<td>$nome</td>";
    echo "<td>$endereco</td>";
    echo "<td>$email</td>";
    echo "<td>$celular</td>";

    echo "<td><a href='editarFor.php?id=$id'><i class='material-icons'>edit</i></td>";
    echo "<td><a href='../banco_de_dados/deletefor.php?id=";
    echo $id . "&tabela=tb_fornecedores&retorno=../public/lista_fornece.php' ";
    echo ' OnClick=" javascript:return confirm(\'Deseja mesmo excluir o fornecedor:\n ' . $nome . ' ?\');">';
    echo "<i class='material-icons'>delete</i>";

    // echo " Excluir </a>";

    echo "</td>
</tr>";

    echo "</tr>";
endwhile;


include_once 'paginacao.php';

?>
