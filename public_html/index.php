<?php

namespace app\public_html;

use app\application\classes\controllers\ReceitaController;

require_once "../vendor/autoload.php";

$test = new ReceitaController;
//$test->listar();

//require_once "../application/classes/view/header.php";

//require_once "../application/classes/view/widget.php";

//require_once "../application/classes/view/content.php";

//require_once "../application/classes/view/footer.php";
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

<div class="widget">
</div>

<div class="content">
    <?php $test->listar(); ?>
</div>

</body>
</html>