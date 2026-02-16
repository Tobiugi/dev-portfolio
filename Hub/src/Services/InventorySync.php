<?php
namespace App\Services;

class InventorySync {
    public function fetchExternalStock() {
        $json = file_get_contents('https://jsonplaceholder.typicode.com/posts/1'); 
        $data = json_decode($json, true);
        
        return "Zsynchronizowano pomyślnie o " . date('H:i:s');
    }
}