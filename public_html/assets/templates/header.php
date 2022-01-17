<?php

namespace app\public_html;

use app\application\classes\controllers\ContasController;
use app\application\classes\controllers\DespesasController;
use app\application\classes\controllers\ReceitaController;
use app\application\classes\controllers\PerfilController;
use app\application\classes\controllers\WidgetController;

require_once "../vendor/autoload.php";

session_start();

$receita = new ReceitaController;
$despesa = new DespesasController;
$conta = new ContasController;
$perfil = new PerfilController;

if($_SESSION['active'] == false) {
        header("Location:login.php");
        exit;
        //return;
    }

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

