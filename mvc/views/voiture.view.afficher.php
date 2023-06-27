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
<table class="table table-hover text-center bg-white" style="opacity: 0.70">
    <tr class="table-dark">
        <th>idvoit</th>
        <th>design</th>
        <th>Type</th>
        <th>Nombre de place</th>
        <th>frais</th>
        <th colspan="3">Actions</th>
    </tr>
    <?php 
    for ($i=0;$i < count($voitures); $i++) : 
    ?>  
    <tr>
        <td class="align-middle"><?= $voitures[$i]->getIdvoit();?></td>
        <td class="align-middle"><?= $voitures[$i]->getDesign();?></a></td>
        <td class="align-middle"><?= $voitures[$i]->getType();?></td>
        <td class="align-middle"><?= $voitures[$i]->getNbrPlace();?></td>
        <td class="align-middle"><?= $voitures[$i]->getFrais();?></td>
        <td class="align-middle"><a href="<?= URL ?>voitures/modifier/<?=$voitures[$i]->getIdvoit();?>" class="btn btn-info">Modifier</a></td>

        <td class="align-middle"><a href="<?= URL ?>voitures/afficher-place/<?=$voitures[$i]->getIdvoit();?>" class="btn btn-dark">Place</a></td>

        <td class="align-middle">
            <form method="POST" action="<?=URL ?>voitures/supprimer/<?= $voitures[$i]->getIdvoit();?>" onsubmit="return confirm('voulez-vous vraiment supprimer la voiture?')">
                <button class="btn btn-danger" type="submit">suppprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>voitures/ajouter" class="btn btn-primary d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Liste des voitures";
require "templateVoiture.php";
?>