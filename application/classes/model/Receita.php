<?php

namespace app\application\classes\model;

use app\application\config\Connection;

class Receita {
    private string $descricao;
    private float $valor;
    private string $dataRecebimento;
    private string $dataRecebimentoEsperado;
    private int $conta;
    private $tipoReceita;
    private int $id;

    //Define os valores padrão para tipos de receitas
    public function setReceitas() {
        return $this->tipoReceita = [
            "salario" => "Salário", 
            "preesente" => "Presente",
            "premio" => "Prêmio",
            "outros" => "Outros",
        ];
    }

    //Retorna tipos de receeita padrão
    public function tiposReceita() {
        $this->setReceitas();
        return $this->tipoReceita;
    }

    //Lista todas as receitas para exibição na página
    public function listAll() {
        $db = new Connection;
        $query = "SELECT * FROM receitas";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return $executeQuery;
        }
        else {
            return die();
        }
    }

    //Seleciona receita individual com base no ID
    public function select($id) {
        $db = new Connection;
        $query = "SELECT * FROM receitas WHERE id='{$this->id}'";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return $executeQuery;
        }
        else {
            return die();
        }
    }

    //Registra nova receita no banco de dados
    public function create() {
        if(isset($_POST['submit'])) {
            $post = $_POST;
            $this->setPost($post);

            $db = new Connection;
            $query = "INSERT INTO receitas ('valor', 'dataRecebimento', 'dataRecebimentoEsperado', 'descricao', 'conta', 'tipoReceita')
            VALUES (
                '{$this->valor}',
                '{$this->dataRecebimento}',
                '{$this->dataRecebimentoEsperado}',
                '{$this->descricao}',
                '{$this->conta}',
                '{$this->tipoReceita}',
            )";
        }
        else {
            return "Erro na solicitação";
        }
    }

    //Edita o cadastro da receita com base no ID da receita
    public function edit($id) {
        if(isset($_POST['submit'])) {
            $post = $_POST;
            $this->setPost($post);

            $db = new Connection;
            $query = "UPDATE receitas SET
            valor='{$this->valor}',
            dataRecebimento='{$this->dataRecebimento}',
            dataRecebimentoEsperado='{$this->dataRecebimentoEsperado}',
            descricao='{$this->descricao}',
            conta='{$this->conta}',
            tipoReceita='{$this->tipoReceita}',
            WHERE id='{$this->id}';
        ";
        }
        else {
            return "Erro na solicitação";
        }
    }

    //Grava os dados da variável POST nos atributos da classe
    private function setPost($post) {
        $this->valor = $post['valor'];
        $this->dataRecebimento = $post['dataRecebimento'];
        $this->dataRecebimentoEsperado = $post['dataRecebimentoEsperado'];
        $this->descricao = $post['descricao'];
        $this->conta = $post['conta'];
        $this->tipoReceita = $post['tipoReceita'];
        $this->id = $post['id'];
    }

}