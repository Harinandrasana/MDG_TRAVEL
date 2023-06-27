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
<table class="table text-center">
    <tr class="table-dark">
        <th>idcli</th>
        <th>nom</th>
        <th>numtel</th>
        <th>Place</th>
        <th>Date reservation</th>
        <th>Date de depart</th>
        <th>Payement</th>
        <th>Montant en avance</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for ($i=0;$i < count($clients); $i++) : 
    ?>  
    <tr>
        <td class="align-middle"><?= $clients[$i]->getIdcli();?></td>
        <td class="align-middle"><a href="<? URL ?>clients/l/<?=$clients[$i]->getIdcli();?>"><?= $clients[$i]->getNom();?></a></td>
        <td class="align-middle"><?= $clients[$i]->getNumtel();?></td>

        <!--Reservation-->
        <td class="align-middle"><?= $clients[$i]->reservation->getPlace()?></td>
        <td class="align-middle"><?= $clients[$i]->reservation->getDate_reserv()?></td>
        <td class="align-middle"><?= $clients[$i]->reservation->getDate_voyage()?></td>
        <td class="align-middle"><?= $clients[$i]->reservation->getPayment()?></td>
        <td class="align-middle"><?= $clients[$i]->reservation->getMontant_avance()?></td>

        <td class="align-middle"><a href="<?= URL ?>clients/m/<?=$clients[$i]->getIdcli();?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <button class="btn btn-warning" onclick="supprimer('<?php echo $clients[$i]->getIdcli(); ?>')">supprimer</button>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>clients/a" class="btn btn-success d-block">Ajouter</a>

<script>
    function supprimer(idcli)
    {   
        if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) 
        {
            window.location.href = "<?= URL ?>clients/supprimer-client/" + idcli;
        } 
    }
</script>

<?php
$content = ob_get_clean();
$titre = "Les livres de la bibliothèque";
require "template.php";
?>