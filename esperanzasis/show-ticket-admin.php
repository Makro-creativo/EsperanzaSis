<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $purchaseid = $_GET['purchaseid'];
        

        $query_total = "SELECT total FROM orders_admin WHERE purchaseid = '$purchaseid'";
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

            <div class="grid-three">
                <p>Tortillería la Esperanza</p>
                <p>Av. Paseo de la Primavera número #2195</p>
                <p>Colonia Arenales Tapatios Zapopan Jalisco</p>
            </div>

            <div class="column-two">
                <p>Código postal: 45060</p>
                <p>Telefono: 3312 333924</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Dirección de entrega</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>$Precio Unitario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                            include "./config/conexion.php";
                            $id_pedido = $_GET['purchaseid'];

                            $query_ticket = "SELECT * FROM orders_admin INNER JOIN purchase_detail_admin ON orders_admin.purchaseid = purchase_detail_admin.purchaseid INNER JOIN products ON purchase_detail_admin.productid = products.productid AND purchase_detail_admin.purchaseid = '$id_pedido' AND id_user = 'Administrador'";
                            $result = mysqli_query($conexion, $query_ticket);

                                while($row = mysqli_fetch_array($result)) {                    
                            ?>

                            <tr>
                                <td>
                                    <?php echo $row['address_send']; ?>
                                </td>

                                <td>
                                    <?php echo $row['quantity']; ?>
                                </td>

                                <td>
                                    <?php echo $row['name_product']; ?>
                                </td>

                                <td>
                                    <?php 
                                        echo number_format($row['price'], 2);
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