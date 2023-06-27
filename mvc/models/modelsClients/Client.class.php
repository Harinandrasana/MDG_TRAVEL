<?php
class Client{
    private $idcli;
    private $nom;
    private $numtel;
    public $erreur = "Veuillez remplir les champs correctement";

    public function __construct($idcli,$nom,$numtel)
    {
        $this->idcli = $idcli;
        $this->nom = $nom;
        $this->numtel = $numtel;
    }

    public function getIdcli(){return $this->idcli;}
    public function setIdcli($idcli){$this->idcli = $idcli;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}

    public function setNumtel($numtel){$this->numtel = $numtel;}
    public function getNumtel(){return $this->numtel;}

    public function getIdReservation(){return $this->idreserv;}
    public function setIdReservation($idreserv){$this->idreserv = $idreserv;}

    public function getErreurs(){return $this->erreur;}

}
?>