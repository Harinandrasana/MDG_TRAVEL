<?php

require_once 'models/modelsReservations/ReservationManager.class.php';
require_once 'models/modelsPlaces/PlaceManager.class.php';
require_once 'models/modelsClients/ClientManager.class.php';
require_once 'models/modelsVoitures/VoitureManager.class.php';
require_once 'models/modelsMontants/MontantManager.class.php';

class ReservationController
{
    private $reservationManager;
    private $clientManager;
    private $voitureManager;
    private $placeManager;
    private $montantManager;

    public function __construct()
    {
        $this->reservationManager = new ReservationManager();
        $this->reservationManager->chargementReservations();
        $this->clientManager = new ClientManager();
        $this->clientManager->chargementClients();
        $this->voitureManager = new VoitureManager();
        $this->voitureManager->chargementVoitures();
        $this->placeManager = new PlaceManager();
        $this->montantManager = new MontantManager();
    }

    public function afficherReservations()
    {
        $reservations = $this->reservationManager->getReservations();
        $montantAccumule = $this->montantManager->calculerMontantAccumule();
        require 'views/reservation.view.afficher.php';
    }

    public function afficherReservation($idreserv)
    {
        $reservation = $this->reservationManager->getReservationById($idreserv);
        require "views/afficherReservation.view.php";
    }

    public function ajoutReservation()
    {
        $clients = $this->clientManager->getClients();
        $voitures = $this->voitureManager->getVoitures();
        require "views/reservation.view.ajout.php";
    }

    public function chercherReservation()
    {
        $voitures = $this->voitureManager->getVoitures();
        require "views/reservation.view.rechercher.php";
    }

    public function ajoutReservationValidation()
    {
        $voiture = $this->voitureManager->getVoitureById($_POST['idvoit']);
        $frais = $voiture->getFrais();
        $test =  $frais - $_POST['montant_avance'];

        if(isset($_POST['annuler']))
        {
            header('location: /mvc/reservations'); 
        }

        if(($test < 0) && $_POST['payment'] == 'avec avance')
        {
            $message = "Erreur : Montant avance superieur au frais.";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/reservations/ajouter/'.$_POST['idreserv'].'";
            </script>';
            ob_end_flush();
            exit;
        }
        else if(isset($_POST['payment']) == "Tout paye")
        {
            $montant_avance = 0;
        }
        else
        {
            $montant_avance = $_POST['montant_avance'];
        }

        if(!empty($_POST['place']) && !empty($_POST['payment']) && !empty($_POST['date_voyage']))
        {
            $this->reservationManager->ajoutReservationBd($_POST['idvoit'],$_POST['idcli'],$_POST['place'],$_POST['date_voyage'], $_POST['payment'],$_POST['montant_avance']);

            $this->placeManager->modifierPlaceOccupation($_POST['idvoit'],$_POST['place'],"OUI");

            $_SESSION['alert'] = [
            "type" => "succes",
            "msg" => "Ajout realisé"
            ];
        
            //header('location: /mvc/reservations'); 
            require_once 'views/pdf.view.generer.php';
        }
        else
        {
            $message = "veuiller remplir les champ correctement";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/reservations/ajouter";
            </script>';
            ob_end_flush();
            exit;
        }
        
    }

    public function chercherReservationValidation()
    {
        if(isset($_POST['regle']) && $_POST['payment'] != 'Tout paye'  )
        {
            $payment = "Tout paye";
            $reservations = $this->reservationManager->rechercherReservationBd2($_POST['idvoit'],$payment);
            $montantAccumule = $this->montantManager->calculerMontantAccumule();
        }
        else if(isset($_POST['nonRegle']) && $_POST['payment'] != 'Tout paye' )
        {
            $reservations = $this->reservationManager->rechercherReservationBd3($_POST['idvoit'],$_POST['payment']);
            $montantAccumule = $this->montantManager->calculerMontantAccumule();
        }
        else if($_POST['payment'] == 'Tout paye' || $_POST['payment'] != 'Tout paye')
        {
            $reservations = $this->reservationManager->rechercherReservationBd($_POST['idvoit'],$_POST['payment']);
            $montantAccumule = $this->montantManager->calculerMontantAccumule();
      
        }


        require 'views/reservation.view.afficher.php';       
    }

    public function modifiacationReservation($idreserv)
    {
        $clients = $this->clientManager->getClients();
        $voitures = $this->voitureManager->getVoitures();
        $reservation = $this->reservationManager->getReservationDbById($idreserv);

        require "views/reservation.view.modifier.php";
    }

    public function modifiacationReservationValidation()
    {
        if(isset($_POST['annuler']))
        {
            header('location: /mvc/reservations'); 
        }
        
        $voiture = $this->voitureManager->getVoitureById($_POST['idvoit']);
        $frais = $voiture->getFrais();
        $test =  $frais - $_POST['montant_avance'];
        if(($test < 0) && $_POST['payment'] == 'avec avance')
        {
            $message = "Erreur : Montant avance superieur au frais.";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/reservations/modifier/'.$_POST['idreserv'].'";
            </script>';
            ob_end_flush();
            exit;
        }
        else if(!empty($_POST['place']) && !empty($_POST['payment']) && !empty($_POST['date_voyage']))
        {
        //supprimer la place deja reservee 
        $reservation = $this->reservationManager->getReservationDbById($_POST['idreserv']);
        $this->placeManager->modifierPlaceOccupation($reservation->getIdvoit(),$reservation->getPlace(),"NON");
        $voiture = $this->voitureManager->getVoitureById($_POST['idvoit']);
        $ancienPayment = $reservation->getPayment();

        if($_POST['payment'] == "Tout paye" && $ancienPayment == 'Tout paye')
        {
            $montant_avance = 0;
        }
        else if ($_POST['payment'] == "Tout paye" && $ancienPayment != 'Tout paye') {
            $montant_avance = $voiture->getFrais();
        }
        else if ($_POST['payment'] != "avec avance") {
            $montant_avance = 0;
        }
        else
        {
            $montant_avance = $_POST['montant_avance'];
        }
        //update reservation 
        $this->reservationManager->modificationReservationBd($_POST['idreserv'],$_POST['idvoit'],$_POST['idcli'],$_POST['place'],$_POST['date_voyage'], $_POST['payment'],$montant_avance);
        
        //ajouter nouveau place
        $this->placeManager->modifierPlaceOccupation($_POST['idvoit'],$_POST['place'],"OUI");

        $_SESSION['alert'] = [
            "type" => "succes",
            "msg" => "Modification realisé"
        ];
        //header('location: /mvc/reservations');
        require 'views/pdf.view.generer.php'; 
        }
        else
        {
            $message = "veuiller remplir les champ correctement";
            ob_start();
            echo '<script>
            alert("'.$message.'");
            window.location.href = "/mvc/reservations/modifier/'.$_POST['idreserv'].'";
            </script>';
            ob_end_flush();
            exit;
        }

    }

    public function suppressionReservation($idreserv)
    {

        $reservation = $this->reservationManager->getReservationDbById($idreserv);

        $this->placeManager->modifierPlaceOccupation($reservation->getIdvoit(),$reservation->getPlace(),"NON");

        $this->reservationManager->suppressionReservationBd($idreserv);

        $_SESSION['alert'] = [
            "type" => "succes",
            "msg" => "Suppression realisé"
        ];

        header("location: /mvc/reservations");
    }

    public function nettoyerReservation()
    {
        $this->reservationManager->nettoyerReservationBd();
        header("location: /mvc/clients");
    }
}
?>