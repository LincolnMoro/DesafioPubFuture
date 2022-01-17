<?php

namespace app\public_html\templates;

use app\application\classes\controllers\PerfilController;

require_once "../vendor/autoload.php";

//Iniciliza o controlador de perfil
$login = new PerfilController;

//Inicializa a sessão após o login
session_start();

//Renderiza o conteúdo da página
$login->login();