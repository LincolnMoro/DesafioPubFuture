<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Despesa;

class DespesasController {

    //Lista todas as despesas e opções de filtragem e edição
    public function listar() {
        $despesa = new Despesa;
        $despesas = $despesa->listAll();
        $tipoDespesa = $despesa->tipoDespesa();

        //Retorna o número de páginas para o sistema de paginação
        $pages = $despesa->getNumPages();

        $_REQUEST['despesas'] = $despesas;
        $_REQUEST['tipoDespesa'] = $tipoDespesa;
        $_REQUEST['pages'] = $pages;

        //Chama a página de edição
        if(isset($_GET['id']) || isset($_GET['add'])) {
            $this->editar();
        }

        //Deleta despesa do banco de dados
        if(isset($_GET['delete'])) {
            $despesa->delete($_GET['delete']);
        }

        else {
            if(empty($_GET['add']) && empty($_GET['id']))
                require_once __DIR__ . '/../view/templates/display_despesa.php';
        }
    }

    //Método de chamada a página de edição caso o parâmetro GET ID esteja setado
    public function editar() {

        $despesa = new Despesa;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            //Seleciona a despesa para edição com base no ID do banco de dados
            $editar =  $despesa->select($id);
            $_REQUEST['editar'] = $editar;
        }

        //Retorna os tipos de despesa padrão
        $tipoDespesa = $despesa->setDespesas();
        $contas = $despesa->getConta();


        $_REQUEST['tipoDespesa'] = $tipoDespesa;
        $_REQUEST['contas'] = $contas;

        require_once __DIR__ . '/../view/templates/edit_despesa.php';

        if(isset($_POST['submit'])) {
            //Determina que a ação será de edição de uma despesa existente
            if(isset($_GET['id'])) {
                $despesa->edit($id, $editar['valor']);
            }
            else {
                //Determina que a ação será a criação de uma nova despesa
                $despesa->create();
            }
        }
    }
}