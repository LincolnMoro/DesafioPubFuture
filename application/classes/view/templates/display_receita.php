<?php
$receitas = $_REQUEST['receitas'];
$tiposReceita = $_REQUEST['tiposReceita'];
?>

<!-- <!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receitas</title>
</head>
<body> -->
<div class="view-nav">
    <button formaction="">Adicionar Nova</button>
    <form action="" type="">
        <select>
            <?php
            foreach ($tiposReceita as $tipo) {
                echo "<option value='{$tipo}'>{$tipo}</option>";
            }
            ?>
        </select>
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
            <th>Conta</th>
        </tr>
        <?php foreach ($receitas as $receita): ?>
            <tr>
                <td><?php echo $receita['valor'] ?></td>
                <td><?php echo $receita['descricao'] ?></td>
                <td><?php echo $receita['dataRecebimento'] ?></td>
                <td><?php echo $receita['dataRecebimentoEsperado'] ?></td>
                <td><?php echo $receita['tipoReceita'] ?></td>
                <td><?php echo $receita['conta'] ?></td>
                <td><a>Editar</a></td>
                <td><a>Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<!-- </body>
</html> -->

