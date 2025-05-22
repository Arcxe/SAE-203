<?php
session_start();
require 'scripts/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Wiki & Fonctionnalités - Intranet"); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-5">
        <h1 class="mb-4"><strong>Wiki & Fonctionnalités</strong></h1>
        <p class="lead">Découvrez les principales fonctionnalités utilisées pour faire fonctionner BlaBla Voiture.</p>

        <section class="mb-5">
            <h3><strong>Ce qui fonctionne sur le site</strong></h3>
            <p>Le site est entièrement fonctionnel et propose les services suivants :</p>
            <ul class="list-group">
                <li class="list-group-item">Inscription et connexion des utilisateurs avec gestion des rôles.</li>
                <li class="list-group-item">Création, affichage et modification des annonces de covoiturage.</li>
                <li class="list-group-item">Inscription des utilisateurs aux annonces, avec mise à jour des places restantes.</li>
                <li class="list-group-item">Affichage des trajets et filtrage selon les critères de recherche.</li>
                <li class="list-group-item">Gestion des sessions et redirections sécurisées.</li>
                <li class="list-group-item">Stockage des données en JSON et manipulation efficace avec PHP.</li>
            </ul>
            <p class="mt-3"><strong>Ce qui n'a pas été utilisé :</strong> <br>
            <span class="text-danger">Le site ne fait pas appel à Fetch API</span>. Toutes les interactions se font via des requêtes PHP sans AJAX ou JavaScript.</p>
        </section>

        <section class="mb-5">
            <h3><strong>Outils et fonctions utilisés</strong></h3>
            <p>Notre plateforme repose sur différentes fonctionnalités de PHP pour assurer la gestion des utilisateurs et des annonces :</p>
            <ul class="list-group">
                <li class="list-group-item"><strong>Sessions :</strong> <code>session_start()</code> permet de conserver l’état d’un utilisateur connecté.</li>
                <li class="list-group-item"><strong>Vérifications :</strong> <code>isset()</code> est utilisé pour s’assurer de l’existence des variables.</li>
                <li class="list-group-item"><strong>Sécurité :</strong> Nous chiffrons les mots de passe avec <code>password_hash()</code> et les validons avec <code>password_verify()</code>.</li>
                <li class="list-group-item"><strong>Stockage des données :</strong> Les annonces et utilisateurs sont enregistrés au format JSON grâce à <code>json_encode()</code> et <code>json_decode()</code>.</li>
                <li class="list-group-item"><strong>Lecture & écriture :</strong> <code>file_get_contents()</code> et <code>file_put_contents()</code> permettent de mettre à jour les fichiers de données.</li>
                <li class="list-group-item"><strong>Filtrage des annonces :</strong> <code>array_filter()</code> est utilisé pour afficher les covoiturages selon les critères de recherche.</li>
                <li class="list-group-item"><strong>Navigation :</strong> <code>header()</code> est employé pour rediriger les utilisateurs après certaines actions.</li>
            </ul>
        </section>

        <section class="mb-5">
            <h3><strong>Comptes de test</strong></h3>
            <p>Voici des comptes disponibles pour essayer les fonctionnalités du site :</p>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Utilisateur</th>
                        <th>Mot de passe</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>test</code></td>
                        <td><code>test</code></td>
                        <td>Compte Test</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-muted">Les mots de passe sont stockés de façon sécurisée, mais ces identifiants peuvent être utilisés pour tester.</p>
        </section>

        <section>
            <h3><strong>Ressources pour aller plus loin</strong></h3>
            <p>Si vous souhaitez en savoir plus sur les technologies utilisées :</p>
            <ul>
                <li><a href="https://www.php.net/manual/fr/" target="_blank">Documentation PHP</a></li>
                <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap – Design Responsive</a></li>
                <li><a href="https://www.w3schools.com/bootstrap/" target="_blank">W3Schools – Apprendre Bootstrap</a></li>
            </ul>
            <br>
        </section>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
