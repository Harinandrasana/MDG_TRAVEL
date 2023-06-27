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
        <th>rangé 1</th>
        <th>rangé 2</th>
        <th>rangé 3</th>
        <th>rangé 4</th>
    </tr>
    <td>place <br> chauffeur</td>
    <td></td>
    <?php
    for($i=0; $i< count($place); $i++)
    {
        echo "<td>";
        echo ($i+1);

        if ($place[$i]->getOccupation() ===  "OUI")
        {
            echo '<p style="color: red;">PLACE OCCUPEE</p>';
            echo $place[$i]->client_nom;
        }
        else
        {
            echo '<p style="color: green;">PLACE LIBRE</p>';
        }   
        echo "</td>";
        if(($i+2)%4 == 3)
        {
            echo "</tr><tr>";
        }
    }
    ?>
    </tr>
</table>
<?php
$content = ob_get_clean();
$titre = "Place : ";
require "template.php";
?>