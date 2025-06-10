<?php
session_start();
require 'scripts/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php parametres("Liste des employés - Intranet"); ?>
</head>
<body>
    <?php entete(); ?>
    <?php navigation(); ?>

    <main class="container mt-4">
        <div class="jumbotron bg-light p-4">
            <h1><strong>Nos employés</strong></h1>
            <br>
            <div class="mb-3">
                <a href="ajouter_utilisateur.php" class="btn btn-primary">+ Ajouter un utilisateur</a>
            </div>

            <div class="row">
                <?php 
                foreach ($liste_users as $i) {
                    // Détermination du chemin vers la photo
                    $photoPath = "img/utilisateurs/" . $i['login'] . ".png";
                    if (!file_exists($photoPath)) {
                        $photoPath = "img/goelandale.png"; // Fallback si photo absente
                    }

                    echo "<div class='col-md-4 col-sm-6 mb-4'>";
                        echo "<div class='card shadow-sm border-primary h-100'>";
                            echo "<div class='card-header bg-primary text-white text-center fw-bold'>";
                                echo "<p><strong> Prenom :</strong> {$i['prenom']}</p>";
                                echo "<p><strong> Nom :</strong> {$i['nom']}</p>";
                            echo "</div>";

                            echo "<div class='text-center mt-3'>";
                                echo "<img src='$photoPath' alt='Photo de {$i['prenom']}' class='rounded-circle mb-3' style='width: 80px; height: 80px; object-fit: cover;'>";
                            echo "</div>";

                            echo "<div class='card-body'>";
                                echo "<p><strong> Fonction :</strong> {$i['fonction']}</p>";
                                echo "<p><strong> Role :</strong> {$i['role']}</p>";
                                echo "<p><strong>💬 Bio :</strong> {$i['bio']}</p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </main>

    <?php pieddepage(); ?>
</body>
</html>
