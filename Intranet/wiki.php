<?php
session_start();
require 'scripts/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Wiki - Intranet"); ?>
<body>
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-4">
        <div class="bg-light p-4 rounded shadow-sm">
            <h1 class="mb-4"><strong>SAÉ 203 – Portail Web</strong></h1>
            <p class="text-muted">R&T Saint-Malo – Mars 2025</p>

            <hr>

            <h3>Contexte du projet</h3>
            <p>Développement d’un <strong>portail web complet</strong> pour une entreprise, composé de :</p>
            <ul>
                <li>Un site vitrine (WordPress)</li>
                <li>Un intranet (PHP + Bootstrap)</li>
            </ul>

            <h3>Objectifs</h3>
            <ul>
                <li>Créer une identité graphique adaptée à l’entreprise</li>
                <li>Améliorer la visibilité via un site vitrine</li>
                <li>Proposer un intranet sécurisé pour les collaborateurs</li>
            </ul>

            <h3>Fonctionnalités principales</h3>

            <h5 class="mt-3">Site vitrine (WordPress)</h5>
            <ul>
                <li>Présentation de l’entreprise et de ses activités</li>
                <li>Valorisation des partenaires</li>
                <li>Charte graphique personnalisée</li>
            </ul>

            <h5>Intranet (PHP / Bootstrap)</h5>
            <ul>
                <li>Connexion sécurisée</li>
                <li>Gestion des utilisateurs et des rôles (admin, salariés...)</li>
                <li>Partage de fichiers (.txt, .csv)</li>
                <li>Annuaire interne et partenaires</li>
                <li>Wiki interne avec documentation et identifiants</li>
            </ul>

            <h3>Stack technique</h3>
            <ul>
                <li>Apache 2.4</li>
                <li>PHP 7.4+</li>
                <li>HTML / CSS / Bootstrap 5</li>
                <li>JavaScript / JSON</li>
                <li>WordPress (vitrine)</li>
                <li><strong>Sans base de données</strong> (pas de MySQL)</li>
            </ul>

            <h3>Organisation des fichiers</h3>
            <ul>
                <li><code>/wordpress</code> → site vitrine</li>
                <li><code>/intranet</code> → espace interne</li>
            </ul>

            <hr>

            <h3>Accès à l'intranet (identifiants de test)</h3>
            <div class="alert alert-primary" role="alert">
                <strong>Nom d'utilisateur :</strong> <code>test.test</code><br>
                <strong>Mot de passe :</strong> <code>test</code>
            </div>
            <p>Ces identifiants vous permettent de vous connecter à l'intranet pour tester les fonctionnalités.</p>
        </div>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
