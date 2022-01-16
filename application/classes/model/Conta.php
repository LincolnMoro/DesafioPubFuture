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
    private $saldoTotal;

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
                header("Location:contas.php");
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
                header("Location:contas.php?id={$this->id}");
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
                header("Location:contas.php");
            }
        }
    }

    public function transferir($origem) {
        if(isset($_POST['submit'])) {
            $this->contaDestino = $_POST['contaDestino'];
            $this->valorTransferir = $_POST['valor'];

            $saldoOrigem = $this->getSaldo($origem);
            $saldoDestino = $this->getSaldo($this->contaDestino);

            $this->setSaldo($saldoOrigem - $this->valorTransferir, $origem);
            $this->setSaldo($saldoDestino + $this->valorTransferir, $this->contaDestino);

            return header("Location:contas.php");
        }
    }

    public function getSaldo($conta) {
        $contaDados = $this->select($conta);
        return $contaDados['saldo'];
    }

    public function setSaldo($valor, $conta) {
        $db = new Connection;

        $query = "UPDATE contas SET saldo='{$valor}' WHERE id='{$conta}'";
        $executeQuery = mysqli_query($db->connect(), $query);

        if(!$executeQuery) {
            die("Error: " . $db->connect->connect_error);
        }
    }

    //Grava os dados da variável POST nos atributos da classe
    private function setPost($post) {
        $this->saldo = 0;
        $this->instituicaoFinanceira = $post['instituicaoFinanceira'];
        $this->titular = $post['titular'];
        $this->conta = $post['conta'];
        $this->tipoConta = $post['tipoConta'];
    }

    public function getSaldoTotal() {
        $db = new Connection;

        $query = "SELECT * FROM contas";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            foreach ($executeQuery as $conta) {
                number_format($this->saldoTotal);
                $this->saldoTotal = $this->saldoTotal + $conta['saldo'];
            }
            return $this->saldoTotal;
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }
}