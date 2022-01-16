<?php
$tipoConta = $_REQUEST['tipoConta'];
$contaOrigem = $_REQUEST['contaOrigem'];
$contas = $_REQUEST['contas'];
?>

<div class="button-main"><a class="button button-main button-blue" href="contas.php">Voltar</a></div>

<div class="">
    <h2>Transferência de Valores</h2>
    <form action="" method="post">

        <h3>Conta de Origem</h3>
        <div class="form-field">
            <label for="titular">Titular</label>
            <input type="text" name="titular" id="titular" value="<?php echo $contaOrigem['titular']; ?>" disabled>
        </div>

        <div class="form-field">
            <label for="instituicaoFinanceira">Instituição Financeira</label>
            <input type="text" name="instituicaoFinanceira" id="instituicaoFinanceira" value="<?php echo $contaOrigem['instituicaoFinanceira']; ?>" disabled>
        </div>

        <div class="form-field">
            <label for="tipoConta">Instituição Financeira</label>
            <input type="text" name="tipoConta" id="tipoConta" value="<?php echo $contaOrigem['tipoConta']; ?>" disabled>
        </div>

        <div class="form-field">
            <label for="numeroConta">Conta</label>
            <input type="text" name="numeroConta" id="numeroConta" value="<?php echo $contaOrigem['conta']; ?>" disabled>
        </div>

        <h3>Conta de Destino</h3>

        <div class="form-field">
            <label for="conta">Conta</label>
            <select name="contaDestino" id="conta">
                <?php
                foreach ($contas as $conta) {
                    echo "<option value='{$conta['id']}'>{$conta['titular']} - {$conta['instituicaoFinanceira']} | {$conta['conta']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" value="">
        </div>

        <div class="form-field">
            <input class="button button-main button-green" type="submit" name="submit" value="Transferir">
        </div>
    </form>
</div>