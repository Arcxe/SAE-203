<?php
// Fichier: supprimer.php (CORRIGÉ)
session_start();

if (!isset($_SESSION['user']) || !isset($_GET['fichier']) || !isset($_GET['contexte'])) {
    header('Location: gestionnaire.php?error=Paramètres manquants');
    exit;
}

$user = $_SESSION['user'];
$prenom_nom = strtolower($user['prenom'] . '.' . $user['nom']);
$role = strtolower($user['role']);

// basename() est une sécurité cruciale pour éviter les attaques de type "Directory Traversal"
$nom_fichier = basename($_GET['fichier']); 
$contexte = $_GET['contexte'];

$chemin_base = '';
if ($contexte === 'perso') {
    $chemin_base = __DIR__ . '/ftp-root/utilisateurs/' . $prenom_nom . '/';
} elseif ($contexte === 'role') {
    $chemin_base = __DIR__ . '/ftp-root/commun/' . $role . '/';
} else {
    header('Location: gestionnaire.php?error=Contexte invalide');
    exit;
}

$chemin_complet_fichier = $chemin_base . $nom_fichier;

// realpath() résoud les '..' et autres, on vérifie que le fichier final est bien dans le dossier prévu
if (file_exists($chemin_complet_fichier) && strpos(realpath($chemin_complet_fichier), realpath($chemin_base)) === 0) {
    if (unlink($chemin_complet_fichier)) {
        header('Location: gestionnaire.php?success=supprimé');
    } else {
        header('Location: gestionnaire.php?error=Impossible de supprimer le fichier');
    }
} else {
    header('Location: gestionnaire.php?error=Fichier non trouvé ou accès interdit');
}
exit;