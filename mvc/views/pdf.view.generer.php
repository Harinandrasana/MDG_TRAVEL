
<?php
ob_start();
require('fpdf/fpdf.php');
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('UTC');

try {
    $conn = new PDO("mysql:host=localhost;dbname=projetphp", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Échec de la connexion à la base de données : ' . $e->getMessage());
}

$currentDateTime = date('Y-m-d H:i:s');
$query = "SELECT * from reserver LEFT JOIN client on client.idcli=reserver.idcli LEFT JOIN voiture on reserver.idvoit=voiture.idvoit LEFT JOIN place on voiture.idvoit=place.idvoit where reserver.place =:place AND reserver.idvoit=:idvoit";
$stmt = $conn->prepare($query);
$stmt->bindvalue('place', $_POST['place']);
$stmt->bindvalue('idvoit', $_POST['idvoit']);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt->closeCursor();

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 14,12, '', true, 'UTF-8');

foreach ($data as $row) {
	$pdf->SetTextColor(199, 199, 199); 
	$pdf->Cell(0, 2, utf8_decode('MDG TRAVEL'));
	$pdf->SetTextColor(0, 0, 0);
	$pdf->Ln();
	$pdf->Cell(0, 10, utf8_decode('reçue numero : ').$row['idreserv'],0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(75, 10, 'Date du reservation : '.$row['date_reserv']);
    $pdf->Ln();
    $pdf->Cell(75, 10, 'Date du voyage : '.$row['date_voyage']);
    $pdf->Ln();
    $pdf->Cell(75, 10, 'Nom du Client : '.$row['nom']." / Contact : ".$row['numtel']);
    $pdf->Ln();
    $pdf->Cell(75, 10, ''.utf8_decode($row['Design']).' / Numero voiture : '.$row['idvoit'].' / Type de voiture : '.$row['type'].' / Place :'.$_POST['place']);
    $pdf->Ln();
    $pdf->Cell(75, 10, 'Frais : '.$row['frais'].'AR');
    $pdf->Ln();
    $pdf->Cell(75, 10, 'Payement : '.$row['payment']);
    $pdf->Ln();
    if($row['payment'] == "Tout paye")
    {
    }
    else
    {
    	$reste = $row['frais'] - $row['montant_avance'];
    	$pdf->Cell(75, 10, 'Montant avance : '.$row['montant_avance']."AR / reste : ".$reste.'AR');
    }
    
    break;
}

header('Content-Type: application/pdf');

$pdf->Output('recue.pdf', 'D');

?>


