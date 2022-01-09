<?php

use CRUD\Controller\PersonController;


include ("loader.php");
$connection = new \CRUD\Helper\DBConnector();
try {
    $connection->connect();
} catch (Exception $e) {
    echo "not found"."<br>" ;
}

$controller = new PersonController();
try {
    $controller->switcher($_SERVER['REQUEST_URI'], $_REQUEST);
} catch (Exception $e) {
}