<?php
session_start();
require 'scripts/functions.php';

if (isset($_POST['connexion'])) {
    $utilisateur = $_POST['utilisateur'];  
    $motdepasse = $_POST['motdepasse'];
    
    
    $erreur = '';

    
    foreach ($liste_users as $i) {
        if ($i['login'] == $utilisateur && password_verify($motdepasse,$i['motdepasse'])) {
            $_SESSION['user'] = $i;
            header('Location: accueil.php'); // Redirection vers la page d'accueil
            exit();
        }
    }
    
    $erreur = 'Utilisateur ou mot de passe incorrect.';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Connexion - Intranet"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-4">
        <h2><strong>Se connecter</strong></h2>

        <!-- Affichage des erreurs si elles existent -->
        <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $erreur; ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form method="POST">
            <div class="mb-3">
                <label for="utilisateur" class="form-label">Utilisateur</label>
                <input type="text" id="utilisateur" name="utilisateur" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="motdepasse" class="form-label">Mot de passe</label>
                <input type="password" id="motdepasse" name="motdepasse" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" name="connexion">Se connecter</button>
        </form>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
