<?php
session_start();
// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

require 'scripts/functions.php';

$user = $_SESSION['user'];
$prenom_nom = strtolower($user['prenom'] . '.' . $user['nom']);
$role = strtolower($user['role']);

// Les chemins sont maintenant cohérents avec la création de dossier
$dossier_perso = __DIR__ . '/ftp-root/utilisateurs/' . $prenom_nom;
$dossier_role = __DIR__ . '/ftp-root/commun/' . $role;

/**
 * Fonction corrigée pour lister les fichiers de manière sécurisée.
 * @param string $chemin Le chemin complet vers le dossier sur le serveur.
 * @param string $titre Le titre à afficher pour la section.
 * @param string $contexte 'perso' ou 'role', pour les scripts de destination.
 */
function listerFichiers($chemin, $titre, $contexte) {
    echo "<h2 class='mt-4'>$titre</h2>";
    if (!is_dir($chemin)) {
        echo "<p class='text-muted'>Le dossier n'existe pas encore. Uploadez un fichier pour le créer.</p>";
        return;
    }

    $fichiers = array_diff(scandir($chemin), ['.', '..']);
    if (empty($fichiers)) {
        echo "<p>Aucun fichier pour le moment.</p>";
    } else {
        echo "<ul class='list-group'>";
        foreach ($fichiers as $fichier) {
            $chemin_complet_fichier = $chemin . '/' . $fichier;
            if (is_file($chemin_complet_fichier)) { // On s'assure que c'est bien un fichier
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo htmlspecialchars($fichier);
                echo "<span>";
                // On utilise les bons noms de script et on passe les paramètres sécurisés
                echo "<a href='telecharger.php?fichier=" . urlencode($fichier) . "&contexte=" . $contexte . "' class='btn btn-sm btn-success me-2'>Télécharger</a>";
                echo "<a href='supprimer.php?fichier=" . urlencode($fichier) . "&contexte=" . $contexte . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce fichier ?\")'>Supprimer</a>";
                echo "</span></li>";
            }
        }
        echo "</ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Gestionnaire de fichiers"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-4 mb-5">
    <h1><strong>Gestionnaire de fichiers</strong></h1>
    
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Fichier <?= htmlspecialchars($_GET['success']) ?> avec succès !</div>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <a href="upload.php" class="btn btn-primary my-3">Uploader un fichier</a>

    <?php
    // On appelle la fonction corrigée avec le nouveau paramètre "contexte"
    listerFichiers($dossier_perso, "Mon dossier personnel", "perso");
    listerFichiers($dossier_role, "Dossier de mon service (" . htmlspecialchars($role) . ")", "role");
    ?>
</main>

<?php pieddepage(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>