<?php
session_start();
require 'scripts/functions.php'; 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Accueil - Intranet Goelandale"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php entete(); ?>
    <?php navigation(); ?>
    <main class="container mt-5">
    <div class="p-5 text-center bg-light rounded shadow">
        <h1 class="display-5 fw-bold text-primary">Bienvenue sur notre Intranet</h1>
        <p class="lead text-muted fw-bold">Goelandale</p>
        <hr class="my-4">
        <p class="fs-5">
            <strong><?php echo $nb_users; ?></strong> utilisateurs de l'intranet
        </p>
    </div>
    </main>
    <?php pieddepage(); ?>
</body>
</html>


