<?php
/*
namespace app\public_html;

use app\application\classes\controllers\ContasController;
use app\application\classes\controllers\DespesasController;
use app\application\classes\controllers\ReceitaController;
use app\application\classes\controllers\PerfilController;

require_once "../vendor/autoload.php";

$receita = new ReceitaController;
$despesa = new DespesasController;
$conta = new ContasController;
$perfil = new PerfilController;
*/

require_once "assets/templates/header.php";
require_once "assets/templates/content.php";
?>

<h1>Sistema de gestão de Financias</h1>

<p class="title">Seja bem vindo <?php echo $_SESSION['nome']; ?></p>
<p>No menu lateral você pode navegar entre as opções do sistema de gestão de financias pessoais. Bom planejamento e boa financias :)</p>

<?php
require_once "assets/templates/footer.php";

?>
<!--<!DOCTYPE html>
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
                <li><a href="?receitas"><i class="fas fa-search-dollar"></i><p>Receitas</p></a></li>
                <li><a href="?despesas"><i class="fas fa-file-invoice-dollar"></i><p>Despesas</p></a></li>
                <li><a href="?contas"><i class="fas fa-money-check-alt"></i><p>Contas</p></a></li>
                <li><a href="?perfil"><i class="far fa-user"></i><p>Meu Perfil</p></a></li>
            </ul>
        </menu>
    </nav>

<div class="widget">
</div>

<div class="content">

</div>

</body>
</html> -->