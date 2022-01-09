<?php

namespace app\application\classes\model;

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
}