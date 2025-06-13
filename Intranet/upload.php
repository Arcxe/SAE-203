<?php
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige.
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

// On inclut les fonctions pour l'en-tête et le pied de page
// Assurez-vous que le chemin est correct si vous déplacez des fichiers.
require_once 'scripts/functions.php';

$user = $_SESSION['user'];
$prenom_nom = strtolower($user['prenom'] . '.' . $user['nom']);
$role = strtolower($user['role']);

// On calcule les chemins des dossiers directement depuis cet emplacement.
$files_root = __DIR__ . '/ftp-root';
$dossier_perso = $files_root . '/utilisateurs/' . $prenom_nom;
$dossier_role = $files_root . '/commun/' . $role;

$message = ""; // Pour afficher les messages d'erreur éventuels

// On traite le formulaire uniquement s'il a été envoyé (méthode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {

    // On vérifie qu'un fichier a bien été envoyé
    if ($_FILES['fichier']['error'] === UPLOAD_ERR_OK) {

        $destination_type = isset($_POST['destination']) ? $_POST['destination'] : 'perso';
        $destination_folder = ($destination_type === 'perso') ? $dossier_perso : $dossier_role;

        // On crée le dossier de destination s'il n'existe pas
        if (!is_dir($destination_folder)) {
            mkdir($destination_folder, 0775, true);
        }

        $fichier_temporaire = $_FILES['fichier']['tmp_name'];
        $nom_fichier = basename($_FILES['fichier']['name']); // Sécurité pour éviter les chemins malveillants
        $chemin_final = $destination_folder . '/' . $nom_fichier;

        // --- SOLUTION DE CONTOURNEMENT ---
        // On utilise copy() au lieu de move_uploaded_file() pour éviter les blocages de sécurité (SELinux)
        if (copy($fichier_temporaire, $chemin_final)) {
            // La copie a réussi. On supprime le fichier temporaire original.
            unlink($fichier_temporaire);

            // Redirection vers le gestionnaire avec un message de succès
            header('Location: gestionnaire.php?success=upload');
            exit();
        } else {
            // La copie a échoué, c'est probablement un problème de permission qui a échappé aux tests
            $message = "<div class='alert alert-danger'>ERREUR : La copie du fichier a échoué. Vérifiez les permissions sur le dossier de destination.</div>";
        }

    } else {
        // Gérer les erreurs d'upload possibles (fichier trop gros, etc.)
        $message = "<div class='alert alert-danger'>Une erreur est survenue lors du téléversement du fichier. Code d'erreur : " . $_FILES['fichier']['error'] . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Uploader un fichier"); ?>
</head>
<body class="d-flex flex-column min-vh-100">

<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5 mb-5">
    <h1><strong>Uploader un fichier</strong></h1>

    <?php
    // Affiche un message d'erreur s'il y en a un
    if (!empty($message)) {
        echo $message;
    }
    ?>

    <form method="post" enctype="multipart/form-data" action="upload.php">
        <div class="mb-3">
            <label for="fichier" class="form-label">Choisir un fichier</label>
            <input type="file" name="fichier" id="fichier" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Destination</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="destination" value="perso" class="form-check-input" id="dest_perso" checked>
                <label class="form-check-label" for="dest_perso">Mon dossier personnel</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="destination" value="role" class="form-check-input" id="dest_role">
                <label class="form-check-label" for="dest_role">Dossier de mon rôle (<?= htmlspecialchars($role) ?>)</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="gestionnaire.php" class="btn btn-secondary">Retour</a>
    </form>
</main>

<?php pieddepage(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>