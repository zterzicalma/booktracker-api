<?php
header('Content-Type: application/json');

require 'config.php';
require 'functions.php';

// Preberi JSON vhod
$data = json_decode(file_get_contents("php://input"), true);

// Pokliči funkcijo za dodajanje knjige
$response = dodajKnjigo($data, $pdo);

// Vrni odgovor kot JSON
if (isset($response['error'])) {
    http_response_code(400);
} else {
    http_response_code(200);
}

echo json_encode($response);
