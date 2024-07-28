<?php
namespace App\Core\RECU;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Twilio\Rest\Client;
use FPDF;

class Recu{
    
    public function generateRecu( $dette) {

        require_once('/var/www/html/gestiondette3/src/core/RECU/Recu.php'); // Ajustez le chemin vers le fichier FPDF

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Titre
        $pdf->Cell(0, 10, 'Reçu de Paiement', 0, 1, 'C');

        // Informations du client
        // $pdf->SetFont('Arial', '', 12);
        // $pdf->Cell(0, 10, 'Client: ' . $client->nom . ' ' . $client->prenom, 0, 1);
        // $pdf->Cell(0, 10, 'Email: ' . $client->email, 0, 1);
        // $pdf->Cell(0, 10, 'Numéro de téléphone: ' . $client->telephone, 0, 1);

        // Informations de la dette et du paiement
        $pdf->Cell(0, 10, 'Date de la dette: ' . 1);
        $pdf->Cell(0, 10, 'Montant de la dette: ' . 2);
        // $pdf->Cell(0, 10, 'Montant payé: ' . $paiement->montant_verse, 0, 1);
        // $pdf->Cell(0, 10, 'Date du paiement: ' . date('Y-m-d'), 0, 1);
        // $pdf->Cell(0, 10, 'Montant restant: ' . ($dette->montant - $paiement->montant_verse), 0, 1);

        // Pied de page
        $pdf->SetY(-30);
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'Merci pour votre paiement!', 0, 1, 'C');

        $pdf->Output('F', '/var/www/html/gestiondette3/src/core/RECU/recu_paiement.pdf');
    }
}
