<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Receita;

class ReceitaController {
    public function listar() {
        $receita = new Receita;
        $receitas = $receita->listAll();
        $tiposReceita = $receita->tiposReceita();

        $_REQUEST['receitas'] = $receitas;
        $_REQUEST['tiposReceita'] = $tiposReceita;

        if(isset($_GET['id']) || isset($_GET['add'])) {
            $this->editar();
        }

        if(isset($_GET['delete'])) {
            $receita->delete($_GET['delete']);
        }

        else {
            require_once __DIR__ . '/../view/templates/display_receita.php';
        }
    }

    public function editar() {

        $receita = new Receita;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar =  $receita->select($id);
            $_REQUEST['editar'] = $editar;
        }

        $tiposReceita = $receita->tiposReceita();
        $contas = $receita->getConta();


        $_REQUEST['tiposReceita'] = $tiposReceita;
        $_REQUEST['contas'] = $contas;

        require_once __DIR__ . '/../view/templates/edit_receita.php';

        if(isset($_POST['submit'])) {
            if(isset($_GET['id'])) {
                $receita->edit($id);
            }
            else {
                $receita->create();
            }
        }
    }
}
