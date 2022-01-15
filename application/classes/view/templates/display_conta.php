<?php
$receitas = $_REQUEST['receitas'];
$tiposReceita = $_REQUEST['tiposReceita'];
$pages = $_REQUEST['pages'];
?>

<div class="view-nav">
    <p class="title">Filtrar consulta</p>
    <form action="" method="get">
        <select>
            <?php
            foreach ($tiposReceita as $tipo) {
                echo "<option value='{$tipo}'>{$tipo}</option>";
            }
            ?>
        </select>
        <label for="dataInicial">Data Inicial</label>
        <input type="date" name="de" id="dataRecebimento" value="<?php if(isset($_GET['de'])){ echo $_GET['de']; }?>">
        <label for="dataFinal">Data Final</label>
        <input type="date" name="ate" id="dataRecebimento" value="<?php if(isset($_GET['ate'])){ echo $_GET['ate']; }?>">
        <input class="button button-blue" type="submit" name="submit" value="Filtrar">
        <div class="button-main"><a class="button-blue button" href="index.php">Limpar Filtros</a></div>
    </form>
    <hr>
    <div class="button-main"><a class="button button-main button-green" href="index.php?add=receita">Adicionar Nova</a></div>
</div>
<div class="">
    <table>
        <tr>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Recebimento</th>
            <th>Data Esperado</th>
            <th>Tipo</th>
        </tr>
        <?php foreach ($receitas as $receita): ?>
            <tr>
                <td><?php echo $receita['valor'] ?></td>
                <td><?php echo $receita['descricao'] ?></td>
                <td><?php echo $receita['dataRecebimento'] ?></td>
                <td><?php echo $receita['dataRecebimentoEsperado'] ?></td>
                <td><?php echo $receita['tipoReceita'] ?></td>
                <td><a class="button-blue button" href="index.php?id=<?php echo $receita['id']; ?>">Editar</a></td>
                <td><a class="button-red button" href="index.php?delete=<?php echo $receita['id']; ?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="paginator">
    <?php
    if(empty($_GET['pagina'])) {
        echo "<a class='pager' href='index.php?pagina=1'>Anterior</a>";
    }
    if(isset($_GET['pagina'])) {
        $page = $_GET['pagina'] <= 1 ? 1 : $_GET['pagina'] - 1;
        echo "<a class='pager' href='index.php?pagina={$page}'>Anterior</a>";
    }
    ?>
    <ul>
        <?php for($i = 1; $i <= $pages; $i++) {
            echo "<li class='pager-li'><a class='pager' href='index.php?pagina={$i}'>{$i}</a></li>";
        } ?>
    </ul>
    <?php
    if(isset($_GET['pagina']) && ($_GET['pagina'] < $pages)) {
        $page = $_GET['pagina'] + 1;
        echo "<a class='pager' href='index.php?pagina={$page}'>Próxima</a> ";
    }
    ?>
</div>

