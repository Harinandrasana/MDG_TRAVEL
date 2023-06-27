<?php

use function PHPSTORM_META\type;

require_once "models/BaseModel.class.php";
require_once "Voiture.class.php";

class VoitureManager extends BaseModel
{
    private $voitures;

    public function ajoutVoiture($voiture)
    {
        $this->voitures[] = $voiture;
    }

    public function getVoitures()
    {
        if (isset($this->voitures)) 
        {
            return $this->voitures;
        }
        else
        {
            return [];
        }
        
    }

    public function chargementVoitures()
    {
        $req = $this->getBdd()->prepare("SELECT * from voiture");
        $req->execute();
        $voitures = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($voitures as $voiture)
        {
            $v = new Voiture($voiture['idvoit'],$voiture['Design'],$voiture['type'],$voiture['nbrplace'],$voiture['frais']);
            $this->ajoutVoiture($v);
        }
    }

    public function getVoitureById($id)
    {
        for($i=0; $i < count($this->voitures); $i++)
        {
            if($this->voitures[$i]->getIdvoit() === $id)
            {
                return $this->voitures[$i];
            }
        }
    }

    public function ajoutVoitureBd($idvoit,$design,$type,$nbrplace,$frais)
    {
        $req ="INSERT INTO voiture (idvoit, design, type, nbrplace, frais) values (:idvoit, :design, :type, :nbrplace, :frais)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":design", $design,PDO::PARAM_STR);
        $stmt->bindvalue(":type", $type,PDO::PARAM_STR);
        $stmt->bindvalue(":nbrplace", $nbrplace,PDO::PARAM_INT);
        $stmt->bindvalue(":frais", $frais,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        
        if($resultat > 0)
        {
            for ($i=0; $i < $nbrplace ; $i++) 
            { 
                $this->ajoutPlaceBd($idvoit, $i+1,"NON");
            }
            $voiture = new Voiture($idvoit,$design,$type,$nbrplace,$frais);
            $this->ajoutVoiture($voiture);
        }
    }

    private function ajoutPlaceBd($idvoit, $place, $occupation)
    {
        $req = "INSERT INTO place (idvoit, place , occupation) VALUES (:idvoit, :place, :occupation)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":place", $place,PDO::PARAM_INT);
        $stmt->bindvalue(":occupation", $occupation,PDO::PARAM_STR);
        $resultat = $stmt->execute();
    }

    public function suppressionVoitureBd($idvoit)
    {
        //suppression des places
        //$this->suppressionPlace($idvoit);

        //suppression voiture
        $req = "START TRANSACTION; 
        DELETE FROM voiture WHERE idvoit =:idvoit;
        DELETE FROM place WHERE idvoit =:idvoit;
        COMMIT;";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit",$idvoit,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0)
        {
            $voiture = $this->getVoitureById($idvoit);
            unset($voiture);
        }
    }
/*
    public function suppressionPlace($idvoit)
    {
        $req = "DELETE FROM place where idvoit=:idvoit";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit",$idvoit,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }
*/
    public function modificationVoitureBd($idvoit,$design,$type,$nbrplace,$frais)
    {
        $req = "UPDATE voiture set design=:design, type=:type, nbrplace=:nbrplace, frais=:frais WHERE idvoit=:idvoit";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":design", $design,PDO::PARAM_STR);
        $stmt->bindvalue(":type", $type,PDO::PARAM_STR);
        $stmt->bindvalue(":nbrplace", $nbrplace,PDO::PARAM_INT);
        $stmt->bindvalue(":frais", $frais,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
/*
        if($resultat > 0)
        {
            $this->getVoitureById($idvoit)->setIdvoit($idvoit);
            $this->getVoitureById($idvoit)->setDesign($design);
            $this->getVoitureById($idvoit)->setType($type);
            $this->getVoitureById($idvoit)->setNbrPlace($nbrplace);
            $this->getVoitureById($idvoit)->setFrais($design);
        }
*/

    }
}
?>