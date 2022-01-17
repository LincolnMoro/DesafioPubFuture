<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Receita;

class ReceitaController {

    //Lista todas as receitas e opções de filtragem e edição
    public function listar() {
        $receita = new Receita;
        $receitas = $receita->listAll();
        //Retorna os tipos de receita padrão
        $tiposReceita = $receita->tiposReceita();
        //Retorna o número de páginas para o sistema de paginação
        $pages = $receita->getNumPages();

        $_REQUEST['receitas'] = $receitas;
        $_REQUEST['tiposReceita'] = $tiposReceita;
        $_REQUEST['pages'] = $pages;

        //Chama a página de edição
        if(isset($_GET['id']) || isset($_GET['add'])) {
            $this->editar();
        }

        //Deleta receita do banco de dados
        if(isset($_GET['delete'])) {
            $receita->delete($_GET['delete']);
        }

        //Página de exibição de receitas padrão
        else {
            if(empty($_GET['add']) && empty($_GET['id']))
            require_once __DIR__ . '/../view/templates/display_receita.php';
        }
    }

    //Método de chamada a página de edição caso o parâmetro GET ID esteja setado
    public function editar() {

        $receita = new Receita;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            //Seleciona a receita para edição com base no ID do banco de dados
            $editar =  $receita->select($id);
            $_REQUEST['editar'] = $editar;
        }

        //$tiposReceita = $receita->tiposReceita();
        $contas = $receita->getConta();


        //$_REQUEST['tiposReceita'] = $tiposReceita;
        $_REQUEST['contas'] = $contas;

        require_once __DIR__ . '/../view/templates/edit_receita.php';

        if(isset($_POST['submit'])) {
            //Determina que a ação será de edição de uma receita existente
            if(isset($_GET['id'])) {
                $receita->edit($id, $editar['valor']);
            }
            else {
                //Determina que a ação será a criação de uma nova receita
                $receita->create();
            }
        }
    }
}
