<?php

require_once 'models/modelsClients/ClientManager.class.php';

class ClientController
{
    private $clientManager;
    private $rechercheManager;

    public function __construct()
    {
        $this->clientManager = new ClientManager;
    }

    public function afficherClients()
    {
        $this->clientManager->chargementClients();
        $clients = $this->clientManager->getClients();
        require 'views/client.view.afficher.php';
    }

    public function rechercherClient()
    {
        $term = $_POST['term'];
        $this->clientManager-> rechercherClientBd($term);
        $clients = $this->clientManager->getClients();
        require "views/client.view.afficher.php";
    }

    public function afficherClient($idcli)
    {
        $client = $this->clientManager->getClientById($idcli);
        echo $client->getNom();
        echo $client->getNumtel();
        require "views/afficherClient.view.php";
    }

    public function ajoutClient()
    {
        require "views/client.view.ajouter.php";
    }

    public function ajoutClientValidation()
    {

        if(isset($_POST['annuler']))
        {
            header('location: /mvc/clients'); 
        }

        if(!empty($_POST['nom']) && !empty($_POST['numtel']))
        {
          $this->clientManager->ajoutClientBd($_POST['nom'],$_POST['numtel']);

            header('location: /mvc/clients');  
        }
        else
        {
            $message = "veuiller remplir les champ correctement";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/clients/ajouter";
            </script>';
            ob_end_flush();
            exit;
        }
        
    }

    public function modifiacationClient($idcli)
    {
        $client = $this->clientManager->getClientById($idcli);
        require "views/client.view.modifier.php";
    }

    public function modifiacationClientValidation()
    {
        if(isset($_POST['annuler']))
        {
            header('location: /mvc/clients'); 
        }

        if(!empty($_POST['nom']) && !empty($_POST['numtel']))
        {
            $this->clientManager->modificationClientBd($_POST['idcli'],$_POST['nom'],$_POST['numtel']);
            header('location: /mvc/clients');

            $_SESSION['alert'] = [
                "type" => "succes",
                "msg" => "Modification realisé"
            ];
        }
        else
        {
            $message = "veuiller remplir les champ correctement";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/clients/modifier/'.$_POST['idcli'].'";
            </script>';
            ob_end_flush();
            exit;
        }
    }

    public function suppressionClient($idcli)
    {
        $this->clientManager->suppressionClientBd($idcli);
        header("location: /mvc/clients");

        $_SESSION['alert'] = [
            "type" => "succes",
            "msg" => "Suppression realisé"
        ];
    }
}
?>