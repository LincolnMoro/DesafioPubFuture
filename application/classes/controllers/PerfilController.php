<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Despesa;

class PerfilController {
    public function listar() {
        $despesa = new Despesa;
        $despesas = $despesa->listAll();
        $tipoDespesa = $despesa->tipoDespesa();
        $pages = $despesa->getNumPages();

        $_REQUEST['despesas'] = $despesas;
        $_REQUEST['tipoDespesa'] = $tipoDespesa;
        $_REQUEST['pages'] = $pages;

        if(isset($_GET['id']) || isset($_GET['add'])) {
            $this->editar();
        }

        if(isset($_GET['delete'])) {
            $despesa->delete($_GET['delete']);
        }

        else {
            if(empty($_GET['add']) && empty($_GET['id']))
                require_once __DIR__ . '/../view/templates/display_despesa.php';
        }
    }

    public function editar() {

        $despesa = new Despesa;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar =  $despesa->select($id);
            $_REQUEST['editar'] = $editar;
        }

        $tipoDespesa = $despesa->tiposReceita();
        $contas = $despesa->getConta();


        $_REQUEST['tipoDespesa'] = $tipoDespesa;
        $_REQUEST['contas'] = $contas;

        require_once __DIR__ . '/../view/templates/edit_receita.php';

        if(isset($_POST['submit'])) {
            if(isset($_GET['id'])) {
                $despesa->edit($id);
            }
            else {
                $despesa->create();
            }
        }
    }
}