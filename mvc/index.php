<?php
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/clientsController.controller.php";
require_once "controllers/reservationscontroller.controller.php";
require_once "controllers/voituresController.controller.php";

$clientController = new ClientController;
$voitureController = new VoitureController;
$reservationController = new ReservationController;

try{
    if(empty($_GET['page']))
    {
        require "views/accueil.view.php";
    } 
    else 
    {
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);

        switch($url[0]){
            case "accueil" : require "views/accueil.view.php";
            break;
            case "rechercher" :
            if($url[1] === "rechercher-clients")
            {
                $clientController->rechercherClient();
            }
            break;
            case "voitures" : 
                if(empty($url[1])){
                    $voitureController->afficherVoitures();
                }
                 else if($url[1] === "recherche")
                  {
                    $voitureController->afficherVoiture($url[2]);
                } 
                else if($url[1] === "ajouter") 
                {
                    $voitureController->ajoutVoiture();
                } 
                else if($url[1] === "ajouter-validation")
                {
                    $voitureController->ajoutVoitureValidation();
                } 
                else if($url[1] === "supprimer") 
                {
                    $voitureController->suppressionVoiture($url[2]);
                } 
                else if($url[1] === "modifier") 
                {
                    echo $voitureController->modificationVoiture($url[2]);
                } 
                else if($url[1] === "modifier-validation")
                {
                    $voitureController->modifiacationVoitureValidation();   
                }
                else if($url[1] === "afficher-place")
                {
                    $voitureController->afficherPlaceDisponible($url[2]);   
                }
                else if($url[1] === "disponibilite")
                {
                    $voitureController->verierPlaceDisponibilite($url[2],$url[3]);   
                }
                else 
                {
                    throw new Exception("La page n'existe pas1");
                }
            break;            
            case "clients" : 
                if(empty($url[1]))
                {
                    $clientController->afficherClients();
                } 
                else if($url[1] === "client-afficher") 
                {
                    $clientController->afficherClient($url[2]);
                } 
                else if($url[1] === "ajouter") 
                {
                    $clientController->ajoutClient();
                } 
                else if($url[1] === "ajouter-valider") 
                {
                    $clientController->ajoutClientValidation();
                } 
                else if($url[1] === "supprimer-client") 
                {
                    $clientController->suppressionClient($url[2]);
                } 
                else if($url[1] === "modifier") 
                {
                    echo $clientController->modifiacationClient($url[2]);
                } 
                else if($url[1] === "modifier-valider") 
                {
                     $clientController->modifiacationClientValidation();   
                }
                else if($url[1] === "annuler") 
                {
                     $clientController->annuler();   
                }
                else
                {
                    throw new Exception("La page n'existe pas");
                }
            break;
                case "reservations" : 
                if(empty($url[1])){
                    $reservationController->afficherReservations();
                } else if($url[1] === "afficher") 
                {
                    $reservationController->afficherReservation($url[2]);
                } else if($url[1] === "ajouter") 
                {
                    $reservationController->ajoutReservation();
                } 
                else if($url[1] === "ajouter-validation") 
                {
                    $reservationController->ajoutReservationValidation();
                } 
                else if($url[1] === "supprimer") 
                {
                    $reservationController->suppressionReservation($url[2]);
                }
                else if($url[1] === "tout-supprimer") 
                {
                    $reservationController->nettoyerReservation();
                }
                else if($url[1] === "modifier") 
                {
                    echo $reservationController->modifiacationReservation($url[2]);
                }
                else if($url[1] === "modifier-validation") 
                {
                     $reservationController->modifiacationReservationValidation();   
                }
                else if($url[1] === "rechercher") 
                {
                     $reservationController->chercherReservation();   
                }
                else if($url[1] === "rechercher-validation") 
                {
                     $reservationController->chercherReservationValidation();  
                }
                else
                {
                    throw new Exception("La page n'existe pas");
                }
            break;
            default : throw new Exception("La page n'existe pas");
        }
    }
}
catch(Exception $e)
{
        $msg = $e->getMessage();
        require "views/error.view.php";
}
