<?php
if(isset($_REQUEST['editar'])) {
    $editar = $_REQUEST['editar'];
}
$contas = $_REQUEST['contas'];
$contaOrigem = $_REQUEST['contaOrigem'];
?>

<div class="view-nav">
    <button formaction="index.php"><a href="index.php">Voltar</a></button>
</div>

<h2>Transferência de Saldo</h2>

<div class="">
    <h2><?php echo isset($_GET['id']) ? "Editar" : "Adicionar"; ?> Receita</h2>
    <form action="" method="post">

        <div class="form-field">
            <label for="conta">Valor</label>
            <input type="text" name="contaOrigem" id="conta" value="<?php echo $contaOrigem['titular'] . " | " . $contaOrigem['conta']; ?>">
        </div>

        <div class="form-field">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor">
        </div>

        <div class="form-field">
            <label for="contaOrigem">Data de Recebimento</label>
            <input type="text" name="contaOrigem" id="contaOrigem" value="<?php if($_GET == "id"){ echo $editar['dataRecebimento']; }?>">
        </div>

        <div class="form-field">
            <label for="dataRecebimentoEsperado">Data Esperada para Recebimento</label>
            <input type="date" name="dataRecebimentoEsperado" id="dataRecebimentoEsperado" value="<?php if($_GET == "id"){ echo $editar['dataRecebimentoEsperado']; }?>">
        </div>

        <div class="form-field">
            <label for="contaDestino">Conta</label>
            <select name="contaDestino" id="contaDestino">
                <?php
                foreach ($contas as $conta) {
                    echo "<option value='{$conta['id']}'>{$conta['titular']} - {$conta['instituicaoFinanceira']} | {$conta['conta']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <input class="button" type="submit" name="submit" value="Transferir">
        </div>
    </form>
</div>