<?php

namespace app\application\classes\model;

use app\application\config\Connection;
use app\application\utils\Paginator;

class Receita {
    private string $descricao;
    private float $valor;
    private string $dataRecebimento;
    private string $dataRecebimentoEsperado;
    private int $conta;
    private $tipoReceita;
    private string $dataDe;
    private string $dataAte;
    private string $tipoFiltro;
    private $numRows;
    private int $numPages;

    public function getNumPages() {
        return $this->numPages;
    }

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
        $pager = new Paginator;
        $offset = $pager->offset();
        $this->dataDe = $_GET['de'] ?? "0000-00-00";
        $this->dataAte = $_GET['ate'] ?? "9999-12-31";
        $this->tipoFiltro = $_GET['tipo'] ?? "tipoReceita";
        $query = "SELECT * FROM receitas WHERE dataRecebimento BETWEEN '{$this->dataDe}' AND ('{$this->dataAte}') OR tipoReceita='{$this->tipoFiltro}' LIMIT {$offset}, 10";
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
        $query = "SELECT * FROM receitas WHERE id='{$this->id}'";
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
            $query = "INSERT INTO receitas (valor, dataRecebimento, dataRecebimentoEsperado, descricao, conta, tipoReceita)
            VALUES (
                '{$this->valor}',
                '{$this->dataRecebimento}',
                '{$this->dataRecebimentoEsperado}',
                '{$this->descricao}',
                '{$this->conta}',
                '{$this->tipoReceita}'
            )";

            $executeQuery = mysqli_query($db->connect(), $query);

            $contaUpdate = new Conta;
            $saldo = $contaUpdate->getSaldo($this->conta);
            number_format($this->valor);
            $contaUpdate->setSaldo($this->conta, $saldo + $this->valor);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:receitas.php");
            }
        }
        else {
            echo "Erro na solicitação";
        }
    }

    //Edita o cadastro da receita com base no ID da receita
    public function edit($id, $valorAtual) {
        if(isset($_POST['submit'])) {
            $post = $_POST;
            $this->setPost($post);
            $this->id = $id;

            $db = new Connection;
            $query = "UPDATE receitas SET
            valor='{$this->valor}',
            dataRecebimento='{$this->dataRecebimento}',
            dataRecebimentoEsperado='{$this->dataRecebimentoEsperado}',
            descricao='{$this->descricao}',
            conta='{$this->conta}',
            tipoReceita='{$this->tipoReceita}'
            WHERE id='{$this->id}' ";

            $executeQuery = mysqli_query($db->connect(), $query);

            $contaUpdate = new Conta;
            $saldo = $contaUpdate->getSaldo($this->conta);
            if($valorAtual > $this->valor) {
                $saldoAtualizar = $valorAtual - $this->valor;
                $contaUpdate->setSaldo($this->conta, $saldo - $saldoAtualizar);
            }
            else {
                $saldoAtualizar = $this->valor - $valorAtual;
                $contaUpdate->setSaldo($this->conta, $saldo + $saldoAtualizar);
            }

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:receitas.php?id={$this->id}");
            }
        }
    }

    public function delete($id) {
        if(isset($_GET['delete'])) {
            $db = new Connection;
            $this->id = $id;
            $query = "DELETE FROM receitas WHERE id={$this->id}";

            $executeQuery = mysqli_query($db->connect(), $query);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                header("Location:receitas.php");
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
            die("Error: " . $db->connect->connect_error);
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
    }

    public function getTotalDespesas() {
        $db = new Connection;
        $query = "SELECT * FROM receitas";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            $totalReceitas = mysqli_num_rows($executeQuery);
            return $totalReceitas;
        }
    }

}