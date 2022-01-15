<?php

namespace app\application\classes\model;

use app\application\config\Connection;
use app\application\utils\Paginator;

class Despesa
{
    private float $valor;
    private string $dataPagamento;
    private string $dataPagamentoEsperado;
    private int $conta;
    private $tipoDespesa;
    private string $dataDe;
    private string $dataAte;
    private string $tipoFiltro;
    private $numRows;
    private int $numPages;

    public function getNumPages() {
        return $this->numPages;
    }

    //Define os valores padrão para tipos de receitas
    public function setDespesas() {
        return $this->tipoDespesa = [
            "alimentacao" => "Alimentação",
            "educacao" => "Educação",
            "lazer" => "Lazer",
            "moradia" => "Moradia",
            "roupa" => "Roupa",
            "saude" => "Saúde",
            "transporte" => "Transporte",
            "outros" => "Outros",
        ];
    }

    //Retorna tipos de despesas padrão
    public function tipoDespesa() {
        $this->setDespesas();
        return $this->tipoDespesa;
    }

    //Lista todas as despesas para exibição na página
    public function listAll() {
        $db = new Connection;
        $pager = new Paginator;
        $offset = $pager->offset();
        $this->dataDe = $_GET['de'] ?? "0000-00-00";
        $this->dataAte = $_GET['ate'] ?? "9999-12-31";
        $this->tipoFiltro = $_GET['tipo'] ?? "tipoDespesa";
        $query = "SELECT * FROM despesas WHERE dataPagamento BETWEEN '{$this->dataDe}' AND ('{$this->dataAte}') OR tipoDespesa='{$this->tipoFiltro}' LIMIT {$offset}, 10";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            $this->numRows = mysqli_num_rows($executeQuery);
            $this->numPages = $pager->totalPages($this->numRows);
            return $executeQuery;
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }

    //Seleciona receita individual com base no ID
    public function select($id) {
        $this->id = $id;
        $db = new Connection;
        $query = "SELECT * FROM despesas WHERE id='{$this->id}'";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return mysqli_fetch_assoc($executeQuery);
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }

    //Registra nova receita no banco de dados
    public function create() {
        if(isset($_POST['submit'])) {
            $post = $_POST;
            $this->setPost($post);

            $db = new Connection;
            $query = "INSERT INTO despesas (valor, dataPagamento, dataPagamentoEsperado, conta, tipoDespesa)
            VALUES (
                '{$this->valor}',
                '{$this->dataPagamento}',
                '{$this->dataPagamentoEsperado}',
                '{$this->conta}',
                '{$this->tipoDespesa}'
            )";

            $executeQuery = mysqli_query($db->connect(), $query);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:index.php");
            }
        }
        else {
            echo "Erro na solicitação";
        }
    }

    //Edita o cadastro da receita com base no ID da receita
    public function edit($id) {
        if(isset($_POST['submit'])) {
            $post = $_POST;
            $this->setPost($post);
            $this->id = $id;

            $db = new Connection;
            $query = "UPDATE despesas SET
            valor='{$this->valor}',
            dataPagamento='{$this->dataPagamento}',
            dataPagamentoEsperado='{$this->dataPagamentoEsperado}',
            conta='{$this->conta}',
            tipoDespesa='{$this->tipoDespesa}'
            WHERE id='{$this->id}' ";

            $executeQuery = mysqli_query($db->connect(), $query);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:index.php?id={$this->id}");
            }
        }
    }

    public function delete($id) {
        if(isset($_GET['delete'])) {
            $db = new Connection;
            $this->id = $id;
            $query = "DELETE FROM despesas WHERE id={$this->id}";

            $executeQuery = mysqli_query($db->connect(), $query);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:index.php");
            }
        }
    }

    public function getConta() {
        $db = new Connection;
        $query = "SELECT * FROM contas";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            //return mysqli_fetch_assoc($executeQuery);
            return $executeQuery;
        }
        else {
            return die();
        }
    }

    //Grava os dados da variável POST nos atributos da classe
    private function setPost($post) {
        $this->valor = $post['valor'];
        $this->dataPagamento = $post['dataPagamento'];
        $this->dataPagamentoEsperado = $post['dataPagamentoEsperado'];
        $this->conta = $post['conta'];
        $this->tipoDespesa = $post['tipoDespesa'];
    }
}