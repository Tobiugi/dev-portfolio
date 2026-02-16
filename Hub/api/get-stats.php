<?php
require_once '../src/Database.php';
use App\Database;

header('Content-Type: application/json');

try {
    $db = Database::getInstance();
    
    $sql = "SELECT c.name as label, SUM(p.stock) as total_stock 
            FROM categories c 
            LEFT JOIN products p ON c.id = p.category_id 
            GROUP BY c.id";
            
    $stmt = $db->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    Database::log("Pobrano statystyki magazynowe przez API");

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}