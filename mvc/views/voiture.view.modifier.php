<?php
ob_start();
?>
<form method="POST" action="<?= URL ?>voitures/modifier-validation" enctype="multipart/form-data">
    <div class="form-group" >
        <label for="idvoit">Numero voiture :</label>
        <input type="text" class="form-control" id="idvoit" name="idvoit" value="<?= $voiture->getIdvoit()?>">
    </div>
    <div class="form-group">
        <label for="Design">Designation :</label>
        <input type="text" class="form-control" id="Design" name="design" value="<?= $voiture->getDesign()?>">
    </div>
    
    <div class="form-group">
        <p>
            <input type="radio" class=" list-item" id="simple" name="type" value="simple" checked>
            <label for="simple">Simple</label>
            <input type="radio" class="list-item" id="idvoit" name="type" value="premium">
            <label for="premium">Premium</label>
            <input type="radio" class="list-item" id="idvoit" name="type" value="vip">
            <label for="vip">VIP</label>
        </p>
    </div>
    <div class="form-group">
        <label for="nbrplace">Nombre de place:</label>
        <input type="text" class="form-control" id="nbrplace" name="nbrplace" value="<?= $voiture->getNbrPlace()?>" readonly>
    </div>
    <div class="form-group">
        <label for="frais">Frais :</label>
        <input type="text" class="form-control" id="frais" name="frais" value="<?= $voiture->getFrais()?>">
    </div>
    <input type="hidden" name="idendifiant" value="<?= $voiture->getIdvoit()?>">

    <div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <span style="visibility: hidden;">espace</span>
        <button type="submit" name="annuler" value="annuler" class="btn btn-danger">Annuler</button>
    </div>
</form>
<?php
$content = ob_get_clean();
$titre = "Modification de voitures ";
require "template.php";
?>