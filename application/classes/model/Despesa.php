<?php

namespace app\application\classes\model;

use app\application\classes\model\Conta;
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

    //Retorna o número de páginas para o sistema de paginação
    public function getNumPages() {
        return $this->numPages;
    }

    //Define os valores padrão para tipos de despesas
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

    //Seleciona despesa individual com base no ID
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

    //Registra nova despesa no banco de dados
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

            //Atualiza o saldo da conta selecionada com base no valor da despesa
            $contaUpdate = new Conta;
            $saldo = $contaUpdate->getSaldo($this->conta);
            number_format($this->valor);
            $contaUpdate->setSaldo($saldo - $this->valor, $this->conta);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                //header("Location:despesas.php");
            }
        }
        else {
            echo "Erro na solicitação";
        }
    }

    //Edita o cadastro da despesa com base no ID
    public function edit($id, $valorAtual) {
        if(isset($_POST['submit'])) {
            $post = $_POST;
            //Envia os dados da variável POST para os atributos da classe
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

            //Atualiza o saldo da conta selecionada com base no valor atualizado da despesa
            $contaUpdate = new Conta;
            $saldo = $contaUpdate->getSaldo($this->conta);
            if($valorAtual > $this->valor) {
                $saldoAtualizar = $valorAtual - $this->valor;
                $contaUpdate->setSaldo($saldo + $saldoAtualizar, $this->conta);
            }
            else {
                $saldoAtualizar = $this->valor - $valorAtual;
                $contaUpdate->setSaldo($saldo - $saldoAtualizar, $this->conta);
            }

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:despesas.php?id={$this->id}");
            }
        }
    }

    //Remove despesa do banco de dados com base no ID
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
                //Envia o usuário para a tela de listagem após o cadastro
                header("Location:despesas.php");
            }
        }
    }

    //Retorna as contas para cadastro da despesa
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

    //Retorna o número total de despesas
    public function getTotalDespesas() {
        $db = new Connection;
        $query = "SELECT * FROM despesas";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            $totalDepsesas = mysqli_num_rows($executeQuery);
            return $totalDepsesas;
        }
    }
}