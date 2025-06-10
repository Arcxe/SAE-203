<?php
session_start();

$utilisateurs_file = __DIR__ . '/data/utilisateurs.json';
$utilisateurs = json_decode(file_get_contents($utilisateurs_file), true);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Force l'ID en entier

    $nouvelle_liste = [];

    foreach ($utilisateurs as $utilisateur) {
        if ((int)$utilisateur['id'] !== $id) {
            $nouvelle_liste[] = $utilisateur;
        }
    }

    file_put_contents($utilisateurs_file, json_encode($nouvelle_liste, JSON_PRETTY_PRINT));
}

header('Location: annuaires.php');
exit;
