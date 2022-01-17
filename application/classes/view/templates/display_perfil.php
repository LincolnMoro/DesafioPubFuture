<?php
$usuario = $_REQUEST['usuario'];
?>

<div class="foto-perfil">
    <img src="<?php echo "assets/imagens/" . $usuario['foto']; ?>">
</div>

<div class="">
    <h2>Bem Vindo <?php echo $usuario['nome']; ?></h2>
    <form action="" method="post">

        <div class="form-field">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>">
        </div>

        <div class="form-field">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" value="<?php echo $usuario['usuario']; ?>">
        </div>

        <div class="form-field">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" value="<?php echo $usuario['email']; ?>">
        </div>

        <div class="form-field">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
        </div>

        <div class="form-field">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
        </div>

        <div class="form-field">
            <input class="button button-main button-green" type="submit" name="submit" value="Salvar Edições">
        </div>
    </form>
</div>