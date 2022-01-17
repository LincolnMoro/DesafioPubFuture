<?php

namespace app\public_html\templates;

use app\application\classes\controllers\DespesasController;

require_once "../vendor/autoload.php";

$despesas = new DespesasController;

require_once "assets/templates/header.php";
require_once "assets/templates/content.php";
$despesas->listar();
require_once "assets/templates/footer.php";