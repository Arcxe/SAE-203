<?php
session_start();

$clients_file = __DIR__ . '/../data/clients.json';
$clients = json_decode(file_get_contents($clients_file), true);

$id = $_GET['id'] ?? null;

if ($id) {
    $clients = array_filter($clients, fn($client) => $client['id'] !== $id);
    file_put_contents($clients_file, json_encode(array_values($clients), JSON_PRETTY_PRINT));
}

header('Location: clients.php');
exit;
