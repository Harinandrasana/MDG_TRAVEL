<?php
ob_start();
?>
<form method="post" action="<?= URL ?>reservations/ajouter-validation" enctype="multipart/form-data">
    <div class="form-group">
        <label for="idvoit">Voiture :</label>
        <select class="form-select form-control" id="idvoit" name="idvoit"> 
        <?php 

            for ($i=0 ;$i < count($voitures); $i++) : 
        ?> 

            <option value="<?= $voitures[$i]->getIdvoit(); ?>"><?= $voitures[$i]->getIdvoit();?></option>

        <?php endfor;?>
        </select>
    </div>

    <div class="form-group">
        <label for="idcli">Client :</label>
        <select class="form-select form-control" id="idcli" name="idcli"> 
        <?php 

        for ($i=0 ;$i < count($clients); $i++) : 
        ?> 
            <option value="<?= $clients[$i]->getIdcli(); ?>"><?= $clients[$i]->getNom();?></option>       
        <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="place">Place :</label>
        <input type="text" class="form-control" id="place" name="place">
    </div>
    
    <div class="form-group">
        <p>
        <input type="radio" class="list-item" id="" name="payment" value="avec avance">
        <label for="avec avance">avec avance</label>
        <input type="radio" class="mx-4 list-item" id="" name="payment" value="sans avance">
        <label for="avec avance">sans avance</label>
        <input type="radio" class="mx-4 list-item" id="" name="payment" value="Tout paye">
        <label for="Tout paye">Tout paye</label>
        </p>
    </div>

    <div class="form-group">
        <label for="date_voyage">Date de depart:</label>
        <input type="datepicker" class="form-control" id="date_voyage" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="date_voyage">
    </div>

    <div class="form-group">
        <label for="montant_avance">Montant d'avance :</label>
        <input type="text" class="form-control" id="montant_avance" name="montant_avance">
    </div>
    <div>
        <button type="submit" name="valider" value="valider" class="btn btn-primary">Valider</button>
        <span style="visibility: hidden;">espace</span>
        <button type="submit" name="annuler" value="annuler" class="btn btn-danger">Annuler</button>
    </div>
</form>
<script type="">
    document.getElementById("place").addEventListener("change", function(event) {
        var inputVoit = document.getElementById("idvoit");

        var idvoit = inputVoit.value;

        var inputPlace = event.target;
        var place = inputPlace.value;
        console.log(idvoit);
        console.log(place);

        $.ajax({
            url: "/mvc/voitures/disponibilite/" + idvoit + "/" + place, 
            type: "GET", 
            success: function(data) { 
              if(data.est_disponible === false)
              {
                alert("cette place est deja occuppee");
              }
              console.log(data);
            },
            error: function(xhr, status, error) {
              console.log("Error: " + error);
            }
        });
    });

</script>
<?php
$content = ob_get_clean();
$titre = "Faire une reservation";
require "template.php";
?>