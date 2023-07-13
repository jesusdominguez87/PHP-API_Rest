<?php

namespace Core;

require_once '../config/db.php';

use \PDO;
use \PDOException;

class Model {
    public static function db() {
        try {
            $db = new PDO("mysql:host=". HOST. ";dbname=" . DATABASE, USER, PASSWORD);
            $db->query("set charset utf8");
            // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Falló la conexión: " . $e->getMessage();
        }
        return $db;
    }

}