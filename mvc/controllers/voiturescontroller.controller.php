<?php

require_once 'models/modelsVoitures/VoitureManager.class.php';
require_once 'models/modelsPlaces/PlaceManager.class.php';

class VoitureController
{
    private $voitureManager;
    private $placeManager;

    public function __construct()
    {
        $this->voitureManager = new VoitureManager;
        $this->placeManager = new PlaceManager;
    }

    public function afficherVoitures()
    {
        $this->voitureManager->chargementVoitures();
        $voitures = $this->voitureManager->getVoitures();
        require 'views/voiture.view.afficher.php';
    }

    public function afficherVoiture($idvoit)
    {
        $voiture = $this->voitureManager->getVoitureById($idvoit);
        $placeLibres = $this->voitureManager->getPlaceLibreById($idvoit);
        require "views/afficherVoiture.view.php";
    }

    public function ajoutVoiture()
    {
        require "views/voiture.view.ajouter.php";
    }

    public function ajoutVoitureValidation()
    {
        if(isset($_POST['annuler']))
        {
            header('location: /mvc/voitures'); 
        }

        if(!empty($_POST['idvoit']) && !empty($_POST['design']) && !empty($_POST['type']) && !empty($_POST['nbrplace']) && !empty($_POST['frais']))
        {
            $this->voitureManager->ajoutVoitureBd($_POST['idvoit'],$_POST['design'],$_POST['type'],$_POST['nbrplace'],$_POST['frais']);

            $_SESSION['alert'] = [
                "type" => "succes",
                "msg" => "Ajout realisé"
            ];

            header("location: /mvc/voitures");  
        }
        else
        {
            $message = "veuiller remplir les champ correctement";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/voitures/ajouter";
            </script>';
            ob_end_flush();
            exit;
        }
        
    }

    public function modificationVoiture($idvoit)
    {
        $this->voitureManager->chargementVoitures();
        $place = $this->placeManager->getPlaceByVoitureId($idvoit);
        $voiture = $this->voitureManager->getVoitureById($idvoit);

        require "views/voiture.view.modifier.php";
    }

    public function modifiacationVoitureValidation()
    {
        if(isset($_POST['annuler']))
        {
            header('location: /mvc/voitures'); 
        }

        if(!empty($_POST['idvoit']) && !empty($_POST['design']) && !empty($_POST['type']) && !empty($_POST['nbrplace']) && !empty($_POST['frais']))
        {
            $this->voitureManager->modificationVoitureBd($_POST['idvoit'],$_POST['design'],$_POST['type'],$_POST['nbrplace'],$_POST['frais']);
            header("location: /mvc/voitures");

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
            window.location.href = "/mvc/voitures/modifier/'.$_POST['idvoit'].'";
            </script>';
            ob_end_flush();
            exit;
        }
    }

    public function suppressionVoiture($idvoit)
    {
        $this->voitureManager->suppressionVoitureBd($idvoit);
        header("location: /mvc/voitures");

        $_SESSION['alert'] = [
            "type" => "succes",
            "msg" => "Suppression realisé"
        ];
    }

    public function afficherPlaceDisponible($idvoit)
    {
        $this->voitureManager->chargementVoitures();
        $place = $this->placeManager->getPlaceByVoitureId($idvoit);
        $voiture = $this->voitureManager->getVoitureById($idvoit);

        $nbcolonne = 4;
        $nbplace = count($place) + 2;
        $nbligne = $nbplace / $nbcolonne;
        require "views/place.view.afficher.php";
    }

    public function verierPlaceDisponibilite($idvoit, $place)
    {
        $disponibiliteData = $this->placeManager->verifierDisponibilitePlace($idvoit, $place);
        require "views/place.view.disponibilite.php";
    }
}
?>