<?php

namespace app\public_html\templates;

use app\application\classes\controllers\ReceitaController;

require_once "../vendor/autoload.php";

$receita = new ReceitaController;


require_once "assets/templates/header.php";
$receita->listar();
require_once "assets/templates/footer.php";