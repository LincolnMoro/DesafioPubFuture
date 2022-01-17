<?php

namespace app\public_html\templates;

use app\application\classes\controllers\DespesasController;

require_once "../vendor/autoload.php";

//Iniciliza o controlador de despesas
$despesas = new DespesasController;

//Chama os arquivos de layout da página
require_once "assets/templates/header.php";
require_once "assets/templates/content.php";
//Renderiza o conteúdo da página
$despesas->listar();
//Chama o rodapé da página
require_once "assets/templates/footer.php";