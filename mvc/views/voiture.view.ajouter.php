<?php
ob_start();
?>
<form method="POST" action="<?= URL ?>voitures/ajouter-validation" enctype="multipart/form-data">
    <div class="form-group" >
        <label for="idvoit">Numero voiture :</label>
        <input type="text" class="form-control" id="idvoit" name="idvoit">
    </div>
    <div class="form-group">
        <label for="Design">Designation :</label>
        <input type="text" class="form-control" id="Design" name="design">
    </div>
    
    <div class="form-group">
        <input type="radio" class="list-item" id="simple" name="type" value="simple">
        <label for="simple">Simple</label>
        <input type="radio" class="list-item" id="idvoit" name="type" value="premium">
        <label for="premium">Premium</label>
        <input type="radio" class="list-item" id="idvoit" name="type" value="vip">
        <label for="vip">VIP</label>
    </div>
    <div class="form-group">
        <label for="nbrplace">Nombre de place:</label>
        <select class="form-select form-control" id="nbrplace" name="nbrplace"> 
            <option value="14">14</option>
            <option value="18">18</option>
            <option value="22">22</option>
        </select>
    </div>
    <div class="form-group">
        <label for="frais">Frais :</label>
        <input type="text" class="form-control" id="frais" name="frais">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Valider</button>
        <span style="visibility: hidden;">espace</span>
        <button type="submit" name="annuler" value="annuler" class="btn btn-danger">Annuler</button>
    </div>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout de voiture";
require "template.php";
?>