<?php

namespace app\public_html\templates;

use app\application\classes\controllers\PerfilController;

require_once "../vendor/autoload.php";

$login = new PerfilController;

require_once "assets/templates/header.php";
$login->login();
require_once "assets/templates/footer.php";