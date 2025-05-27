<?php
session_start();
require 'scripts/functions.php'; // contient $liste_clients
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Annuaires clients - Intranet"); ?>
</head>
<body class="d-flex flex-column min-vh-100">

<?php entete(); ?>
<?php navigation(); ?>

<main class="container mt-5">
    <h1><strong>Liste des Clients</strong></h1>  
    <p><strong>Voici tous nos clients enregistrés</strong></p>

    <div class="mb-3">
        <a href="ajouter_client.php" class="btn btn-primary">+ Ajouter un client</a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
                <th>Téléchargement</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste_clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['prenom']) ?></td>
                    <td><?= htmlspecialchars($client['nom']) ?></td>
                    <td>
                        <a href="https://www.google.com/maps?q=<?= urlencode($client['adresse']) ?>" target="_blank" rel="noopener noreferrer">
                            <?= htmlspecialchars($client['adresse']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($client['email']) ?></td>
                    <td><?= htmlspecialchars($client['telephone']) ?></td>
                    <td class="text-center">
                        <a href="modifier_client.php?id=<?= urlencode($client['id']) ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="supprimer_client.php?id=<?= urlencode($client['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce client ?');">Supprimer</a>
                    </td>
                    <td>
                        <a href="telecharger_fiche.php?id=<?= urlencode($client['id']) ?>" class="btn btn-sm btn-primary" target="_blank">Télécharger PDF</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php pieddepage(); ?>

</body>
</html>
