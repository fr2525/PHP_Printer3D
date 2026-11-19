<?php session_start(); ?>
<!DOCTYPE html>

<?php
include_once '../includes/header.inc.php';
include_once '../includes/menu.inc.php';

include_once('../banco_de_dados/conexao.php');
include_once('../valida.php');


$impressoras = []; // Array para armazenar os dados
$querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'N'");
while ($registros = $querySelect->fetch_assoc()) :
    $impressoras[] = $registros; // Adiciona a linha ao array principal
endwhile;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$_SESSION['id'] = $id;
$str_sql = "select id_venda, id_cliente, b.nome, a.descricao,a.operador,preco,quantidade,total_venda,
                 a.id_situacao,c.descricao as situacao, datacompra,dataprevisao
                 from tb_pedidos a , tb_clientes b, tb_situacao c
                 where a.id_venda ='$id' and a.id_cliente = b.id 
                 and a.id_situacao = c.id_situacao LIMIT 1";

$querySelect = $link->query($str_sql) or die($link->error);

$registros = $querySelect->fetch_assoc();

$id_venda = $registros['id_venda'];
$id_cliente = $registros['id_cliente'];
$nome = $registros['nome'];
$projeto = $registros['descricao'];
$preco = $registros['preco'];
$quantidade = $registros['quantidade'];
$total_venda = $registros['total_venda'];
$situacao = $registros['situacao'];
$datacompra = $registros['datacompra'];
$dataprevisao = $registros['dataprevisao'];

?>

<div class="row container">
    <form action="../banco_de_dados/updatePed.php" id="formEditarPedido" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
            <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Alteração de Pedido</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <div class="row">
                <!-- Campo Nome -->
                <div class="input-field col s4">
                    <input type="text" name="nomecli" value="<?php echo $nome ?>" id="nomecli" maxlength="100" required="">                   
                </div>
            
                <!-- Campo Descrição do projeto -->
                <div class="input-field col s8">
                    <!-- <i class="material-icons prefix"></i> -->
                    <input type="text" name="projeto" value="<?php echo $projeto ?>" id="projeto" maxlength="100" required="">
                    
                </div>
            </div>
            <div class="row">
                <!-- Campo Preço -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="preco"
                        value="<?php echo number_format($preco, 2, ',', '.'); ?>" onblur="javascript:this.value=formataValor(this.value);">
                    
                </div>
                <!-- Campo Qtde -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="quantidade"
                        value="<?php echo number_format($quantidade, 0, ',', '.'); ?>" id="quantidade" maxlength="10">
                    
                </div>
                <!-- Campo Total -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="total_venda"
                        value="<?php echo number_format($total_venda, 2, ',', '.'); ?>" onblur="javascript:this.value=formataValor(this.value);">
                    
                </div>
                <!-- Campo Data da Compra -->
                <div class="input-field col s3">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="date" name="datacompra" value="<?php echo $datacompra; ?>" id="datacompra" maxlength="10">
                    
                </div>
                <!-- Campo Data de previsão de entrega -->
                <div class="input-field col s3">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="date" name="dataprevisao" value="<?php echo $dataprevisao; ?>" id="dataprevisao" maxlength="10">
                    
                </div>
            </div>
            <div class="row">

                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select multiple name="impres[]" id="impres">
                        <option disabled>Clique para escolher </option>
                        <?php
                        $querySelect = $link->query("select id, marca, ocupada from tb_impressoras where ocupada = 'N'");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_impres = $registros['id'];
                            $marca = $registros['marca'];
                            echo '<option value=' . $id_impres . '>' . $marca . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="impres">Impressoras Disponiveis</label>';

                        ?>
                </div>
                <!-- Campo Impressoras ocupadas -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select multiple name="impresocu" id="impresocu">
                        <option disabled>Clique para desocupar</option>
                        <?php
                        $querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'S'");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_ocupada = $registros['id'];
                            $marca = $registros['marca'];
                            echo '<option value=' . $id_ocupada . '>' . $marca . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="impresocu">Impressoras ocupadas</label>';

                        ?>
                </div>
                <!-- Campo Situação -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select name="situacao" id="situacao">
                        <option disabled>Situação do pedido</option>
                        <?php
                        $querySelect = $link->query("select id_situacao, descricao from tb_situacao");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_status = $registros['id_situacao'];
                            $descricao = $registros['descricao'];
                            echo '<option value=' . $id_status . '>' . $descricao . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="situacao">Situação</label>';

                        ?>
                </div>
            </div>

            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Alterar" class="btn blue">
                <a href="lista_pedidos.php" class="btn red">Cancelar</a>
            </div>

        </fieldset>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.6/underscore-umd-min.js"></script>
<script src="../libs/materialize/js/index.js"></script>


<?php include_once('../includes/footer.inc.php') ?>