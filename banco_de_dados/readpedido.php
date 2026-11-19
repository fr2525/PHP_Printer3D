<?php
include_once 'conexao.php';
include_once "../valida.php";

//A quantidade de valor a ser exibida
$quantidade = 5;
//a pagina atual
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
//Calcula a pagina de qual valor será exibido
$inicio     = ($quantidade * $pagina) - $quantidade;
//SQL para saber o total
$sqlTotal   = "SELECT id_venda FROM tb_pedidos";

//Monta o SQL com LIMIT para exibição dos dados  
$sql = " SELECT id_venda,a.id_cliente, b.nome,a.descricao,quantidade,preco,total_venda
        ,a.status as id_status,c.descricao as situacao,datacompra,dataprevisao,datafinaliza,dataentrega  
        FROM tb_pedidos a , tb_clientes b, tb_status c
        where a.id_cliente = b.id 
        and a.status = c.id_status 
        ORDER BY datacompra DESC LIMIT $inicio, $quantidade";

$querySelect = $link->query($sql);

while ($registros = $querySelect->fetch_assoc()):
    $id_venda  = $registros['id_venda'];
    $id_cliente  = $registros['id_cliente'];
    $nome  = $registros['nome'];
    //$id_usuario  = $registros['id_usuario'];
    $descricao  = $registros['descricao'];
    $quantidade  = $registros['quantidade'];
    $preco  = $registros['preco'];
    $total_venda = $registros['total_venda'];
 //   $status  = $registros['status'];
    $situacao  = $registros['id_status'];
    $datacompra   = data_mysql_para_user($registros['datacompra']);
    $dataprevisao  = data_mysql_para_user($registros['dataprevisao']);
    //   $data_finaliza  = $registros['data_finaliza'];
    //   $data_entrega   = $registros['data_entrega'];

    echo "<tr>";
    echo "<td>$nome</td>";
    echo "<td>$descricao</td>";
    echo "<td style='text-align: right'>$quantidade</td>";
    echo "<td style='text-align: right'>$preco</td>";
    echo "<td style='text-align: right'>$total_venda</td>";
    echo "<td style='text-align: center'>$datacompra</td>";
    echo "<td style='text-align: center'>$dataprevisao</td>";
    echo '<td><select name="situacao" id="situacao" onchange="changeFunc(this.value)">';
    echo '<option disabled>Situação </option>';
    $queryS = $link->query("select id_status, descricao from tb_situacao");
    while ($situacoes = $queryS->fetch_assoc()) :
        $id_status = $situacoes['id_status'];
        $descricao = $situacoes['descricao'];
        if ($id_status == $situacao) {  
            echo '<option selected value=' . $id_status . '>' . $descricao . '</option>'; 
        } else {
            echo '<option value=' . $id_status . '>' . $descricao . '</option>';
        }
              
    endwhile;
    echo '</select>';
    echo '<label for="situacao">Situação</label>';
    echo '</td>';
      
    echo "<td><a href='editarpedido.php?id=$id_venda'><i class='material-icons'>&nbsp&nbspedit</i></td>";
    echo "<td><a href='banco_de_dados/deleteped.php?id=";
    echo $id_venda . "&tabela=tb_pedidos&retorno=lista_pedidos.php' ";
    echo ' OnClick="javascript:return confirm(\'Deseja mesmo excluir o pedido \n no.: ' . $id_venda . '?\');">';
    echo "<i class='material-icons'>&nbsp&nbspdelete</i>";
    echo "</td></tr>";


    echo "</tr>";     
endwhile;

include_once 'paginacao.php';

?>
<script language="javascript">
function changeFunc(selectedValue) {
    alert("The selected value is: " + selectedValue);
    // You can add more code here to perform other actions
}
</script>