<?php
ob_start();
?>

ici la page d'Accueil
<?php
$content = ob_get_clean();
$titre = "GARAGE COMPANY";
require "template1.php";
?>