<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Conta;

class ContasController {

    //Lista todas as contas e opções de filtragem e edição
    public function listar() {
        $conta = new Conta;
        $contas = $conta->listAll();
        //Retorna os tipos de conta padrão
        $tipoConta = $conta->tipoConta();

        //Retorna o número de páginas para o sistema de paginação
        $pages = $conta->getNumPages();

        $_REQUEST['contas'] = $contas;
        $_REQUEST['tipoConta'] = $tipoConta;
        $_REQUEST['pages'] = $pages;

        //Chama a página de edição
        if(isset($_GET['id']) || isset($_GET['add'])) {
            $this->editar();
        }

        //Deleta conta do banco de dados
        if(isset($_GET['delete'])) {
            $conta->delete($_GET['delete']);
        }

        //Chama a página de transferência de saldo
        if(isset($_GET['transferir'])) {
            $this->transferir();
        }

        //Página de exibição de contas padrão
        else {
            if(empty($_GET['add']) && empty($_GET['id']))
                require_once __DIR__ . '/../view/templates/display_conta.php';
        }
    }

    //Método de chamada a página de edição caso o parâmetro GET ID esteja setado
    public function editar() {

        $conta = new Conta;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            //Seleciona a conta para edição com base no ID do banco de dados
            $editar =  $conta->select($id);
            $_REQUEST['editar'] = $editar;
        }

        //$tipoConta = $conta->tipoConta();
        //$_REQUEST['tipoConta'] = $tipoConta;

        require_once __DIR__ . '/../view/templates/edit_conta.php';

        if(isset($_POST['submit'])) {
            //Determina que a ação será de edição de uma conta existente
            if(isset($_GET['id'])) {
                $conta->edit($id);
            }
            else {
                //Determina que a ação será a criação de uma nova conta
                $conta->create();
            }
        }
    }

    //Carrega a página de transferência de saldo
    public function transferir() {
        if(isset($_GET['transferir'])) {
            $conta = new Conta;
            $contaOrigem = $conta->select($_GET['transferir']);
            $_REQUEST['contaOrigem'] = $contaOrigem;
        }

        if(isset($_POST['submit'])) {
            $conta->transferir($_GET['transferir']);
        }

        require_once __DIR__ . '/../view/templates/transferir_conta.php';
    }
}