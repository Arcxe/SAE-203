<?php
session_start();
require 'scripts/functions.php';

$clients_file = __DIR__ . '/data/clients.json';
$clients = json_decode(file_get_contents($clients_file), true);

$id = (int)$_GET['id'];
$client = null;

foreach ($clients as $index => $c) {
    if ($c['id'] === $id) {
        $client = &$clients[$index];
        break;
    }
}

if (!$client) {
    echo "Client introuvable.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client['prenom'] = $_POST['prenom'];
    $client['nom'] = $_POST['nom'];
    $client['adresse'] = $_POST['adresse'];
    $client['email'] = $_POST['email'];
    $client['telephone'] = $_POST['telephone'];

    file_put_contents($clients_file, json_encode($clients, JSON_PRETTY_PRINT));
    header('Location: clients.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Modifier un client"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5">
    <h1>Modifier le client</h1>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($client['prenom']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($client['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?= htmlspecialchars($client['adresse']) ?>">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($client['email']) ?>">
        </div>
        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($client['telephone']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="clients.php" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php pieddepage(); ?>
</body>
</html>
