<?php
/*Jesus Dominguez Bueno*/


namespace App\Models;
use Core\Model;
use \PDO;
use \PDOException;

class Product {
    public static function read() {
        try {
            $query = "select * from product";
            $stmt = Model::db()->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $response[] = $row;
            }
            header("Content-Type: application/json");
            echo json_encode($response ?? "No hay datos(Products)");

        } catch (PDOException $e){
            die("Error en el read product" . $e->getMessage());
        }
    }

    public static function show($id) {
        try {
            $query = "select * from product where id = " . $id;
            $stmt = Model::db()->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $response = $row;
            }
            header("Content-Type: application/json");
            echo json_encode($response ?? "No hay ningún producto con id: " . $id);

        } catch (PDOException $e){
            die("Error en el show product(id: ". $id . ")" . $e->getMessage());
        }
    }

    public static function create() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data["name"];
            $price = $data["price"];
            $manufacturer = $data["manufacturerId"];

            $query = "INSERT INTO product (name, price, manufacturerId) VALUES ('$name', '$price', '$manufacturer')";

            if(Model::db()->exec($query)) {
                $response = [
                    'status' => 1,
                    'status_message' => 'Product Added Successfully'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'status_message' => 'Product Addition Failed'
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function update($id) {
        try {
            $predata = file_get_contents("php://input");
            $data = json_decode($predata, true);

            $stmt = Model::db()->prepare("UPDATE product SET name = :name, price = :price, manufacturerId = :manufacturerId WHERE id = " . $id);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
            $stmt->bindParam(':manufacturerId', $data['manufacturerId'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                $response = [
                    'status' => 1,
                    'message' => 'Product Updated Successfully'
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Product Update Failed'
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public static function delete($id) {
        try {
            $query="DELETE FROM product WHERE id=".$id;
            if(Model::db()->exec($query)) {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Product Deleted Successfully'
                );
            } else {
                $response=array(
                    'status' => 0,
                    'status_message' => 'Product Deletion Failed'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}