<?php
require __DIR__ . '/libs/fpdf/fpdf.php';

$clients_file = __DIR__ . '/data/clients.json';
$clients = json_decode(file_get_contents($clients_file), true);

$id = $_GET['id'];
if (!$id) {
    die("ID client manquant.");
}

$client = null;
foreach ($clients as $c) {
    if ($c['id'] === $id) {
        $client = $c;
        break;
    }
}

if (!$client) {
    die("Client introuvable.");
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, "Fiche Client", 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, "Prénom :", 0, 0);
$pdf->Cell(0, 10, $client['prenom'], 0, 1);

$pdf->Cell(50, 10, "Nom :", 0, 0);
$pdf->Cell(0, 10, $client['nom'], 0, 1);

$pdf->Cell(50, 10, "Adresse :", 0, 0);
$pdf->MultiCell(0, 10, $client['adresse']);

$pdf->Cell(50, 10, "Email :", 0, 0);
$pdf->Cell(0, 10, $client['email'], 0, 1);

$pdf->Cell(50, 10, "Téléphone :", 0, 0);
$pdf->Cell(0, 10, $client['telephone'], 0, 1);

$pdf->Output('D', 'fiche_client_' . $client['prenom'] . '_' . $client['nom'] . '.pdf');
