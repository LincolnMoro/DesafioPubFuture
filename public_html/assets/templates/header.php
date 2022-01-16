<?php

namespace app\public_html;

use app\application\classes\controllers\ContasController;
use app\application\classes\controllers\DespesasController;
use app\application\classes\controllers\ReceitaController;
use app\application\classes\controllers\PerfilController;
use app\application\classes\controllers\WidgetController;

require_once "../vendor/autoload.php";

$receita = new ReceitaController;
$despesa = new DespesasController;
$conta = new ContasController;
$perfil = new PerfilController;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Receitas</title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>

<nav class="main-nav">
    <menu class="main-menu">
        <ul>
            <li><a href="receitas.php"><i class="fas fa-search-dollar"></i><p>Receitas</p></a></li>
            <li><a href="despesas.php"><i class="fas fa-file-invoice-dollar"></i><p>Despesas</p></a></li>
            <li><a href="contas.php"><i class="fas fa-money-check-alt"></i><p>Contas</p></a></li>
            <li><a href="perfil.php"><i class="far fa-user"></i><p>Meu Perfil</p></a></li>
        </ul>
    </menu>
</nav>

<div class="widget">
    <?php
        $widget = new WidgetController;
        $widget->listar();
    ?>
</div>

<div class="content">