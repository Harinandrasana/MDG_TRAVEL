<?php
ob_start();
?>

<?= $msg ?>

<?php
$content = ob_get_clean();
$titre = "ERREUR 404 NOT FOUND";
require "template.php";
?>