<?php
/*Jesus Dominguez Bueno*/


namespace App\Models;
use Core\Model;
use \PDO;
use \PDOException;

class Manufacturer {
    public static function read() {
        try {
            $query = "select * from manufacturer";
            $stmt = Model::db()->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $response[] = $row;
            }
            header("Content-Type: application/json");
            echo json_encode($response ?? "No hay datos(Manufacturers)");

        } catch (PDOException $e){
            die("Error en el read manufacturers" . $e->getMessage());
        }
    }

    /*public static function getManufacturer($name) {
        try {
            $query = "select id from manufacturer where name =".$name;
            $stmt = Model::db()->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();

        } catch (PDOException $e){
            die($e->getMessage());
        }
    }*/
}