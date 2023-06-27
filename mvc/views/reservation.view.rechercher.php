<?php
ob_start();
?>
<form method="POST" action="<?= URL ?>reservations/rechercher-validation" enctype="multipart/form-data">
    <div class="form-group">
        <label for="idvoit">Voiture :</label>
        <select class="form-select form-control" id="idvoit" name="idvoit"> 
        <?php 

            for ($i=0 ;$i < count($voitures); $i++) : 
        ?> 

            <option value="<?= $voitures[$i]->getIdvoit(); ?>"><?= $voitures[$i]->getIdvoit();?></option>
        <?php endfor; ?>
        </select>
    </div>
    
    <div class="form-group">
        <p>
        <input type="radio" class="list-item" name="payment" value="avec avance" id="r">
        <label for="r">avec avance</label>
        <input type="radio" class="list-item" name="payment" value="sans avance" id="n">
        <label for="n">sans avance</label>
        <input type="radio" class="list-item" name="payment" value="Tout paye" id="b">
        <label for="b">Tout paye</label>
        </p>
    </div>

    <div class="form-group" id="myElement" style="visibility: hidden;">
        <p>
        <input type="radio" class="list-item" name="regle" value="avec avance" id="radio4">
        <label for="radio4">Tout regler</label>
        <input type="radio" class="list-item"  name="nonRegle" value="sans avance" id="radio5">
        <label for="radio5">Avec reste</label>
        </p>
    </div>

    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<script type="">
    var radio1 = document.getElementById("r");
    var radio2 = document.getElementById("n");
    var radio3 = document.getElementById("b");
    var element = document.getElementById("myElement");

    radio3.addEventListener('change', function() {
      if (radio3.checked) {
        element.style.visibility = 'hidden';
        console.log("reussie3");
      }
      else
      {
        console.log("echec3");
      }
    });
    
    
    radio1.addEventListener('change', function() {

      if (radio1.checked) {
        element.style.visibility = 'visible'; 
        console.log("reussie1");
      } else {
        element.style.display = 'hidden';
        console.log("echec1");
      }
    });

    radio2.addEventListener('change', function() {
      if (radio2.checked) {
        element.style.visibility = 'visible';
        console.log("reussie2");
      } else {
        element.style.visibility = 'hidden';
        console.log("echec2");
      }
    });

</script>

<?php
$content = ob_get_clean();
$titre = "Faire une reservation";
require "template.php";
?>