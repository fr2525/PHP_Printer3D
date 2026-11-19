<?php
include_once 'conexao.php';


$querySelect = $link->query("select id, cpf_cnpj, nome, email, celular from tb_clientes");
while ($registros = $querySelect->fetch_assoc()):

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

    echo "<td><a href='../banco_de_dados/delete.php?id=";
    echo $id . "&tabela=tb_clientes&retorno=lista_clientes.php' ";
    echo ' OnClick=" javascript:return confirm(\'Deseja mesmo excluir o cliente:\n ' . $nome . ' ?\');">';
    echo "<i class='material-icons'>delete</i>";

    // echo " Excluir </a>";

    echo "</td>
</tr>";


    echo "</tr>";
endwhile;
