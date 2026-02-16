<?php
require_once '../src/CurrencyService.php';
use App\CurrencyService;

header('Content-Type: application/json');

try {
    $service = new CurrencyService();
    $rate = $service->getEurRate();
    
    echo json_encode(['rate' => $rate, 'currency' => 'EUR']);
} catch (Exception $e) {
    echo json_encode(['error' => 'Nie udało się pobrać kursu']);
}