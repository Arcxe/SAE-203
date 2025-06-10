<?php
session_start();

$clients_file = __DIR__ . '/data/clients.json';
$clients = json_decode(file_get_contents($clients_file), true);

$id = $_GET['id'];

if ($id) {
    $nouvelle_liste = [];

    foreach ($clients as $client) {
        if ($client['id'] !== $id) {
            $nouvelle_liste[] = $client;
        }
    }

    file_put_contents($clients_file, json_encode($nouvelle_liste, JSON_PRETTY_PRINT));
}

header('Location: clients.php');
exit;

