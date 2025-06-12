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

    <main class="container mt-4 mb-5">
        <h1 class="mb-4"><strong>Nos Partenaires</strong></h1>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <div class="mb-3">
                    <a href="ajouter_partenaire.php" class="btn btn-primary">Ajouter un partenaire</a>
                </div>
            <?php endif; ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($liste_partenaires as $partenaire): ?>
                <div class="col">
                    <a href="<?= htmlspecialchars($partenaire['site']) ?>" target="_blank" class="text-decoration-none text-dark">
                        <div class="card h-100 border-primary">
                            <img src="<?= htmlspecialchars($partenaire['logo']) ?>" class="card-img-top" alt="<?= htmlspecialchars($partenaire['nom']) ?>">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">
                                    <?= htmlspecialchars($partenaire['nom']) ?>
                                    <small class="text-muted">(<?= htmlspecialchars($partenaire['ville']) ?>)</small>
                                </h5>
                                <p class="card-text"><?= htmlspecialchars($partenaire['description']) ?></p>
                            </div>
                             <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <div class="card-footer bg-transparent border-top-0 mt-auto text-end">
                                    <a href="supprimer_partenaire.php?id=<?= $partenaire['id'] ?>" class="btn btn-danger btn-sm">
                                        Supprimer
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                    </a>
                     
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
