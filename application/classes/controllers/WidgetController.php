<?php

namespace app\application\classes\controllers;

use app\application\classes\model\Conta;
use app\application\classes\model\Despesa;
use app\application\classes\model\Receita;

class WidgetController
{
    //Lista o número total de receitas, despesas e o saldo total
    public function listar() {
        $conta = new Conta;
        $despesa = new Despesa;
        $receita = new Receita;

        $saldoTotal = $conta->getSaldoTotal();
        $totalDepsesas = $despesa->getTotalDespesas();
        $totalReceitas = $receita->getTotalDespesas();

        $_REQUEST['saldoTotal'] = $saldoTotal;
        $_REQUEST['totalDepsesas'] = $totalDepsesas;
        $_REQUEST['totalReceitas'] = $totalReceitas;

        //Chama o template do widget
        require_once __DIR__ . '/../view/templates/widget.php';
    }
}