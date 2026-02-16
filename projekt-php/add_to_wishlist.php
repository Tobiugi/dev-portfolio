<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['productId'] ?? null;

if ($product_id) {
    $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE product_id = ?");
    $stmt->execute([$product_id]);
    
    if ($stmt->fetch()) {
        $stmt = $pdo->prepare("DELETE FROM wishlist WHERE product_id = ?");
        $stmt->execute([$product_id]);
        echo json_encode(['status' => 'removed']);
    } else {
        $stmt = $pdo->prepare("INSERT INTO wishlist (product_id) VALUES (?)");
        $stmt->execute([$product_id]);
        echo json_encode(['status' => 'added']);
    }
}