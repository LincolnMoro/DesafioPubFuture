<?php
$tipoDespesa = $_REQUEST['tipoDespesa'];
if(isset($_REQUEST['editar'])) {
    $editar = $_REQUEST['editar'];
}
$contas = $_REQUEST['contas'];
?>

<div class="button-main"><a class="button button-main button-blue" href="despesas.php">Voltar</a></div>

<div class="">
    <h2><?php echo isset($_GET['id']) ? "Editar" : "Adicionar"; ?> Despesa</h2>
    <form action="" method="post">

        <div class="form-field">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" value="<?php if(isset($_GET['id'])){ echo $editar['valor']; }?>">
        </div>

        <div class="form-field">
            <label for="tipoDespesa">Tipo de Despesa</label>
            <select name="tipoDespesa" id="tipoDespesa">
                <?php
                foreach ($tipoDespesa as $tipo) {
                    if(isset($_GET['id'])) {
                        if($tipo == $editar['tipoDespesa']) {
                            $selected = "selected";
                        }
                        else {
                            $selected = "";
                        }
                    }
                    echo "<option value='{$tipo}' selected='$selected'>{$tipo}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <label for="dataPagamento">Data de Pagamento</label>
            <input type="date" name="dataPagamento" id="dataPagamento" value="<?php if(isset($_GET['id'])){ echo $editar['dataPagamento']; }?>">
        </div>

        <div class="form-field">
            <label for="dataPagamentoEsperado">Data Esperada para Pagamento</label>
            <input type="date" name="dataPagamentoEsperado" id="dataPagamentoEsperado" value="<?php if(isset($_GET['id'])){ echo $editar['dataPagamentoEsperado']; }?>">
        </div>

        <div class="form-field">
            <label for="conta">Conta</label>
            <select name="conta" id="conta">
                <?php
                foreach ($contas as $conta) {
                    if(isset($_GET['id'])) {
                        if($conta == $editar['conta']) {
                            $selected = "selected";
                        }
                        else {
                            $selected = "";
                        }
                    }
                    echo "<option value='{$conta['id']}' selected='$selected'>{$conta['titular']} - {$conta['instituicaoFinanceira']} | {$conta['conta']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <input class="button button-main button-green" type="submit" name="submit" value="Salvar">
        </div>
    </form>
</div>