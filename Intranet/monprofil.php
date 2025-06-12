<?php
session_start();
require 'scripts/functions.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$login = $_SESSION['user']['login'];
$utilisateurs_file = 'data/utilisateurs.json';
$utilisateurs = json_decode(file_get_contents($utilisateurs_file), true);

$utilisateur_index = null;
foreach ($utilisateurs as $index => $u) {
    if ($u['login'] === $login) {
        $utilisateur_index = $index;
        break;
    }
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_FILES['photo']) &&
    $_FILES['photo']['error'] === UPLOAD_ERR_OK &&
    $utilisateur_index !== null
) {
    $dossier = 'img/utilisateurs/';
    $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

    $extensions_autorisees = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $extensions_autorisees)) {
        header('Location: monprofil.php?error=extension');
        exit;
    }

    $chemin_photo = $dossier . $login . '.' . $extension;

    move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_photo);

    $utilisateurs[$utilisateur_index]['photo'] = $chemin_photo;
    file_put_contents($utilisateurs_file, json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $_SESSION['user']['photo'] = $chemin_photo;

    header('Location: monprofil.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Mon Profil"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5 mb-5">
    <h1><strong>Ma photo de profil</strong></h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Photo mise à jour avec succès !</div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'extension'): ?>
        <div class="alert alert-danger">Format de fichier non autorisé. Seuls les PNG et JPG sont acceptés.</div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label>Photo actuelle :</label><br>
            <img src="<?php
                if (isset($_SESSION['user']['photo'])) {
                    echo htmlspecialchars($_SESSION['user']['photo']);
                } else {
                    echo 'img/utilisateurs/default.png';
                }
            ?>" alt="Photo de profil" style="max-width: 150px; border-radius: 8px;">
        </div>
        <div class="mb-3">
            <label for="photo">Nouvelle photo (PNG ou JPG)</label>
            <input type="file" name="photo" id="photo" accept="image/png, image/jpeg" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Changer la photo</button>
    </form>
</main>

<?php pieddepage(); ?>
</body>
</html>
