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

    //Retorna o número de páginas para o sistema de paginação
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

    //Retorna tipos de receita padrão
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

        //Retorna o número de linhas para o sistema de paginação
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

            //Atualiza o saldo da conta selecionada com base no valor da receita
            $contaUpdate = new Conta;
            $saldo = $contaUpdate->getSaldo($this->conta);
            number_format($this->valor);
            $contaUpdate->setSaldo($saldo + $this->valor, $this->conta);

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                //header("Location:receitas.php");
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

            //Atualiza o saldo da conta selecionada com base no valor atualizado da receita
            $contaUpdate = new Conta;
            $saldo = $contaUpdate->getSaldo($this->conta);
            if($valorAtual > $this->valor) {
                $saldoAtualizar = $valorAtual - $this->valor;
                $contaUpdate->setSaldo($saldo - $saldoAtualizar, $this->conta);
            }
            else {
                $saldoAtualizar = $this->valor - $valorAtual;
                $contaUpdate->setSaldo($saldo + $saldoAtualizar, $this->conta);
            }

            if(!$executeQuery) {
                die("Error: " . $db->connect->connect_error);
            }
            else {
                //Direciona o usuário para a página de listagem padrão
                header("Location:receitas.php?id={$this->id}");
            }
        }
    }

    //Remove receita do banco de dados com base no ID
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

    //Lista as contas para seleção no cadastro da receita
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

    //Retorna o número total de receitas
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