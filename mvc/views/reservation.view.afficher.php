<?php 
ob_start();

if(!empty($_SESSION['alert'])) :
 ?>
<div calsse="alert alert<-<?= $_SESSION['alert']['type']?>" role="alert">
     </div>
<?php 
unset($_SESSION['alert']);
endif; 
?>

<div class="container-fluid row">
    <div class="d-grid col-sm gap-2">
        <a href="<?= URL ?>reservations/ajouter" class="btn btn-primary d-block">Ajouter</a>
    </div>
    <div class="d-grid col-sm gap-2">
        <a href="<?= URL ?>reservations/rechercher" class="btn btn-success d-block">Rechercher reservation</a>
    </div>

    <div class="d-grid col-sm gap-2">
        <form method="POST" action="<?= URL ?>reservations/tout-supprimer" onsubmit="return confirm('Toutes les reservations ainsi que tous les clients seront supprimer')">
            <button class="btn btn-danger d-inline" type="submit">Nouvelle reservation</button>
        </form>
    </div>
<!--
    <div class="col-sm d-grid gap-2">
        <a href="<?= URL ?>reservations/supprimer" class="btn btn-danger d-block mx-2">Nouvelle reservation</a>
    </div>
-->

    <div class="d-grid col-sm gap-2 bg-warning text-white text-center mx-2 p-2" style="border: 1px solid black;">
        <h5>Recette accumulé :  <?php echo $montantAccumule->getMontantAccumule()." AR" ?></h5>
    </div>

    <div class="d-grid col-sm gap-2 bg-warning text-white mx-2 p-2" style="border: 1px solid black;">
        <h5>Nombre de reservation : <?php echo count($reservations) ;?></h5>
    </div>
<!--
    <div class="col-sm p-2">
        <?php 
            $sum = array_sum(array_map(function($reservation) {
                return $reservation->getMontant_avance();
            }, $reservations))
        ?>
        Total des montant en avance : <?php echo $sum." AR" ;?>
    </div>
-->
</div>


<table class="table table-hover text-center mt-2">
    <thead>
    <tr class="table-dark">
        <th scope="col">idreserv</th>
        <th scope="col">idvoit</th>
        <th scope="col">Client</th>
        <th scope="col">Telephone</th>
        <th scope="col">Place</th>
        <th scope="col">Payement</th>
        <th scope="col">Avance</th>
        <th scope="col">Date reservation</th>
        <th scope="col">Date de depart</th>
        <th scope="col" colspan="2">Actions</th>
    </tr>
    </thead>
    <?php 
    for ($i=0;$i < count($reservations); $i++) : 
    ?>
    <tbody>  
    <tr>
        <td scope="row" class="align-middle"><?= "RE".$reservations[$i]->getIdreserv();?></td>
        <td class="align-middle"><?= $reservations[$i]->getIdvoit();?></td>
        <td class="align-middle"><?= $reservations[$i]->client_nom;?></td>
        <td class="align-middle"><?= $reservations[$i]->client_numtel;?></td>
        <td class="align-middle"><?= $reservations[$i]->getPlace();?></td>
        <td class="align-middle"><?= $reservations[$i]->getPayment();?></td>
        <td class="align-middle"><?= $reservations[$i]->getMontant_avance();?></td>
        <td class="align-middle"><?= $reservations[$i]->getDate_reserv();?></td>
        <td class="align-middle"><?= $reservations[$i]->getDate_voyage();?></td>
        <td class="align-middle"><a href="<?= URL ?>reservations/modifier/<?=$reservations[$i]->getIdreserv();?>" class="btn btn-info">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>reservations/supprimer/<?= $reservations[$i]->getIdreserv();?>" onsubmit="return confirm('voulez-vous vraiment supprimer la reservation?')">
                <button class="btn btn-danger" type="submit">suppprimer</button>
            </form>
        </td>
    </tbody>
    </tr>
    <?php endfor; ?>
</table>

<?php
$content = ob_get_clean();
$titre = "Listes des reservations :";
require "template.php";
?>