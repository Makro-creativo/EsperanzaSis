<?php
    include "./config/conexion.php";
  
    // Check if id is set or not if true toggle,
    // else simply go back to the page
    if (isset($_GET['purchaseid'])){
  
        // Store the value from get to a 
        // local variable "course_id"
        $purchaseid = $_GET['purchaseid'];
  
        // SQL query that sets the status
        // to 1 to indicate activation.
        $query = "UPDATE orders_admin SET status_order = 1 WHERE purchaseid='$purchaseid'";
  
        // Execute the query
        mysqli_query($conexion, $query);
    }
  
    // Go back to course-page.php
    header('location: show-all-orders-admin.php');
?>