<?php
$saldoTotal = $_REQUEST['saldoTotal'];
$totalDepsesas = $_REQUEST['totalDepsesas'];
$totalReceitas = $_REQUEST['totalReceitas'];
?>

    <div class="widget-content">
        <p class="widget-title"><?php echo $totalReceitas; ?></p>
        <p class="widget-text">Total de Receitas</p>
    </div>
    <div class="widget-content">
        <p class="widget-title"><?php echo $totalDepsesas; ?></p>
        <p class="widget-text">Total de Despesas</p>
    </div>
    <div class="widget-content">
        <p class="widget-title">R$ <?php echo $saldoTotal; ?></p>
        <p class="widget-text">Saldo Total</p>
    </div>
