<?php
/*
namespace app\public_html;

use app\application\classes\controllers\ContasController;
use app\application\classes\controllers\DespesasController;
use app\application\classes\controllers\ReceitaController;
use app\application\classes\controllers\PerfilController;

require_once "../vendor/autoload.php";

$receita = new ReceitaController;
$despesa = new DespesasController;
$conta = new ContasController;
$perfil = new PerfilController;
*/

//Chama os arquivos de layout da página
require_once "assets/templates/header.php";
require_once "assets/templates/content.php";
?>

<div class="resume">
    <h1>Sistema de gestão de Financias</h1>
    <p class="title">Seja bem vindo <?php echo $_SESSION['nome']; ?></p>
    <p class="summary">No menu lateral você pode navegar entre as opções do sistema de gestão de financias pessoais. Bom planejamento e boa financias :)</p>
</div>


<?php
//Chama o rodapé da página
require_once "assets/templates/footer.php";

?>