<?php

require_once "models/BaseModel.class.php";
require_once "Montant.class.php";

class MontantManager extends BaseModel
{

    public function calculerMontantAccumule()
    {
        $req = "SELECT SUM(Frais) as sum from voiture LEFT JOIN place on place.idvoit=voiture.idvoit where occupation='oui'";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Montant($result['sum']);
    }
   
}
?>