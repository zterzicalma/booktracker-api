<?php
header('Content-Type: application/json');
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['isbn'], $data['title'], $data['author'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO books (isbn, title, author, year_published) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $data['isbn'],
        $data['title'],
        $data['author'],
        $data['year_published'] ?? null
    ]);
    echo json_encode(['message' => 'Book added successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database insert failed']);
}
?>
