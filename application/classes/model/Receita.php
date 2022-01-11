<?php

namespace app\application\classes\model;

use app\application\config\database;

class Receita {
    private string $descricao;
    private string $valor;
    private string $dataRecebimento;
    private string $dataRecebimentoEsperado;
    private string $conta;
    private $tipoReceita;

    public function setReceitas() {
        return $this->tipoReceita = [
            "salario" => "Salário", 
            "preesente" => "Presente",
            "premio" => "Prêmio",
            "outros" => "Outros",
        ];
    }

    public function listAll() {
        $db = new Connection;
        $query = "SELECT * FROM teste";
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return $executeQuery;
        }
        else {
            return die();
        }
    }


}