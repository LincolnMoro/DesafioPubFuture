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

    use app\application\classes\controllers\WidgetController;

    $widget = new WidgetController;
    $widget->listar();
    ?>
</div>

<div class="content">