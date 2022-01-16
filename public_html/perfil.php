<?php

namespace app\public_html\templates;

use app\application\classes\controllers\PerfilController;

require_once "../vendor/autoload.php";

$perfil = new PerfilController;

require_once "assets/templates/header.php";
$perfil->listar();
require_once "assets/templates/footer.php";