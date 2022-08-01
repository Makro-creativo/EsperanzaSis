<?php 
    include "./config/conexion.php";

   if(isset($_GET['purchaseid'])) {
       $idOrderAdmin = $_GET['purchaseid'];

       $query_delete_order_admin = "DELETE FROM orders_admin WHERE purchaseid = '$idOrderAdmin'";
       $result_delete = mysqli_query($conexion, $query_delete_order_admin);

       if(!$result_delete) {
           die("No se pudo eliminar correctamente el pedido, intentelo de nuevo...");
       }

       header("location: show-all-orders-admin.php");
   }
?>