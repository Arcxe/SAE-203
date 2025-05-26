<?php
session_start();
require 'scripts/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Wiki - Intranet"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-4">
        <div class="bg-light p-4 rounded shadow-sm">
            <h1 class="mb-4"><strong>🌐 SAÉ 203 – Portail Web</strong></h1>
            <p><strong>R&T Saint-Malo – Mars 2025</strong></p>

            <hr>

            <h3>📘 Contexte</h3>
            <p>Projet de création d’un <strong>portail web complet</strong> pour une entreprise, comprenant :</p>
            <ul>
                <li>Un <strong>site vitrine</strong> (WordPress)</li>
                <li>Un <strong>intranet</strong> (PHP + Bootstrap)</li>
            </ul>

            <h3>🎯 Objectifs</h3>
            <ul>
                <li>Définir une <strong>identité graphique numérique</strong> pour le site</li>
                <li>Développer un site vitrine pour améliorer la visibilité</li>
                <li>Créer un intranet sécurisé pour les collaborateurs</li>
            </ul>

            <h3>🛠️ Fonctionnalités principales</h3>

            <h5 class="mt-3">🔹 Site vitrine (WordPress)</h5>
            <ul>
                <li>Présentation de l’entreprise, ses activités, son histoire</li>
                <li>Mise en avant des partenaires</li>
                <li>Charte graphique personnalisée</li>
            </ul>

            <h5>🔹 Intranet (PHP / Bootstrap)</h5>
            <ul>
                <li>Portail de connexion sécurisé</li>
                <li>Gestion des utilisateurs & groupes (<code>admin</code>, <code>salariés</code>, etc.)</li>
                <li>Partage de fichiers <code>.txt</code> / <code>.csv</code></li>
                <li>Annuaire interne + partenaires + clients</li>
                <li>Wiki interne (aide + identifiants de test)</li>
            </ul>

            <h3>🧱 Stack technique</h3>
            <ul>
                <li>Apache 2.4</li>
                <li>PHP 7.4+</li>
                <li>HTML / CSS / Bootstrap 5</li>
                <li>JavaScript / JSON</li>
                <li>WordPress (vitrine)</li>
                <li><strong>Sans base de données</strong> (pas de MySQL)</li>
            </ul>

            <h3>📂 Organisation</h3>
            <ul>
                <li><code>/wordpress</code> → site vitrine</li>
                <li><code>/intranet</code> → espace interne</li>
            </ul>

            <hr>

            <h3>🔐 Identifiants de test</h3>
            <p>Vous pouvez utiliser ces identifiants pour vous connecter à l’intranet :</p>
            <ul>
                <li><strong>test / test</strong></li>
            </ul>
        </div>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
