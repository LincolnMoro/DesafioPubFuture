<?php
$despesas = $_REQUEST['despesas'];
$tipoDespesa = $_REQUEST['tipoDespesa'];
$pages = $_REQUEST['pages'];
?>
<h2>Despesas</h2>
<div class="view-nav">
    <p class="title">Filtrar consulta</p>
    <form action="" method="get">
        <select name="tipo">
            <?php
            foreach ($tipoDespesa as $tipo) {
                echo "<option value='{$tipo}' name='{$tipo}'>{$tipo}</option>";
            }
            ?>
        </select>
        <label for="dataInicial">Data Inicial</label>
        <input type="date" name="de" id="dataRecebimento" value="<?php if(isset($_GET['de'])){ echo $_GET['de']; }?>">
        <label for="dataFinal">Data Final</label>
        <input type="date" name="ate" id="dataRecebimento" value="<?php if(isset($_GET['ate'])){ echo $_GET['ate']; }?>">
        <input class="button button-blue" type="submit" name="submit" value="Filtrar">
        <div class="button-main"><a class="button-blue button" href="despesas.php">Limpar Filtros</a></div>
    </form>
    <hr>
    <div class="button-main"><a class="button button-main button-green" href="?add=despesa">Adicionar Nova</a></div>
</div>
<div class="">
    <table>
        <tr>
            <th>Valor</th>
            <th>Pagamento</th>
            <th>Data Esperada</th>
            <th>Tipo</th>
        </tr>
        <?php foreach ($despesas as $despesa): ?>
            <tr>
                <td><?php echo $despesa['valor'] ?></td>
                <td><?php echo $despesa['dataPagamento'] ?></td>
                <td><?php echo $despesa['dataPagamentoEsperado'] ?></td>
                <td><?php echo $despesa['tipoDespesa'] ?></td>
                <td><a class="button-blue button" href="?id=<?php echo $despesa['id']; ?>">Editar</a></td>
                <td><a class="button-red button" href="?delete=<?php echo $despesa['id']; ?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="paginator">
    <?php
    if(empty($_GET['pagina'])) {
        echo "<a class='pager' href='?pagina=1'>Anterior</a>";
    }
    if(isset($_GET['pagina'])) {
        $page = $_GET['pagina'] <= 1 ? 1 : $_GET['pagina'] - 1;
        echo "<a class='pager' href='?pagina={$page}'>Anterior</a>";
    }
    ?>
    <ul>
        <?php for($i = 1; $i <= $pages; $i++) {
            echo "<li class='pager-li'><a class='pager' href='?pagina={$i}'>{$i}</a></li>";
        } ?>
    </ul>
    <?php
    if(isset($_GET['pagina']) && ($_GET['pagina'] < $pages)) {
        $page = $_GET['pagina'] + 1;
        echo "<a class='pager' href='?pagina={$page}'>Próxima</a> ";
    }
    ?>
</div>

