<?php
//Recebe os valores para exibição na tela
$tipoConta = $_REQUEST['tipoConta'];
//Determina se a ação será a edição ou criação de reegistro
if(isset($_REQUEST['editar'])) {
    $editar = $_REQUEST['editar'];
}
?>

<div class="button-main"><a class="button button-main button-blue" href="contas.php">Voltar</a></div>

<div class="">
    <h2><?php echo isset($_GET['id']) ? "Editar" : "Adicionar"; ?> Conta</h2>
    <form action="" method="post">

        <div class="form-field">
            <label for="titular">Titular</label>
            <input type="text" name="titular" id="titular" value="<?php if(isset($_GET['id'])){ echo $editar['titular']; }?>">
        </div>

        <div class="form-field">
            <label for="instituicaoFinanceira">Instituição Financeira</label>
            <input type="text" name="instituicaoFinanceira" id="instituicaoFinanceira" value="<?php if(isset($_GET['id'])){ echo $editar['instituicaoFinanceira']; }?>">
        </div>

        <div class="form-field">
            <label for="tipoConta">Tipo de Conta</label>
            <select name="tipoConta" id="tipoConta">
                <?php
                //Lista os tipos de conta
                foreach ($tipoConta as $tipo) {
                    echo "<option value='{$tipo}'>{$tipo}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-field">
            <label for="conta">Conta</label>
            <input type="text" name="conta" id="conta" value="<?php if(isset($_GET['id'])){ echo $editar['conta']; }?>">
        </div>

        <div class="form-field">
            <input class="button button-main button-green" type="submit" name="submit" value="Salvar">
        </div>
    </form>
</div>