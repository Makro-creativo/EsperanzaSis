<?php
include "./config/conexion.php";

if(isset($_POST['save'])) {
  $idClient = $_POST['id_client'];
  $dateSend = $_POST['date_send'];
  $statusPayment = $_POST['status_payment'];
  $numberNote = FLOOR(RAND()*(99-1)+1);
  $totalOrder = 0;

  foreach($_POST['quantity'] as $key => $quantity) { 
    $price = $_POST['price'][$key];
    $total = $price * $quantity;
    $totalOrder += $total;
  }

  
  $sqlInsertOrder = "INSERT INTO new_orders_admin (client_id, date_send, status_payment, number_note, status_deleted, amount, created_at) VALUES ('$idClient', '$dateSend', '$statusPayment', '$numberNote', '0', '$totalOrder', NOW())";
  $insertOrder = mysqli_query($conexion, $sqlInsertOrder);

  if($insertOrder) {
    $idOrder = mysqli_insert_id($conexion);

    foreach($_POST['quantity'] as $key => $quantity) { 
      if($quantity != 0){
        $product_id = $_POST['product_id'][$key]; 
        $price = $_POST['price'][$key];
        $unidad = $_POST['unidad'][$key];
        
        $sqlInsertDetail = "INSERT INTO purchase_detail_admin (purchaseid, productid, price, quantity, unidad) VALUES ('$idOrder', '$product_id', '$price', '$quantity', '$unidad')";
        $insertDetail = mysqli_query($conexion, $sqlInsertDetail);
      }

      if(!$insertDetail) {
        mysqli_query($conexion, "DELETE FROM new_ordens_admin WHERE id = '$idOrder'");
          echo "<script>window.location='new-orders-admin.php?error'; </script>";
        exit;
      }
    }

    header("location: show-tickets-new-order-admin.php?purchaseid=$idOrder");
  } else {
    echo "<script>window.location='new-orders-admin.php?success'; </script>";
  }
}

?>