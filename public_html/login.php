<?php

namespace app\public_html\templates;

use app\application\classes\controllers\PerfilController;

require_once "../vendor/autoload.php";

$login = new PerfilController;
session_start();
//require_once "../public_html/assets/templates/header.php";
$login->login();