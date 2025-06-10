<?php
session_start();
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateurs_file = __DIR__ . '/data/utilisateurs.json';
    $utilisateurs = json_decode(file_get_contents($utilisateurs_file), true);

    $nouvel_utilisateur = [
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'fonction' => $_POST['fonction'],
        'photo' => 'img/utilisateurs/' . $_POST['login'] . '.png',
        'bio' => $_POST['bio'],
        'role' => $_POST['role'],
        'login' => strtolower($_POST['prenom'] . "." . $_POST['nom']),
        'motdepasse' => password_hash($_POST['motdepasse'], PASSWORD_DEFAULT)
    ];

    $utilisateurs[] = $nouvel_utilisateur;
    file_put_contents($utilisateurs_file, json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

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

<main class="container mt-5 mb-5">
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
            <label>Fonction</label>
            <input type="text" name="fonction" class="form-control">
        </div>
        <div class="mb-3">
            <label>Bio</label>
            <textarea name="bio" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-control" required>
                <option value="salariés">Salarié</option>
                <option value="admin">Admin</option>
                <option value="stagiaire">Stagiaire</option>
                <option value="consultant">Consultant</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="motdepasse" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="annuaires.php" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php pieddepage(); ?>
</body>
</html>
