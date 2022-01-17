<?php

namespace app\public_html\templates;

use app\application\classes\controllers\ContasController;

require_once "../vendor/autoload.php";

//Iniciliza o controlador de contas
$contas = new ContasController;

//Chama os arquivos de layout da página
require_once "assets/templates/header.php";
require_once "assets/templates/content.php";
//Renderiza o conteúdo da página
$contas->listar();

//Chama o rodapé da página
require_once "assets/templates/footer.php";