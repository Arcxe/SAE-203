<?php
session_start();
require 'scripts/functions.php';

$users_file = __DIR__ . '/data/utilisateurs.json';
$utilisateurs = json_decode(file_get_contents($users_file), true);

$id = (int)$_GET['id'];
$utilisateur = null;

foreach ($utilisateurs as $index => $u) {
    if (isset($u['id']) && $u['id'] === $id) {
        $utilisateur = &$utilisateurs[$index];
        break;
    }
}

if (!$utilisateur) {
    echo "Utilisateur introuvable.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur['prenom'] = $_POST['prenom'];
    $utilisateur['nom'] = $_POST['nom'];
    $utilisateur['fonction'] = $_POST['fonction'];
    $utilisateur['photo'] = $_POST['photo'];
    $utilisateur['bio'] = $_POST['bio'];
    $utilisateur['role'] = $_POST['role'];
    $utilisateur['login'] = strtolower($_POST['prenom']) . '.' . strtolower($_POST['nom']);

    // On garde l'ancien mot de passe si aucun nouveau n’est fourni
    if (!empty($_POST['motdepasse'])) {
        $utilisateur['motdepasse'] = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
    }

    file_put_contents($users_file, json_encode($utilisateurs, JSON_PRETTY_PRINT));
    header('Location: annuaires.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Modifier un utilisateur"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5 mb-5">
    <h1><strong>Modifier l'utilisateur</strong></h1>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Fonction</label>
            <input type="text" name="fonction" class="form-control" value="<?= htmlspecialchars($utilisateur['fonction']) ?>">
        </div>
        <div class="mb-3">
            <label>Bio</label>
            <textarea name="bio" class="form-control"><?= htmlspecialchars($utilisateur['bio']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-control">
                <option value="salariés" <?= $utilisateur['role'] === 'salariés' ? 'selected' : '' ?>>Salariés</option>
                <option value="admin" <?= $utilisateur['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="stagiaire" <?= $utilisateur['role'] === 'stagiaire' ? 'selected' : '' ?>>Stagiaire</option>
                <option value="alternant" <?= $utilisateur['role'] === 'alternant' ? 'selected' : '' ?>>Alternant</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="motdepasse" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="annuaires.php" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php pieddepage(); ?>
</body>
</html>
