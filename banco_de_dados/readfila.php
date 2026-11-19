<?php
include_once 'conexao.php';

//A quantidade de valor a ser exibida
$quantidade = 7;
//a pagina atual
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
//Calcula a pagina de qual valor será exibido
$inicio     = ($quantidade * $pagina) - $quantidade;

//SQL para saber o total
$sqlTotal   = "SELECT id FROM tb_filamentos";

//Monta o SQL com LIMIT para exibição dos dados  
$strsql = "select id, marca, tipo, cor, qtde_estoque,peso, valor from tb_filamentos order by marca LIMIT $inicio, $quantidade";
$querySelect = $link->query($strsql);

while ($registros = $querySelect->fetch_assoc()):

    $id = $registros['id'];
    $marca = $registros['marca'];
    $tipo = $registros['tipo'];
    $cor = $registros['cor'];
    $qtde_estoque = $registros['qtde_estoque'];
    $peso  = $registros['peso'];
    $valor = $registros['valor'];
 
    echo "<tr>";
    echo "<td>$marca</td>";
    echo "<td>$tipo</td>";
    echo "<td>$cor</td>";
    echo "<td>$qtde_estoque</td>"; 
    echo "<td>$peso</td>"; 
    echo "<td>$valor</td>"; 
  
    echo "<td><a href='editarFila.php?id=$id'><i class='material-icons'>edit</i></td>";
    //echo "<td><a href='banco_de_dados/deleteCli.php?id=$id'><i class='material-icons'>delete</i></td>";

    echo "<td><a href='../banco_de_dados/deletefila.php?id=";
    echo $id."&tabela=tb_filamentos&retorno=lista_filamentos.php' " ;
    echo ' OnClick="javascript:return confirm(\'Deseja mesmo excluir o filamento \n marca: '.$marca . ' \n tipo: ' . $tipo . ' ?\');">';
    echo "<i class='material-icons'>delete</i>";
   
    // echo " Excluir </a>";

	echo  "</td></tr>";


    echo "</tr>";
endwhile;

include_once 'paginacao.php';

 ?>   