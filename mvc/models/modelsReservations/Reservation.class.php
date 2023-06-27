<?php
class Reservation{
    private $idreserv;
    private $idvoit;
    private $idcli;
    private $place;
    private $date_reserv;
    private $date_voyage;
    private $payment;
    private $montant_avance;
    public $client_nom;
    public $client_numtel;

    public function __construct($idreserv,$idvoit,$idcli,$place,$date_reserv,$date_voyage,$payment,$montant_avance){
        $this->idreserv =$idreserv;
        $this->idvoit = $idvoit;
        $this->idcli = $idcli;
        $this->place = $place;
        $this->date_reserv = $date_reserv;
        $this->date_voyage = $date_voyage;
        $this->payment = $payment;
        $this->montant_avance = $montant_avance;
    }

    public function getIdreserv(){return $this->idreserv;}
    public function setIdreserv($idreserv){$this->idreserv = $idreserv;}

    public function getIdvoit(){return $this->idvoit;}
    public function setIdvoit($idvoit){$this->idvoit = $idvoit;}

    public function getIdcli(){return $this->idcli;}
    public function setIdcli($idcli){$this->idcli = $idcli;}

    public function getPlace(){return $this->place;}
    public function setPlace($place){$this->place = $place;}

    public function setDate_reserv($date_reserv){$this->date_reserv = $date_reserv;}
    public function getDate_reserv(){return $this->date_reserv;}

    public function getDate_voyage(){return $this->date_voyage;}
    public function setDate_voyage($date_voyage){$this->date_voyage = $date_voyage;}

    public function getPayment(){return $this->payment;}
    public function setPayment($payment){$this->payment = $payment;}

    public function getMontant_avance(){return $this->montant_avance;}
    public function setMontant_avance($montant_avance){$this->montant_avance = $montant_avance;}
}
?>