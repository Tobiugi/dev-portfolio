<?php
namespace App;

use PDO;

class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new PDO("mysql:host=localhost;dbname=hub", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }

    public static function log($action) {
        $db = self::getInstance();
        $stmt = $db->prepare("INSERT INTO system_logs (action) VALUES (?)");
        $stmt->execute([$action]);
    }
}