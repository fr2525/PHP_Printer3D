<?php
include_once 'conexao.php';

//A quantidade de valor a ser exibida
$quantidade = 7;
//a pagina atual
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
//Calcula a pagina de qual valor será exibido
$inicio     = ($quantidade * $pagina) - $quantidade;
//SQL para saber o total
$sqlTotal   = "SELECT id FROM tb_clientes";

//Monta o SQL com LIMIT para exibição dos dados  
$strsql = "select id, cpf_cnpj, nome, email, celular from tb_clientes order by nome LIMIT $inicio, $quantidade ";
//Executa o SQL
$querySelect = $link->query($strsql);

while($registros = $querySelect->fetch_assoc()) {

        $nome = $registros['nome'];
        $email = $registros['email'];
        $celular = $registros['celular'];

        $id = $registros['id'];
        $cpf_cnpj = $registros['cpf_cnpj'];
        $nome = $registros['nome'];
        $email = $registros['email'];
        $celular = $registros['celular'];

        echo "<tr>";
        echo "<td>$cpf_cnpj</td>";
        echo "<td>$nome</td>";
        echo "<td>$email</td>";
        echo "<td>$celular</td>";

        echo "<td><a href='editarCli.php?id=$id'><i class='material-icons'>edit</i></td>";

        //echo "<td><a href='banco_de_dados/deleteCli.php?id=$id'><i class='material-icons'>delete</i></td>";
        echo "<td><a href='../banco_de_dados/deletecli.php?id=";
        echo $id . "&tabela=tb_clientes&retorno=lista_clientes.php' ";
        echo ' OnClick=" javascript:return confirm(\'Deseja mesmo excluir o cliente:\n ' . $nome . ' ?\');">';
        echo "<i class='material-icons'>delete</i>";

        echo "</td></tr>";


        echo "</tr>";
}

include_once 'paginacao.php';

?>