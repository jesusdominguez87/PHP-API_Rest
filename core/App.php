<?php

namespace Core;

class App {
    function __construct() {
        $controllerName = $_GET['controller'] ?? 'product';

        $methodName = $_GET['method'] ?? 'read';

        $request_method=$_SERVER["REQUEST_METHOD"];
        switch($request_method) {
            case 'GET':
                if ($methodName == "read" || $methodName == "show"){
                    $method = $methodName;
                    break;
                } else {
                    header("Method Not Allowed");
                    echo json_encode("Method doesn't exist or isn't available through GET");
                    die();
                }

            case 'POST':
                if ($methodName == "create"){
                    $method = $methodName;
                    break;
                } else {
                    header("Method Not Allowed");
                    echo json_encode("Method doesn't exist or isn't available through POST");
                    die();
                }

            case 'PUT':
                if ($methodName == "update"){
                    $method = $methodName;
                    break;
                } else {
                    header("Method Not Allowed");
                    echo json_encode("Method doesn't exist or isn't available through PUT");
                    die();
                }

            case 'DELETE':
                if ($methodName == "delete"){
                    $method = $methodName;
                    break;
                } else {
                    header("Method Not Allowed");
                    echo json_encode("Method doesn't exist or isn't available through DELETE");
                    die();
                }

            default:
                // Invalid Request Method
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }

        $arguments = [];
        if (isset($_GET['id'])) {
            $arguments['id'] = intval($_GET["id"]);
        }

        $controllerName = ucwords($controllerName) . "Controller";


        /*$file = __DIR__ . "../app/controllers/$controllerName" . ".php";
        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "No se ha encontrado el controlador";
            die();
        }*/

        $controllerName = "\\App\\Controllers\\" . $controllerName;
        $controllerObject = new $controllerName;
        if (method_exists($controllerName, $method)) {
            $controllerObject->$method($arguments);
        } else {
            echo json_encode("No se ha encontrado el método");
            die();
        }
    }
}