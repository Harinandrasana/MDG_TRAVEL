<?php
ob_start();
?>

<form method="POST" action="<?= URL ?>reservations/modifier-validation" enctype="multipart/form-data">

    <input type="hidden" name="idreserv" value="<?= $idreserv;?>">

    <div class="form-group">
        <label for="idvoit">Voiture :</label>
        <select class="form-select form-control" id="idvoit" name="idvoit"> 
        <?php 

            for ($i=0 ;$i < count($voitures); $i++) : 
        ?> 

            <option value="<?= $voitures[$i]->getIdvoit(); ?>" <?php if($reservation->getIdvoit() === $voitures[$i]->getIdvoit()) echo "selected"?>>
                <?= $voitures[$i]->getIdvoit();?>
                
            </option>

        <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="idcli">Client :</label>
        <select class="form-select form-control" id="idcli" name="idcli"> 
        <?php 

            for ($i=0 ;$i < count($clients); $i++) : 
        ?> 

            <option value="<?= $clients[$i]->getIdcli();?>" <?php if($reservation->getIdcli() === $clients[$i]->getIdcli()) echo "selected"?>>
                <?= $clients[$i]->getNom();?></option>

        <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="place">Place :</label>
        <input type="text" class="form-control" id="place" name="place" value="<?= $reservation->getPlace(); ?>">
    </div>
    
    <div class="form-group">
        <p>
        <input type="radio" class="list-item" id="" name="payment" value="avec avance">
        <label for="avec avance">avec avance</label>

        <input type="radio" class="list-item mx-4" id="" name="payment" value="sans avance" checked>
        <label for="avec avance">sans avance</label>

        <input type="radio" class="list-item mx-4" id="" name="payment" value="Tout paye">
        <label for="Tout paye">Tout paye</label>
        </p>
    </div>
<!--
    <div class="form-group">
        <label for="date_voyage">Date de depart:</label>
        <input type="text" class="form-control" id="date_voyage" name="date_voyage" value="<?= $reservation->getDate_voyage(); ?>">
    </div>
-->

    <div class="form-group">
        <label for="date_voyage">Date de depart:</label>
        <input type="datepicker" class="form-control" id="date_voyage" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="date_voyage" value="<?= $reservation->getDate_voyage(); ?>">
    </div>

    <div class="form-group">
        <label for="montant_avance">Montant d'avance :</label>
        <input type="text" class="form-control" id="montant_avance" name="montant_avance" value="<?= $reservation->getMontant_avance(); ?>">
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <span style="visibility: hidden;">espace</span>
        <button type="submit" name="annuler" value="annuler" class="btn btn-danger">Annuler</button>
    </div>
</form>

<script type="">
    document.getElementById("place").addEventListener("change", function(event) {
        var initialIdvoit = "<?php echo $reservation->getIdvoit();?>";
        var initialPlace = "<?php echo $reservation->getPlace();?>";

        console.log("place = ");
        console.log(initialPlace);
        console.log("idvoit = ");
        console.log(initialIdvoit);

        var inputVoit = document.getElementById("idvoit");

        var idvoit = inputVoit.value;

        var inputPlace = event.target;
        var place = inputPlace.value;

        if(place == initialPlace && idvoit == initialIdvoit)
        {
            return;
        }
        else
        {
            $.ajax({
            url: "/mvc/voitures/disponibilite/" + idvoit + "/" + place, // URL of the PHP script
            type: "GET", // HTTP method (GET, POST, etc.)
            success: function(data) { // Callback function to handle the response
              // Display the response in the result div
              //$("#result").html(data);
              if(data.est_disponible === false)
              {
                alert("cette place est deja occuppee");
              }
              console.log(data);
            },
            error: function(xhr, status, error) { // Callback function to handle errors
              console.log("Error: " + error);
            }
        });
        }

    });

</script>
<?php
$content = ob_get_clean();
$titre = "Modification du reservation: RE".$idreserv;
require "template.php";
?>
