<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
use TCPDF;

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    die("ID client manquant.");
}

$clients_file = __DIR__ . '/data/clients.json';
if (!file_exists($clients_file)) {
    die("Fichier clients.json introuvable.");
}

$clients = json_decode(file_get_contents($clients_file), true);
if (!$clients || !is_array($clients)) {
    die("Le fichier clients.json est vide ou invalide.");
}

$client = null;
foreach ($clients as $c) {
    if ($c['id'] == $id) {
        $client = $c;
        break;
    }
}

if (!$client) {
    die("Client introuvable (ID = " . htmlspecialchars($id) . ").");
}

// Création du PDF
$pdf = new TCPDF();
$pdf->SetMargins(15, 20, 15);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Ajout du logo en haut à gauche
$logo_path = __DIR__ . '/img/goelandale.png';
if (file_exists($logo_path)) {
    // X, Y, largeur, hauteur
    $pdf->Image($logo_path, 15, 15, 30, 30, '', '', '', false, 300, '', false, false, 0, false, false, false);
}

// Décalage pour laisser la place au logo
$pdf->SetXY(50, 20);

// Ajout d’un en-tête stylisé
$pdf->SetFillColor(0, 102, 204);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 15, 'Fiche Client', 0, 1, 'C', 1);
$pdf->Ln(5);

// Ajout de l’image client si disponible (ex : /img/1.jpg)
$image_path = __DIR__ . '/img/' . $client['id'] . '.jpg';
if (file_exists($image_path)) {
    $pdf->Image($image_path, 150, 30, 40, 40, '', '', '', false, 300, '', false, false, 1);
}

$pdf->Ln(5);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);

// Contenu HTML stylisé
$html = '
<style>
    .label { font-weight: bold; width: 120px; display: inline-block; }
    .value { display: inline-block; }
    .row { margin-bottom: 8px; }
</style>

<div class="row"><span class="label">Prénom :</span> <span class="value">' . htmlspecialchars($client['prenom']) . '</span></div>
<div class="row"><span class="label">Nom :</span> <span class="value">' . htmlspecialchars($client['nom']) . '</span></div>
<div class="row"><span class="label">Adresse :</span> <span class="value">' . htmlspecialchars($client['adresse']) . '</span></div>
<div class="row"><span class="label">Email :</span> <span class="value">' . htmlspecialchars($client['email']) . '</span></div>
<div class="row"><span class="label">Téléphone :</span> <span class="value">' . htmlspecialchars($client['telephone']) . '</span></div>
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 10, 'Document généré automatiquement le ' . date('d/m/Y à H:i'), 0, 1, 'R');

$pdf->Output('fiche_client_' . $client['id'] . '.pdf', 'D');
exit;
