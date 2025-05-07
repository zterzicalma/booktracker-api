<?php
header('Content-Type: application/json');
require 'config.php';

$stmt = $pdo->query('SELECT isbn, title, author, year_published FROM books');
$books = $stmt->fetchAll();

echo json_encode($books);
?>
