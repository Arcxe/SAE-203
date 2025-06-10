<?php
session_start();
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateurs = json_decode(file_get_contents(__DIR__ . '/data/utilisateurs.json'), true);

    $nouvel_utilisateur = [
        'id' => uniqid(),
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone']
    ];

    $utilisateurs[] = $nouvel_utilisateur;
    file_put_contents(__DIR__ . '/data/utilisateurs.json', json_encode($utilisateurs, JSON_PRETTY_PRINT));

    header('Location: annuaires.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Ajouter un utilisateur"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5">
    <h1><strong>Ajouter un utilisateur</strong></h1>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Adresse</label>
            <input type="text" name="adresse" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="annuaires.php" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php pieddepage(); ?>
</body>
</html>
