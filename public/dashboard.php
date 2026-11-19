<?php include_once('../banco_de_dados/conexao.php');

$sqlTotal = "SELECT id_venda FROM tb_pedidos WHERE status = 1";
$qrTotal = $link->query($sqlTotal);
$numTotalpedAInic = $qrTotal->num_rows;

$sqlTotal = "SELECT id_venda FROM tb_pedidos WHERE status = 2";
$qrTotal = $link->query($sqlTotal);
$numTotalpedInic = $qrTotal->num_rows;

$sqlTotal = "SELECT id_venda FROM tb_pedidos WHERE status = 3";
$qrTotal = $link->query($sqlTotal);
$numTotalpedFina = $qrTotal->num_rows;

$sqlTotal = "SELECT id_venda FROM tb_pedidos WHERE status = 4";
$qrTotal = $link->query($sqlTotal);
$numTotalpedEntre = $qrTotal->num_rows;

$sqlTotal = "SELECT id FROM tb_clientes";
$qrTotal = $link->query($sqlTotal);
$numTotalCli = $qrTotal->num_rows;

$sqlTotal = "SELECT id FROM tb_fornecedores";
$qrTotal = $link->query($sqlTotal);
$numTotalFor = $qrTotal->num_rows;

$sqlTotal = "SELECT id FROM tb_filamentos";
$qrTotal = $link->query($sqlTotal);
$numTotalFila = $qrTotal->num_rows;

$sqlTotal = "SELECT id FROM tb_impressoras";
$qrTotal = $link->query($sqlTotal);
$numTotalImpre = $qrTotal->num_rows;

if (isset($_SESSION['usuario'])):
    $usuario = $_SESSION['usuario'];
else:
    $usuario = 'Caro(a) Usuário(a)';
endif;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" style="width: 90%">
        <div class="body dashboard">
            <h5>Seja bem-vindo(a), <?php echo $usuario;?>.</h5>
            <div class="dashboard-row">
                <div class="dashboard-card shadow">
                    <div class="card-icon cyan">
                        <i class="fa fa-battery-empty"></i> 
                    </div> 
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalpedAInic;?></span> Pedidos a iniciar</span>
                    </div>
                </div>
                <div class="dashboard-card shadow">
                    <div class="card-icon purple">
                       <i class="fa fa-battery-quarter"></i>
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalpedInic;?></span> Pedidos iniciados</span>
                    </div>
                </div>
                <div class="dashboard-card shadow">
                    <div class="card-icon yellow">
                       <i class="fa fa-battery-half"></i>  
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalpedFina;?></span> Pedidos finalizados</span>
                    </div>
                </div>
                <div class="dashboard-card shadow">
                    <div class="card-icon green">
                       <i class="fa fa-battery-full"></i>  
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalpedEntre ;?></span> Pedidos já entregues</span>
                    </div>
                </div>
            </div>            
            <!--  Outros cards -->
            <div> </br> </div>  
            <div class="dashboard-row">
                <div class="dashboard-card shadow">
                    <div class="card-icon purple">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalCli;?></span> Clientes cadastrados</span>
                    </div>
                </div>
                <div class="dashboard-card shadow">
                    <div class="card-icon yellow">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalFor;?></span> Fornecedores cadastrados</span>
                    </div>
                </div>
                <div class="dashboard-card shadow">
                    <div class="card-icon green">
                        <!-- <i class="fa fa-circle-dot"></i>  -->
                        <i class="fa fa-circle"></i>
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalFila;?></span> Filamentos</span>
                    </div>
                </div>
                <div class="dashboard-card shadow">
                    <div class="card-icon red">
                        <!-- <i class="fa fa-circle-dot"></i>  -->
                        <i class="fa fa-print"></i>
                    </div>
                    <div class="card-text">
                        <span><span class="card-number"><?php echo $numTotalImpre;?></span> Impressoras</span>
                    </div>
                </div>

            </div>            

        </div>
    </div>
</body>
</html>