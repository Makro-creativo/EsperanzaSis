<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $purchaseid = $_GET['purchaseid'];

        $query_total = "SELECT total FROM orders WHERE purchaseid = '$purchaseid'";
        $result_total = mysqli_query($conexion, $query_total);

        if($result_total) {
            $rowTotal = mysqli_fetch_array($result_total);

            $total = $rowTotal['total'];
        }
    }

    $uid = $_SESSION['UID'];
    
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <title>EsperanzaSis</title>

    <link rel="stylesheet" href="assets/css/ticket.css">
</head>
<body>
        <div class="ticket">
            <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo la esperanza" class="center">
            <?php 
                include "./config/conexion.php";

                if(isset($_GET['purchaseid'])) {
                    $purchaseid = $_GET['purchaseid'];
                    

                    $query_total = "SELECT * FROM orders WHERE purchaseid = '$purchaseid'";
                    $result_total = mysqli_query($conexion, $query_total);

                    if($result_total) {
                        $rowTwo = mysqli_fetch_array($result_total);

                        $dateSend = $rowTwo['date_send'];
                    }
                }

                
            ?>

            <div class="grid-three">
                <p>Tortillería la Esperanza</p>
                <p>Av. Paseo de la Primavera número #2195</p>
                <p>Colonia Arenales Tapatios Zapopan Jalisco</p>
                <p>Fecha: <?php echo $dateSend; ?></p>
            </div>

            <div class="grid-three">
                <?php 
                    include "./config/conexion.php";

                    $search_data_tickets = "SELECT * FROM orders WHERE purchaseid = '$purchaseid'";
                    $result_data_tickets = mysqli_query($conexion, $search_data_tickets);

                    while($rowTickets = mysqli_fetch_array($result_data_tickets)) { 
                        $numberNoteOne = $rowTickets['number_note'];
                        $numberNoteTwo = $rowTickets['number_note_two'];
                ?>

                <p>Código postal: 45060</p>
                <p>Telefono: 3312 333924</p>
                <p>Número de nota:
                    <?php 
                        if(!$numberNoteOne) {
                            echo $numberNoteTwo;
                        } else {
                            echo $numberNoteOne;
                        }
                    ?>
                </p>

                <?php }?>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                            include "./config/conexion.php";
                            $id_pedido = $_GET['purchaseid'];

                            $query_ticket = "SELECT * FROM orders INNER JOIN purchase_detail ON orders.purchaseid = purchase_detail.purchaseid INNER JOIN products ON purchase_detail.productid = products.productid AND purchase_detail.purchaseid = '$id_pedido'";
                            $result = mysqli_query($conexion, $query_ticket);

                                while($row = mysqli_fetch_array($result)) {
                                    $idProduct = $row['productid']; //30
                                    $priceNormal = number_format($row['price'], 2);
                                    $idUser = $row['id_user'];
                                    $quantity = $row['quantity'];

                                    //Buscar si es que existe un descuento
                                    $searchData = "SELECT * FROM promotions WHERE productid='$idProduct' AND id_user = '$idUser'";
                                    $result_price = mysqli_query($conexion, $searchData);

                                    $rowProductDiscount = mysqli_fetch_array($result_price);
                                    $discountProduct = $rowProductDiscount['discount'];
                                                        
                            ?>

                            <tr>
                                <td><?php echo $row['client_name']; ?></td>

                                <td style="text-align: center !important;">
                                    <?php echo $row['quantity']; ?>
                                </td>

                                <td>
                                    <?php echo $row['name_product']; ?>
                                </td>


                                <td style="text-align: center;">
                                    <?php 
                                        if($discountProduct) {
                                            $discountWithSubtotal = $priceNormal - $discountProduct;
                                                                
                                            $subtotal = $quantity * $discountWithSubtotal;

                                            echo number_format($subtotal, 2);
                                        } else {
                                            $total_original = $priceNormal * $quantity;

                                            echo number_format($total_original, 2);
                                        }
                                    ?>
                                </td>

                        <?php }?>
                </tbody>
            </table>

            <div class="content">
                <h3 style="color: black; font-weight: bold;">
                    TOTAL: $<?php echo number_format($total, 2); ?>
                </h3>
            </div>

            <p class="center">¡GRACIAS POR SU COMPRA!<br>laesperanzatortilleria.com</p>
        </div>

        <button class="hidde-print btn-print" onclick="printTicket()">Imprimir ticket</button>


    <script>
        function printTicket() {
            window.print();
        }
    </script>
</body>
</html>