<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Receita;

class ViewReceita {
    public function listar() {
        $receita = new Receita;
        $receitas = $receita->listAll();
        $tiposReceita = $receita->tiposReceita();

        $_REQUEST['receitas'] = $receitas;
        $_REQUEST['tiposReceita'] = $tiposReceita;

        require_once __DIR__ . '/../view/templates/display_receita.php';
    }
}
