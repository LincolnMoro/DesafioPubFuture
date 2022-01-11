<?php

namespace app\public_html;

require_once "../vendor/autoload.php";

use app\application\classes\model\Receita;

$test = new Receita;

require_once "../application/classes/view/header.php";

require_once "../application/classes/view/widget.php";

require_once "../application/classes/view/content.php";

require_once "../application/classes/view/footer.php";
