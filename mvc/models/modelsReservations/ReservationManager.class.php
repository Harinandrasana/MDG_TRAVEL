<?php

require_once "models/BaseModel.class.php";
require_once "Reservation.class.php";

class ReservationManager extends BaseModel
{
    private $reservation;
    private $montant;

    public function ajoutReservation($reservation)
    {
        $this->reservations[] = $reservation;
    }

    public function getReservations()
    {
        if (isset($this->reservations)) 
        {
            return $this->reservations; 
        }
        else
        {
            return [];
        }
    }

    public function chargementReservations()
    {
        $req = $this->getBdd()->prepare("SELECT * from reserver LEFT JOIN client on client.idcli=reserver.idcli");
        $req->execute();
        $reservation = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($reservation as $item)
        {
            $v = new reservation($item['idreserv'],$item['idvoit'],$item['idcli'],$item['place'],$item['date_reserv'],$item['date_voyage'], $item['payment'],$item['montant_avance']);
            //var_dump($item);
            $v->client_nom = $item['nom'];
            $v->client_numtel = $item['numtel'];
            $this->ajoutreservation($v);
        }
    }

    public function rechercherReservationBd($idvoit,$payment)
    {
        $req = "SELECT * from reserver LEFT JOIN client on client.idcli=reserver.idcli WHERE idvoit=:idvoit AND payment=:payment AND montant_avance = 0";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":payment", $payment,PDO::PARAM_STR);
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $resultat = array();

        foreach($reservations as $item)
        {
            $r = new reservation($item['idreserv'],$item['idvoit'],$item['idcli'],$item['place'],$item['date_reserv'],$item['date_voyage'], $item['payment'],$item['montant_avance']);
            $r->client_nom = $item['nom'];
            $r->client_numtel = $item['numtel'];
            $resultat[] = $r;
        }

        return $resultat;
    }

    public function rechercherReservationBd2($idvoit,$payment)
    {
        $req = "SELECT * from reserver LEFT JOIN client on client.idcli=reserver.idcli LEFT JOIN voiture on reserver.idvoit=voiture.idvoit where reserver.idvoit=:idvoit AND reserver.payment =:payment AND reserver.montant_avance = voiture.frais; ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":payment", $payment,PDO::PARAM_STR);
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $resultat = array();

        foreach($reservations as $item)
        {
            $r = new reservation($item['idreserv'],$item['idvoit'],$item['idcli'],$item['place'],$item['date_reserv'],$item['date_voyage'], $item['payment'],$item['montant_avance']);
            $r->client_nom = $item['nom'];
            $r->client_numtel = $item['numtel'];
            $resultat[] = $r;
        }

        return $resultat;
    }

    public function rechercherReservationBd3($idvoit,$payment)
    {
        $req = "SELECT * from reserver LEFT JOIN client on client.idcli=reserver.idcli LEFT JOIN voiture on reserver.idvoit=voiture.idvoit where reserver.idvoit=:idvoit AND reserver.payment =:payment AND reserver.montant_avance < voiture.frais;";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":payment", $payment,PDO::PARAM_STR);
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $resultat = array();

        foreach($reservations as $item)
        {
            $r = new reservation($item['idreserv'],$item['idvoit'],$item['idcli'],$item['place'],$item['date_reserv'],$item['date_voyage'], $item['payment'],$item['montant_avance']);
            $r->client_nom = $item['nom'];
            $r->client_numtel = $item['numtel'];
            $resultat[] = $r;
        }

        return $resultat;
    }


     public function getReservationDbById($idreserv)
    {
        $req = $this->getBdd()->prepare("SELECT * from reserver WHERE idreserv=:idreserv");
        $req->bindvalue(":idreserv", $idreserv,PDO::PARAM_INT);
        $req->execute();
        $reservation = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($reservation as $item)
        {
            $v = new reservation($item['idreserv'],$item['idvoit'],$item['idcli'],$item['place'],$item['date_reserv'],$item['date_voyage'], $item['payment'],$item['montant_avance']);
            return $v;
        }

        return new Reservation();
    }

    public function getReservationById($id)
    {
        $this->chargementReservations();

        //var_dump($this->reservation);

        for($i=0; $i < count($this->reservations); $i++)
        {
            if($this->reservations[$i]->getIdcli() === $id)
            {
                return $this->reservations[$i];
            }
        }
    }

    public function ajoutReservationBd($idvoit,$idcli,$place,$date_voyage,$payment,$montant_avance)
    {
        $req = "INSERT INTO `reserver` (idvoit,idcli,place,reserver.date_voyage,payment,montant_avance) values (:idvoit,:idcli,:place,:date_voyage,:payment,:montant_avance)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":idcli", $idcli,PDO::PARAM_INT);
        $stmt->bindvalue(":place", $place,PDO::PARAM_INT);
        $stmt->bindvalue(":date_voyage", $date_voyage,PDO::PARAM_STR);
        $stmt->bindvalue(":payment", $payment,PDO::PARAM_STR);
        $stmt->bindvalue(":montant_avance", $montant_avance,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }

    public function suppressionReservationBd($idreserv)
    {
        $req = "DELETE FROM reserver where idreserv=:idreserv";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idreserv",$idreserv,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0)
        {
            $reservation = $this->getreservationById($idreserv);
            unset($reservation);
        }
    }

    public function modificationReservationBd($idreserv,$idvoit,$idcli,$place,$date_voyage,$payment,$montant_avance)
    {
        $req = "UPDATE reserver set idvoit=:idvoit, idcli=:idcli, place=:place, date_voyage=:date_voyage, payment=:payment, montant_avance=:montant_avance WHERE idreserv=:idreserv";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idreserv", $idreserv,PDO::PARAM_INT);
        $stmt->bindvalue(":idvoit", $idvoit,PDO::PARAM_STR);
        $stmt->bindvalue(":idcli", $idcli,PDO::PARAM_INT);
        $stmt->bindvalue(":place", $place,PDO::PARAM_INT);
        $stmt->bindvalue(":date_voyage", $date_voyage,PDO::PARAM_STR);
        $stmt->bindvalue(":payment", $payment,PDO::PARAM_STR);
        $stmt->bindvalue(":montant_avance", $montant_avance,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }

    public function nettoyerReservationBd()
    {
        $stmt = $this->getBdd()->query("DELETE FROM reserver");
        $stmt1 = $this->getBdd()->query("DELETE FROM client");
        $stmt2 = $this->getBdd()->query("UPDATE place SET place.occupation = 'NON'");
    }
}
?>