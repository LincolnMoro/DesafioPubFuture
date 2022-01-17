<?php
    //Inicia a sessão de usuário
    ob_start();
    session_start();

    //Defini se o usuário está logado e se não estiver, direciona para a tela de login
    if(!isset($_SESSION['usuario'])) {
        header('Location:login.php');
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

    <nav class="main-nav">
        <menu class="main-menu">
            <ul>
                <li><a href="/receitas"><i class="fas fa-search-dollar"></i><p>Receitas</p></a></li>
                <li><a href="/despesas"><i class="fas fa-file-invoice-dollar"></i><p>Despesas</p></a></li>
                <li><a href="/contas"><i class="fas fa-money-check-alt"></i><p>Contas</p></a></li>
                <li><a href="/perfil"><i class="far fa-user"></i><p>Meu Perfil</p></a></li>
            </ul>
        </menu>
    </nav>

