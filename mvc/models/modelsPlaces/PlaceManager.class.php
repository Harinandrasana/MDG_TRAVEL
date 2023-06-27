<?php

require_once "models/BaseModel.class.php";
require_once "Place.class.php";

class PlaceManager extends BaseModel
{
    public function ajoutVoiture($voiture)
    {
        $this->voitures[] = $voiture;
    }

    public function getPlaceByVoitureId($idvoit)
    {
        $req = "SELECT p.place,p.occupation, c.nom from place p    
                LEFT JOIN reserver r on r.idvoit=p.idvoit AND r.place = p.place
                LEFT JOIN client c on c.idcli=r.idcli
                WHERE p.idvoit =:idvoit ORDER BY p.place";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->execute();
        $places = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $resultat = array();

        foreach($places as $place)
        {
            $p = new Place($place['place'],$place['occupation']);
            $p->client_nom = $place['nom'];
            $resultat[] = $p;
        }

        return $resultat;
    }

    public function verifierDisponibilitePlace($idvoit, $place)
    {
        $req = "SELECT * from place WHERE  idvoit=:idvoit AND place=:place AND occupation='NON'";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":place", $place,PDO::PARAM_INT);
        $stmt->execute();
        $places = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $data = array(
            "idvoit" => $idvoit,
            "place" => $place,
            "est_disponible" => count($places) > 0,
        );
        return $data;
    }

    public function modifierPlaceOccupation($idvoit,$place,$occupation)
    {
        $req = "UPDATE place set occupation=:occupation WHERE idvoit=:idvoit AND place=:place";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":place", $place,PDO::PARAM_INT);
        $stmt->bindvalue(":occupation", $occupation,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }

    public function checkPlaceOccuption($idvoit, $place)
    {
        $req = "SELECT occupation from place WHERE  idvoit=:idvoit AND place=:place";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":place", $place,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $resultat;
    }
}
?>