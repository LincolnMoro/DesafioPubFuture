<?php
$contas = $_REQUEST['contas'];
$tiposconta = $_REQUEST['tipoConta'];
$pages = $_REQUEST['pages'];
?>
<h2>Contas</h2>
<div class="view-nav">
    <p class="title">Filtrar consulta</p>
    <form action="?contas" method="get">
        <select>
            <?php
            foreach ($tiposconta as $tipo) {
                echo "<option value='{$tipo}'>{$tipo}</option>";
            }
            ?>
        </select>
        <input class="button button-blue" type="submit" name="submit" value="Filtrar">
        <div class="button-main"><a class="button-blue button" href="contas.php">Limpar Filtros</a></div>
    </form>
    <hr>
    <div class="button-main"><a class="button button-main button-green" href="?add=conta">Adicionar Nova</a></div>
</div>
<div class="">
    <table>
        <tr>
            <th>Titular</th>
            <th>Tipo de Conta</th>
            <th>Instituição</th>
            <th>Conta</th>
            <th>Saldo</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($contas as $conta): ?>
            <tr>
                <td><?php echo $conta['titular'] ?></td>
                <td><?php echo $conta['tipoConta'] ?></td>
                <td><?php echo $conta['instituicaoFinanceira'] ?></td>
                <td><?php echo $conta['conta'] ?></td>
                <td><?php echo $conta['saldo'] ?></td>
                <td><a class="button-blue button" href="?transferir=<?php echo $conta['id']; ?>">Transferência</a></td>
                <td><a class="button-blue button" href="?id=<?php echo $conta['id']; ?>">Editar</a></td>
                <td><a class="button-red button" href="?delete=<?php echo $conta['id']; ?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="paginator">
    <?php
    if(empty($_GET['pagina'])) {
        echo "<a class='pager' href='contas.php?pagina=1'>Anterior</a>";
    }
    if(isset($_GET['pagina'])) {
        $page = $_GET['pagina'] <= 1 ? 1 : $_GET['pagina'] - 1;
        echo "<a class='pager' href='contas.php?pagina={$page}'>Anterior</a>";
    }
    ?>
    <ul>
        <?php for($i = 1; $i <= $pages; $i++) {
            echo "<li class='pager-li'><a class='pager' href='contas.php?pagina={$i}'>{$i}</a></li>";
        } ?>
    </ul>
    <?php
    if(isset($_GET['pagina']) && ($_GET['pagina'] < $pages)) {
        $page = $_GET['pagina'] + 1;
        echo "<a class='pager' href='contas.php?pagina={$page}'>Próxima</a> ";
    }
    ?>
</div>

