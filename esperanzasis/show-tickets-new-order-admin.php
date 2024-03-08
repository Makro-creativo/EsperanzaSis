<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>EruptionSys</title>
        <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            * {
                font-size: 12px;
                font-family: 'Courier New', 'Lucida Sans Typewriter', 'system';
            }

            td,
            th,
            tr,
            table {
                border-top: 1px solid black;
                border-collapse: collapse;
            }

            td.description,
            th.description {
                width: 75px;
                max-width: 75px;
            }

            td.quantity,
            th.quantity {
                width: 40px;
                max-width: 40px;
                
            }

            td.price,
            th.price {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            .centered {
                text-align: center;
                align-content: center;
            }

            .ticket {
                width: 155px;
                max-width: 155px;
            }

            img {
                max-width: inherit;
                width: inherit;
            }

            
            hr.style5 {
                background-color: #fff;
                border-top: 4px dashed #8c8b8b;
            }

            .btn-print {
                background-color: #fafafa;
                margin: 1rem;
                padding: 1rem;
                border: 2px solid #ccc;
                /* IMPORTANTE */
                text-align: center;
                width: 120px;
                background-color:#262959;
                color: #fafafa;
                cursor: pointer;
                border-color: #262959;
                font-family: 'Courier New', 'Lucida Sans Typewriter', 'system';
            }
            
            .btn-print-2 {
                background-color: #fafafa;
                margin: 1rem;
                padding: 1rem;
                border: 2px solid #ccc;
                text-decoration: none;
                /* IMPORTANTE */
                text-align: center;
                width: 120px;
                background-color: #2AA452;
                color: #fafafa;
                cursor: pointer;
                border-color: #2AA452;
                font-family: 'Courier New', 'Lucida Sans Typewriter', 'system';
            }
            
            .btn-print-3 {
                background-color: #fafafa;
                margin: 1rem;
                padding: 1rem;
                border: 2px solid #ccc;
                text-decoration: none;
                /* IMPORTANTE */
                text-align: center;
                width: 120px;
                background-color: black;
                color: #fafafa;
                cursor: pointer;
                border-color: black;
                font-family: 'Courier New', 'Lucida Sans Typewriter', 'system';
            }

            .btn-print-2:hover {
                color: #fafafa;
            }
            
            .btn-print-3:hover {
                color: #fafafa;
            }
            
            .fw-bold {
                font-weight: bold;
                font-size: 1.2rem;
            }


            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="ticket">
            <img src="./assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo">
            <?php 
                include "./config/conexion.php";

                if(isset($_GET['purchaseid'])) {
                    $idOrder = $_GET['purchaseid'];
                    

                    $query_orders = "SELECT * FROM new_orders_admin WHERE id = '$idOrder'";
                    $result_orders = mysqli_query($conexion, $query_orders);

                    if($result_orders) {
                        $rowTwo = mysqli_fetch_array($result_orders);

                        $createdAt = $rowTwo['date_send'];
                        $numberNoteOne = $rowTwo['number_note'];
                        $statusPayment = $rowTwo['status_payment'];
                    }
                } 
            ?>
            <p class="centered fw-bold">Tortillería la Esperanza
                <br>Av. Paseo de la Primavera número #2195
                <br>Colonia Arenales Tapatios Zapopan Jalisco
                <br>Fecha: <?php echo date("d/m/Y", strtotime($createdAt)); ?>
                <br>Ticket No <?php echo $idOrder; ?>
                <br>Código postal: 45060
                <br>Telefono: 3312 333924
                <br>Número de nota: <?php 
                    echo $numberNoteOne;
                ?>
                <br><span class="badge bg-primary">Estatus de pago: <?php echo $statusPayment; ?></span>
            </p>
            
            <?php 
                include "./config/conexion.php";
                
                if(isset($_GET['purchaseid'])) {
                     $idOrder = $_GET['purchaseid'];
                }
            ?>

            <table>
                <thead>
                    <tr>
                        <th class="quantity text-center fw-bold" style="font-size: 1.3rem!important;">Nombre</th>
                        <th class="quantity text-center fw-bold" style="font-size: 1.3rem!important;">Cant</th>
                        <th class="description text-center fw-bold" style="font-size: 1.3rem!important;">Producto</th>
                        <th class="price text-center fw-bold" style="font-size: 1.3rem!important;">Precio</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    include "./config/conexion.php";
                    $id_pedido = $_GET['purchaseid'];

                    $query_ticket = "SELECT * FROM new_orders_admin INNER JOIN purchase_detail_admin ON new_orders_admin.id = purchase_detail_admin.purchaseid INNER JOIN clients ON clients.id = new_orders_admin.client_id INNER JOIN products ON products.id = purchase_detail_admin.productid WHERE purchase_detail_admin.purchaseid = '$idOrder'";
                    $result = mysqli_query($conexion, $query_ticket);

                    while($row = mysqli_fetch_array($result)) {
                        $total = $row['amount'];
                                                        
                    ?>
                    <tr>
                        <td class="text-center fw-bold" style="font-size: 1.2rem!important;"><?php echo $row['name_client']; ?></td>

                        <td class="fw-bold" style="text-align: center !important; font-size: 1.2rem!important;">
                            <?php echo $row['quantity']; ?>
                        </td>

                        <td class="text-center fw-bold" style="font-size: 1.2rem!important;">
                            <?php echo $row['name_product']; ?>
                        </td>

                        <td class="fw-bold" style="font-size: 1.2rem!important;"><?php echo number_format($row['price'], 2); ?></td>

                    <?php }?>
                </tbody>
            </table>
            <hr class="style5">
            <div class="content">
                <p class="d-flex justify-content-end text-dark fw-bold">
                    Total Neto: $ <?php echo number_format($total, 2); ?>
                    <hr class="style5">
                </p>
            </div>
            <p class="centered text-dark fw-bold" style="font-size: 1.2rem!important;">¡GRACIAS POR SU COMPRA!</p>

        </div>
        <div>
            
        </div class="hidden-print">
            <button onclick="printTicket()" class="hidden-print btn-print">Imprimir ticket</button><br><br>
            <a href="new-orders-admin.php" class="hidden-print btn-print-2">Nuevo pedido</a><br><br><br>
            <a href="show-new-orders-admin.php" class="hidden-print btn-print-3">Regresar atrás</a><br><br><br>
        </div>
        <script>
            function printTicket() {
                window.print();
            }
        </script>
    </body>
</html>