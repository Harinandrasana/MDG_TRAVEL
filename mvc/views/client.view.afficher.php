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
<table class="table table-hover text-center">
    <tr class="table-dark">
        <th>idcli</th>
        <th>Nom</th>
        <th>Telephone</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for ($i=0;$i < count($clients); $i++) : 
    ?>  
    <tr>
        <td class="align-middle"><?= $clients[$i]->getIdcli();?></td>
        <td class="align-middle"><?= $clients[$i]->getNom();?></td>
        <td class="align-middle"><?= $clients[$i]->getNumtel();?></td>
        <td class="align-middle"><a href="<?= URL ?>clients/modifier/<?=$clients[$i]->getIdcli();?>" class="btn btn-info">Modifier</a></td>
        <td class="align-middle">
            <button class="btn btn-danger" onclick="supprimer('<?php echo $clients[$i]->getIdcli(); ?>')">supprimer</button>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<div class="d-grid gap-2">
    <a href="<?= URL ?>clients/ajouter" class="btn btn-primary d-block">Ajouter</a>  
</div>

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
$titre = "Listes des clients :";
require "template.php";
?>