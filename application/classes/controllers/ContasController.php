<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Despesa;

class ContasController {
    public function listar() {
        $conta = new Conta;
        $contas = $conta->listAll();
        $tipoConta = $conta->tipoConta();
        $pages = $conta->getNumPages();

        $_REQUEST['contas'] = $contas;
        $_REQUEST['tipoConta'] = $tipoConta;
        $_REQUEST['pages'] = $pages;

        if(isset($_GET['id']) || isset($_GET['add'])) {
            $this->editar();
        }

        if(isset($_GET['delete'])) {
            $conta->delete($_GET['delete']);
        }

        else {
            if(empty($_GET['add']) && empty($_GET['id']))
                require_once __DIR__ . '/../view/templates/display_conta.php';
        }
    }

    public function editar() {

        $conta = new Conta;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar =  $conta->select($id);
            $_REQUEST['editar'] = $editar;
        }

        $tipoConta = $conta->tipoConta();


        $_REQUEST['tipoConta'] = $tipoConta;

        require_once __DIR__ . '/../view/templates/edit_conta.php';

        if(isset($_POST['submit'])) {
            if(isset($_GET['id'])) {
                $conta->edit($id);
            }
            else {
                $conta->create();
            }
        }
    }

    public function transferir() {
        if(isset($_GET['transferir'])) {
            $conta = new Conta;
            $contaOrigem = $conta->select($_GET['transferir']);
            $_REQUEST['contaOrigem'] = $contaOrigem;
            $this->transferir();

            require_once __DIR__ . '/../view/templates/transferir_conta.php';
        }
    }
}