<?php
// Fichier: telecharger.php (ADAPTÉ)
session_start();

if (!isset($_SESSION['user']) || !isset($_GET['fichier']) || !isset($_GET['contexte'])) {
    http_response_code(403);
    die("Accès non autorisé ou paramètres manquants.");
}

$user = $_SESSION['user'];
$prenom_nom = strtolower($user['prenom'] . '.' . $user['nom']);
$role = strtolower($user['role']);

$nom_fichier = basename($_GET['fichier']); // Sécurité
$contexte = $_GET['contexte'];

$chemin_base = '';
if ($contexte === 'perso') {
    $chemin_base = __DIR__ . '/ftp-root/utilisateurs/' . $prenom_nom . '/';
} elseif ($contexte === 'role') {
    $chemin_base = __DIR__ . '/ftp-root/commun/' . $role . '/';
} else {
    http_response_code(400);
    die("Contexte invalide.");
}

$chemin_complet_fichier = $chemin_base . $nom_fichier;

// Vérification de sécurité finale
if (file_exists($chemin_complet_fichier) && strpos(realpath($chemin_complet_fichier), realpath($chemin_base)) === 0) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($chemin_complet_fichier) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($chemin_complet_fichier));
    flush(); // Vider les tampons de sortie du serveur
    readfile($chemin_complet_fichier);
    exit;
} else {
    http_response_code(404);
    die("Fichier non trouvé ou accès interdit.");
}