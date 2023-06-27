<?php

require_once "models/BaseModel.class.php";
require_once "Client.class.php";

class ClientManager extends BaseModel
{
    private $clients;

    public function ajoutclient($client)
    {
        $this->clients[] = $client;
    }

    public function getclients()
    {
        if (isset($this->clients)) 
        {
            return $this->clients; 
        }
        else
        {
            return [];
        }
    }

    public function chargementclients()
    {
        $req = $this->getBdd()->prepare("SELECT * from client");
        $req->execute();
        $clients = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($clients as $item)
        {
            $v = new client($item['idcli'],$item['nom'],$item['numtel']);
            $this->ajoutclient($v);
        }
    }

    public function ajoutclientBd($nom,$numtel)
    {
        $req ="INSERT INTO client (nom, numtel) values (:nom, :numtel)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":nom", $nom,PDO::PARAM_STR);
        $stmt->bindvalue(":numtel",$numtel,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }

     public function getClientById($idcli)
    {
        $req = $this->getBdd()->prepare("SELECT * from client WHERE idcli=:idcli");
        $req->bindvalue(":idcli", $idcli,PDO::PARAM_INT);
        $req->execute();
        $client = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($client as $item)
        {
            $c = new Client($item['idcli'],$item['nom'],$item['numtel']);
            return $c;
        }

        return NULL;
    }

    public function suppressionclientBd($idcli)
    {
        $req = "DELETE FROM client where idcli=:idcli";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idcli",$idcli,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0)
        {
            $client = $this->getclientById($idcli);
            unset($client);
        }
    }

    public function modificationclientBd($idcli,$nom,$numtel)
    {
        var_dump($idcli,$nom,$numtel);

        $req = "UPDATE client set nom=:nom, numtel=:numtel where idcli=:idcli";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idcli", $idcli,PDO::PARAM_INT);
        $stmt->bindvalue(":nom", $nom,PDO::PARAM_STR);
        $stmt->bindvalue(":numtel", $numtel,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }

    public function rechercherClientBd($term)
    {
        $query = "SELECT * FROM client WHERE  nom LIKE '%".$term."%' OR numtel LIKE '%".$term."%'";
        $stmt = $this->getBdd()->query($query);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultat as $item)
        {
            $v = new client($item['idcli'],$item['nom'],$item['numtel']);
            $this->ajoutclient($v);
        }
    }
    }
?>