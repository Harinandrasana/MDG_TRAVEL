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
        <th>ligne1</th>
        <th>ligne2</th>
        <th>ligne3</th>
        <th>ligne4</th>
    </tr>
    <?php 
    for ($i=0;$i < $nbligne; $i++) : 
    ?>  
    <tr>
        <td class="align-middle">
        	<?php 

        	if ($i === 0)
        	{
        		echo "place <br> chauffeur";
        	}
        	else
        	{
        		echo $i*4+0+1-2;

        		if ($place[$i*4+0-2-2]->getOccupation() ===	 "OUI")
        		{
        			echo '<p style="color: red;">PLACE OCCUPEE</p>';
                    echo $place[$i*4+0-2-2]->client_nom;
        		}
        		else
        		{
        			echo '<p style="color: green;">PLACE LIBRE</p>';
        		}	
        	}
        	?>
        </td>
        <td class="align-middle">
        	
        	<?php 
        	if ($i === 0)
        	{

        	}
        	else if(($i*4+1-2) < count($place))
        	{
        		echo $i*4+1+1-2;

        		if ($place[$i*4+1-2]->getOccupation() ===	 "OUI")
        		{
        			echo '<p style="color: red;">PLACE OCCUPEE</p>';
                    echo $place[$i*4+1-2]->client_nom;

        		}
        		else
        		{
        			echo '<p style="color: green;">PLACE LIBRE</p>';
        		}		
        	}
        	?>
        </td>
        <td class="align-middle">
        	        	
        	<?php 

			if(($i*4+2-2) < count($place))
        	{
        		echo $i*4+2+1-2;

        		if ($place[$i*4+2-2]->getOccupation() ==="OUI")
        		{
        			echo '<p style="color: red;">PLACE OCCUPEE</p>';
                    echo $place[$i*4+2-2]->client_nom;
        		}
        		else
        		{
        			echo '<p style="color: green;">PLACE LIBRE</p>';
        		}	

        	}
        	?>
        </td>
        <td class="align-middle">
        	        	
        	<?php 

        	if(($i*4+3-2) < count($place))
        	{
        		echo $i*4+3+1-2;
        		if ($place[$i*4+3-2]->getOccupation() ===	 "OUI")
        		{
        			echo '<p style="color: red;">PLACE OCCUPEE</p>';
                    echo $place[$i*4+3-2]->client_nom;
        		}
        		else
        		{
        			echo '<p style="color: green;">PLACE LIBRE</p>';
        		}	 	
        	}
        	?>
        </td>      	
    </tr>
    <?php endfor; ?>
</table>
<?php
$content = ob_get_clean();
$titre = "Liste des voitures";
require "template.php";
?>