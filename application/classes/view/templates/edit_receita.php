<?php
$tiposReceita = $_REQUEST['tiposReceita'];
if(isset($_REQUEST['editar'])) {
    $editar = $_REQUEST['editar'];
}
$contas = $_REQUEST['contas'];
?>

<div class="view-nav">
    <button formaction="index.php"><a href="index.php">Voltar</a></button>
</div>

<div class="">
    <h2><?php echo isset($_GET['id']) ? "Editar" : "Adicionar"; ?> Receita</h2>
    <form action="" method="post">

        <div class="form-field">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" value="<?php if($_GET == "id"){ echo $editar['valor']; }?>">
        </div>

        <div class="form-field">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" value="<?php if($_GET == "id"){ echo $editar['descricao']; }?>">
        </div>

        <div class="form-field">
            <label for="tipoReceita">Tipo de Receita</label>
            <select name="tipoReceita" id="tipoReceita">
                <?php
                foreach ($tiposReceita as $tipo) {
                    echo "<option value='{$tipo}'>{$tipo}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <label for="dataRecebimento">Data de Recebimento</label>
            <input type="date" name="dataRecebimento" id="dataRecebimento" value="<?php if($_GET == "id"){ echo $editar['dataRecebimento']; }?>">
        </div>

        <div class="form-field">
            <label for="dataRecebimentoEsperado">Data Esperada para Recebimento</label>
            <input type="date" name="dataRecebimentoEsperado" id="dataRecebimentoEsperado" value="<?php if($_GET == "id"){ echo $editar['dataRecebimentoEsperado']; }?>">
        </div>

        <div class="form-field">
            <label for="conta">Conta</label>
            <select name="conta" id="conta">
                <?php
                foreach ($contas as $conta) {
                    echo "<option value='{$conta['id']}'>{$conta['titular']} - {$conta['instituicaoFinanceira']} | {$conta['conta']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <input class="button" type="submit" name="submit" value="Salvar">
        </div>
    </form>
</div>