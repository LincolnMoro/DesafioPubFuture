<?php

namespace app\application\classes\model;

use app\application\config\Connection;
use app\application\utils\Paginator;

class Conta {
    private float $saldo;
    private $tipoConta;
    private string $instituicaoFinanceira;
    private int $conta;
    private $titular;
    private $contaOrigem;
    private $contaDestino;
    private $valorTransferir;
    private $contaTemp;
    private $numRows;
    private int $numPages;
    private $saldoTemp;

    public function getNumPages() {
        return $this->numPages;
    }

    //Define os valores padrão para tipos de receitas
    public function setTipoConta() {
        return $this->tipoConta = [
            "carteira" => "Carteira",
            "conta corrente" => "Conta Corrente",
            "poupanca" => "Poupança",
        ];
    }

    //Retorna tipos de despesas padrão
    public function tipoConta() {
        $this->setTipoConta();
        return $this->tipoConta;
    }

    //Lista todas as despesas para exibição na página
    public function listAll() {
        $db = new Connection;
        $pager = new Paginator;
        $offset = $pager->offset();
        $query = "SELECT * FROM contas LIMIT {$offset}, 10";
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
        $query = "SELECT * FROM contas WHERE id='{$this->id}'";
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
            $query = "INSERT INTO contas (saldo, instituicaoFinanceira, titular, conta, tipoConta)
            VALUES (
                0,
                '{$this->instituicaoFinanceira}',
                '{$this->titular}',
                '{$this->conta}',
                '{$this->tipoConta}'
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
            $query = "UPDATE contas SET
            instituicaoFinanceira='{$this->instituicaoFinanceira}',
            titular='{$this->titular}',
            conta='{$this->conta}',
            tipoConta='{$this->tipoConta}'
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
            $query = "DELETE FROM contas WHERE id={$this->id}";

            $executeQuery = mysqli_query($db->connect(), $query);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:index.php");
            }
        }
    }

    public function transferir() {
        if(isset($_POST['submit'])) {
            $id = $_POST['id_origem'];

            $db = new Connection;
            $this->contaOrigem = $_POST['id_origem'];
            $this->contaDestino = $_POST['id_destino'];
            $this->valorTransferir = $_POST['valor'];

            $saldoOrigem = $this->getSaldo($this->contaOrigem);
            $saldoDestino = $this->getSaldo($this->contaDestino);

            $this->setSaldo($saldoOrigem - $this->valorTransferir, $this->contaOrigem);
            $this->setSaldo($saldoDestino + $this->valorTransferir, $this->contaDestino);
        }
    }

    private function getSaldo($conta) {
        $db = new Connection;
        $this->contaTemp = $conta;
        $getSaldo = "SELECT saldo FROM contas WHERE id='{$this->contaTemp}'";
        $execGetSaldo = mysqli_query($db->connect(), $getSaldo);
        if(!$execGetSaldo) {
            die("Error: " . $db->connect->connect_error);
        }
        else {
            return $execGetSaldo;
        }
    }

    private function setSaldo($conta, $valor) {
        $db = new Connection;
        $this->contaTemp = $conta;
        $this->saldoTemp = $valor;

        $query = "UPDATE contas SET saldo='{$this->saldoTemp}' WHERE id='{$this->contaTemp}'";
        $executeQuery = mysqli_query($db->connect(), $query);

        if(!$executeQuery) {
            die("Error: " . $db->connect->connect_error);
        }
    }

    //Grava os dados da variável POST nos atributos da classe
    private function setPost($post) {
        $this->saldo = $post['saldo'];
        $this->instituicaoFinanceira = $post['instituicaoFinanceira'];
        $this->titular = $post['titular'];
        $this->conta = $post['conta'];
        $this->tipoConta = $post['tipoConta'];
    }
}