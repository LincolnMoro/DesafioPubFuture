<?php
$receitas = $_REQUEST['receitas'];
$tiposReceita = $_REQUEST['tiposReceita'];
?>

<div class="view-nav">
    <button formaction=""><a href="index.php?add=receita">Adicionar Nova</a></button>
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
        <input class="button" type="submit" name="submit" value="Filtrar">
        <button formaction=""><a href="index.php">Limpar Filtros</a></button>
    </form>
</div>
<div class="">
    <table>
        <tr>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Recebimento</th>
            <th>Recebimento Esperado</th>
            <th>Tipo</th>
        </tr>
        <?php foreach ($receitas as $receita): ?>
            <tr>
                <td><?php echo $receita['valor'] ?></td>
                <td><?php echo $receita['descricao'] ?></td>
                <td><?php echo $receita['dataRecebimento'] ?></td>
                <td><?php echo $receita['dataRecebimentoEsperado'] ?></td>
                <td><?php echo $receita['tipoReceita'] ?></td>
                <td><a href="index.php?id=<?php echo $receita['id']; ?>">Editar</a></td>
                <td><a href="index.php?delete=<?php echo $receita['id']; ?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

