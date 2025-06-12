<?php
session_start();
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partenaires_file = __DIR__ . '/data/partenaires.json';
    $partenaires = json_decode(file_get_contents($partenaires_file), true);

    // Déterminer le prochain ID
    $dernier_id = 0;
    foreach ($partenaires as $p) {
        if ($p['id'] > $dernier_id) {
            $dernier_id = $p['id'];
        }
    }

    // Gestion de l'image
    $upload_dir = __DIR__ . '/img/partenaires/';
    $image_name = basename($_FILES['logo']['name']);
    $image_path = $upload_dir . $image_name;
    $image_relative_path = 'img/partenaires/' . $image_name;

    // Vérifie et déplace le fichier
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    if (in_array($_FILES['logo']['type'], $allowed_types)) {
        move_uploaded_file($_FILES['logo']['tmp_name'], $image_path);
    } else {
        die("Type de fichier non autorisé.");
    }

    $nouveau_partenaire = [
        'id' => $dernier_id + 1,
        'nom' => $_POST['nom'],
        'ville' => $_POST['ville'],
        'logo' => $image_relative_path,
        'description' => $_POST['description'],
        'site' => $_POST['site']
    ];

    $partenaires[] = $nouveau_partenaire;
    file_put_contents($partenaires_file, json_encode($partenaires, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header('Location: annuaires.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Ajouter un partenaire entreprise"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5 mb-5">
    <h1><strong>Ajouter un partenaire entreprise</strong></h1>
    <form method="post" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label>Nom de l'entreprise</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ville</label>
            <input type="text" name="ville" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Logo (image JPG, PNG, ou WebP)</label>
            <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label>Site Web</label>
            <input type="url" name="site" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="annuaires.php" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php pieddepage(); ?>
</body>
</html>
