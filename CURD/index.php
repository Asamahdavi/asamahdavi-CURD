<?php

use CRUD\Controller\PersonController;


include ("loader.php");
$connection = new \CRUD\Helper\DBConnector();
try {
    $connection->connect();
} catch (Exception $e) {
}

$controller = new PersonController();
$controller->switcher($_SERVER['REQUEST_URI'],$_REQUEST);