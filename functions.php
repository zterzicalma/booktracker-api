<?php

function dodajKnjigo(array $data, PDO $pdo): array {
    if (!isset($data['isbn'], $data['title'], $data['author'])) {
        return ['error' => 'Missing fields'];
    }

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO books (isbn, title, author, year_published) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['isbn'],
            $data['title'],
            $data['author'],
            $data['year_published'] ?? null
        ]);
        return ['message' => 'Book added successfully'];
    } catch (PDOException $e) {
        return ['error' => 'Database insert failed: ' . $e->getMessage()];
    }
}
