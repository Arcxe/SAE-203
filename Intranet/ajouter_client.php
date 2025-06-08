<?php
session_start();
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $liste_clients;
    $clients_file = __DIR__ . '/data/clients.json';

    $nouveau_client = [
        'id' => uniqid(),
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone']
    ];

    $liste_clients[] = $nouveau_client;
    file_put_contents($clients_file, json_encode($liste_clients, JSON_PRETTY_PRINT));

    header('Location: clients.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Ajouter un client"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-5 mb-5">
        <h1><strong>Ajouter un client</strong></h1>
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
            <a href="clients.php" class="btn btn-secondary">Annuler</a>
        </form>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
