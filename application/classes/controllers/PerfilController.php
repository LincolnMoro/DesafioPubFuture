<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Perfil;

class PerfilController {
    //Lista o perfil de usuário e permite a edição de dados
    public function listar() {
        $perfil = new Perfil;
        //$usuario = $perfil->select($_SESSION['usuario']);
        $usuarioSessao = $_SESSION['id'];
        $usuario = $perfil->select($usuarioSessao);

        $_REQUEST['usuario'] = $usuario;

        //Responsável por realizar a edição de dados do perfil
        if(isset($_POST['submit'])) {
            $perfil->editar($usuarioSessao);
        }
                require_once __DIR__ . '/../view/templates/display_perfil.php';
    }

    //Chama a página de login caso o usuário não esteja logado
    public function login() {
        require_once __DIR__ . '/../view/templates/login_perfil.php';
        if(isset($_POST['submit'])) {
            $perfil = new Perfil;
            $perfil->login($_POST['usuario'], $_POST['senha']);
        }
    }
}
