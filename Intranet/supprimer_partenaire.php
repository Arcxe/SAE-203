<?php
session_start();

$partenaires_file = __DIR__ . '/data/partenaires.json';
$partenaires = json_decode(file_get_contents($partenaires_file), true);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Force l'ID en entier

    $nouvelle_liste = [];

    foreach ($partenaires as $partenaire) {
        if ((int)$partenaire['id'] !== $id) {
            $nouvelle_liste[] = $partenaire;
        }
    }

    file_put_contents($partenaires_file, json_encode($nouvelle_liste, JSON_PRETTY_PRINT));
}

header('Location: annuaires.php');
exit;
