<?php 
    $cantidad = floatval($_POST["quantity"]);
    $indice = intval($_POST["indice"]);

    session_start();

    $_SESSION["carrito"][$indice]->quantity = $cantidad;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->quantity * $_SESSION["carrito"][$indice]->price;
    
    header("Location: ./new-orders-admin-test.php");
?>