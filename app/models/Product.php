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
            $name = $_POST["name"];
            $price = $_POST["price"];
            $manufacturer = $_POST["manufacturerId"];

            $query = "INSERT INTO product (name, price, manufacturerId) VALUES ('$name', '$price', '$manufacturer')";

            if(Model::db()->exec($query)) {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Product Added Successfully.'
                );
            }
            else {
                $response=array(
                    'status' => 0,
                    'status_message' => 'Product Addition Failed.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /*public static function update($id) {
        try {
            parse_str(file_get_contents("php://input"), $data);

            $name = $data['name'];
            $price = $data['price'];
            $manufacturerId = $data['manufacturerId'];

            $stmt = Model::db()->prepare("UPDATE product SET name = ". $name .", price = ". $price .", manufacturerId = ". $manufacturerId ." WHERE id = " . $id);

            if ($stmt->execute()) {
                $res = [
                    'status' => 1,
                    'message' => 'Product Updated Successfully'
                ];
            } else {
                $res = [
                    'status' => 0,
                    'message' => 'Product Update Failed'
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($res);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }*/

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