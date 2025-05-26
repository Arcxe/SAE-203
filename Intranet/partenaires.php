<?php
session_start();
require 'scripts/functions.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Timeline des partenaires - Intranet"); ?>
</head>
<body>
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-4">
        <div class="jumbotron bg-white p-4">
            <h2 class="text-primary mb-4">Nos Partenaires</h2>
            <div class="row row-cols-1 g-4">
                <?php foreach ($liste_partenaires as $partenaire): ?>
                    <div class="col">
                        <div class="card border-primary shadow-sm">
                            <div class="row g-0 align-items-center">
                                <div class="col-auto p-3">
                                    <img src="<?= htmlspecialchars($partenaire['logo']) ?>" alt="<?= htmlspecialchars($partenaire['nom']) ?>" class="img-fluid rounded" style="max-width: 80px;">
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title mb-1">
                                            <?= htmlspecialchars($partenaire['nom']) ?>
                                            <small class="text-muted">(<?= htmlspecialchars($partenaire['ville']) ?>)</small>
                                        </h5>
                                        <p class="card-text mb-0"><?= htmlspecialchars($partenaire['description']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
