<?php
include_once 'conexao.php';


//A quantidade de valor a ser exibida
$quantidade = 7;
//a pagina atual
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
//Calcula a pagina de qual valor será exibido
$inicio     = ($quantidade * $pagina) - $quantidade;
//SQL para saber o total
$sqlTotal   = "SELECT id FROM tb_impressoras";

$querySelect = $link->query("select id, marca, modelo,qtrolos from tb_impressoras ORDER by marca  LIMIT $inicio, $quantidade");
while ($registros = $querySelect->fetch_assoc()):
    $id = $registros['id'];
    $marca = $registros['marca'];
    $modelo = $registros['modelo'];
    $qtrolos = $registros['qtrolos'];
 
    /*
    $marca
    $tipo
    $cor
    $qtde_estoque 
    $valor 
  
*/

    echo "<tr>";
    echo "<td>$marca</td>";
    echo "<td>$modelo</td>";
    echo "<td>$qtrolos</td>";
 
    echo "<td><a href='editarimpres.php?id=$id'><i class='material-icons'>edit</i></td>";
    echo "<td><a href='../banco_de_dados/deleteimpres.php?id=";
    echo $id."&tabela=tb_impressoras&retorno=lista_impressoras.php' " ;
    echo ' OnClick="javascript:return confirm(\'Deseja mesmo excluir a impressora \n marca: '.$marca . ' \n modelo: ' . $modelo . ' ?\');">';
    echo "<i class='material-icons'>delete</i>";
   
    // echo " Excluir </a>";

	echo  "</td></tr>";


    echo "</tr>";
endwhile;

include_once 'paginacao.php';

 ?>   