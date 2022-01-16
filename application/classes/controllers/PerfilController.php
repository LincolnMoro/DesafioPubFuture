<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Perfil;

class PerfilController {
    public function listar() {
        $perfil = new Perfil;
        //$usuario = $perfil->select($_SESSION['usuario']);
        $usuario = $perfil->select("lincolnmoro");

        $_REQUEST['usuario'] = $usuario;

        if(isset($_POST['submit'])) {
            $perfil->editar();
        }
                require_once __DIR__ . '/../view/templates/perfil.php';
    }
}
