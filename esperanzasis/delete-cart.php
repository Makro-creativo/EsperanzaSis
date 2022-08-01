<?php 
    if(!isset($_GET["indice"])) return;

    $indice = $_GET["indice"];
    
    if(!isset($_SESSION)) {
        session_start();
    }

    array_splice($_SESSION["carrito"], $indice, 1);

    header("Location: ./new-orders-admin-test.php");

?>