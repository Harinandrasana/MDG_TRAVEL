<?php
ob_start();
?>
<form method="POST" action="<?= URL ?>clients/ajouter-valider" enctype="multipart/form-data">
    <div class="form-group" >
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="form-group">
        <label for="numtel">Tel :</label>
        <input type="text" class="form-control" id="numtel" name="numtel">
    </div>
    <div>
    	<button type="submit" class="btn btn-primary">Valider</button>
    	<span style="visibility: hidden;">espace</span>
        <button type="submit" name="annuler" value="annuler" class="btn btn-danger">Annuler</button>
    </div>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout de client :";
require "template.php";
?>