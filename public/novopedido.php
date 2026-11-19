<?php session_start()  ?>
<!DOCTYPE html>

<?php
include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');
include_once '../banco_de_dados/conexao.php';

/* SELECT id_venda,id_cliente,id_usuario,descricao,qtde,preco,total_venda,status
        ,data_Compra,data_Finaliza,data_entrega FROM `tb_pedidos`
*/

$id_cli = "";
$nome_cli = "";
$projeto = "";
$preco = floatval(0);
$quantidade = floatval(0);
$total_venda = floatval(0);
$timestamp = time(); // Pega o timestamp atual
$datacompra = date("d/m/Y", $timestamp);
$dataprevisao = "";
$datafinaliza = "";
$dataentrega = "";
$status = "";

$impressoras = []; // Array para armazenar os dados
$querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'N'");
while ($registros = $querySelect->fetch_assoc()) :
    $impressoras[] = $registros; // Adiciona a linha ao array principal
endwhile;

$ocupadas = []; // Array para armazenar os dados
$querySelect = $link->query("select id, marca from tb_impressoras where ocupada = 'S'");
while ($registros = $querySelect->fetch_assoc()) :
    $ocupadas[] = $registros; // Adiciona a linha ao array principal
endwhile;

$filamentos = []; // Array para armazenar os dados
$querySelect = $link->query("select id, marca, tipo,cor,qtde_estoque from tb_filamentos where qtde_estoque > 0");
while ($registros = $querySelect->fetch_assoc()) :
    $filamentos[] = $registros; // Adiciona a linha ao array principal
endwhile;

//$output = json_encode($impressoras);
//echo $output;
//exit();
?>

<div class="row container">

    <form action="../banco_de_dados/createped.php" id="formPedido" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 5px">
            <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Cadastro de Pedidos</h5>
            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <div class="row">
                <!-- Campo Nome -->
                <div class="input-field col s4" autofocus>
                    <!--   <i class="material-icons prefix"></i>  -->
                    <select name="nomecli" id="nomecli">
                        <option disabled selected>Escolha o Cliente</option>
                        <?php
                        $querySelect = $link->query("select id, nome from tb_clientes order by nome");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_cli = $registros['id'];
                            $nomecli = $registros['nome'];
                            echo '<option value=' . $id_cli . '>' . $nomecli . '</option>';

                        endwhile;
                        echo '</select>';
                        echo '<label for="nomecli">Nome</label>';
                        ?>
                </div>

                <!-- Campo Descrição do projeto -->
                <div class="input-field col s8">
                    <!-- <i class="material-icons prefix"></i> -->
                    <input type="text" name="projeto" value="<?php echo $projeto ?>" id="projeto" maxlength="100" required="">
                    <label for="projeto">Descrição do projeto</label>
                </div>
            </div>
            <div class="row">
                <!-- Campo Preço -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="number" name="preco" step=".01"
                        value="<?php echo number_format($preco, 2, '.', ','); ?>" onblur="javascript:this.value=formataValor(this.value);">
                    <label for="preco">Valor unitário</label>
                </div>
                <!-- Campo Qtde -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="number" name="quantidade"
                        value="<?php echo number_format($quantidade, 0, ',', '.'); ?>" id="quantidade" maxlength="10">
                    <label for="quantidade">Qtde.</label>
                </div>
                <!-- Campo Total -->
                <div class="input-field col s2">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="number" name="total_venda" step=".01"
                        value="<?php echo number_format($total_venda, 2, '.', ','); ?>" onblur="javascript:this.value=formataValor(this.value);">
                    <label for="total_venda">Valor total</label>
                </div>
                <!-- Campo Data da Compra -->
                <div class="input-field col s3">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="date" name="datacompra" value="<?php echo $datacompra ?>" id="datacompra" maxlength="10">
                    <label for="datacompra">Dta.Compra</label>
                </div>
                <!-- Campo Data de previsão de entrega -->
                <div class="input-field col s3">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="date" name="dataprevisao" value="<?php echo $dataprevisao ?>" id="dataprevisao" maxlength="10">
                    <label for="dataprevisao">Dta.Prevista</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select multiple name="selimpres" id="selimpres" data-toggle="modal1" onchange="changefunc(this);" data-target="#modal1">
                        <option disabled>Escolha a(s) impressora(s) disponivel(eis)</option>
                        <?php
                        foreach ($impressoras as $registro) {
                            echo '<option value=' . $registro['id'] . '>' . $registro['marca'] . '</option>';
                        }
                        echo '</select>';
                        echo '<label for="selimpres">Impressora(s) a ser(em) usada(s)</label>';
                        ?>
                </div>
                <!-- Campo Impressora(s) ocupada(s) -->
                <div class="input-field col s6">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select name="impocupa" id="impocupa">
                        <option disabled>Ocupadas</option>
                        <?php
                        foreach ($ocupadas as $impocupa) {
                            echo '<option value=' . $impocupa['id'] . '>' . $impocupa['marca'] . '</option>';
                        }
                        echo '</select>';
                        echo '<label for="impocupa">Impressora(s) ocupada(s)</label>';
                        ?>
                </div>

            </div>

            <!-- Botões -->
            <div class="input-field col s12">

                <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Filamentos</a>
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="reset" value="Limpar" class="btn red">&nbsp&nbsp
                <a href="lista_pedidos.php" class="btn purple">Voltar</a>
            </div>
        </fieldset>
    </form>
    <!---  Fim do form -->

</div>

<!-- Begin of Modal Structure -->
<!-- O Modal em si -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <span><h3>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFilamentos</h3> </span>
        <div class="container">
            <table class="striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Marca/tipo/cor</th>
                        <th>Estoque</th>
                        <th>Qtde. a usar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include_once('../banco_de_dados/readfila2.php'); ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect btn green">Concordar</a>
        <a href="#!" class="modal-close waves-effect waves-green btn purple">Fechar</a>
        </div>
    </div>
    <!-- End of Modal Structure -->
</div>

<!-- Arquivos Jquery e Materialize -->
<script type="text/javascript" src="../libs/materialize/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../libs/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../libs/materialize/js/funcoes.js"></script>

<script>
    document.getElementById('filamentos').addEventListener('change', function(event) {
        console.log('Valor selecionado:', event.target.value);
    });

    function changeFunc(valor) {
        alert("The selected value is: " + valor);

        // You can add more code here to perform other actions
    }
</script>
<!-- Inicialização Jquery -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".dropdown-trigger").dropdown();
        $('select').formSelect();
    });
</script>

<script>
    // Inicialização do Modal
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>

</body>

</html>