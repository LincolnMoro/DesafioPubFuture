<?php

namespace app\public_html\templates;

use app\application\classes\controllers\ContasController;

require_once "../vendor/autoload.php";

$contas = new ContasController;

require_once "assets/templates/header.php";
$contas->listar();
require_once "assets/templates/footer.php";