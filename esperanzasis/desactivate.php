<?php
  
    include "./config/conexion.php";
  
    if (isset($_GET['purchaseid'])){
  
        $purchaseid = $_GET['purchaseid'];
  
        $query =" UPDATE `orders` SET `status`= 0 WHERE purchaseid='$purchaseid'";
  
        mysqli_query($conexion, $query);
    }
  
    header('location: show-all-orders.php');
?>