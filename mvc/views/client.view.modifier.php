<?php
ob_start();
?>
<form method="POST" action="<?= URL ?>clients/modifier-valider" enctype="multipart/form-data">

        <input type="hidden" class="form-control" id="idcli" name="idcli" value="<?= $client->getIdcli(); ?>">

    <div class="form-group" >
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $client->getNom(); ?>">
    </div>
    <div class="form-group">
        <label for="numtel">Tel :</label>
        <input type="text" class="form-control" id="numtel" name="numtel" value="<?= $client->getNumtel(); ?>">
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <span style="visibility: hidden;">espace</span>
        <button type="submit" name="annuler" value="annuler" class="btn btn-danger">Annuler</button>
    </div>
</form>
<?php
$content = ob_get_clean();
$titre = "Modification de client :";
require "template.php";
?>