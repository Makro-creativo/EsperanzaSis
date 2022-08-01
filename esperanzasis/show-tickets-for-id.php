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
                font-family: 'Times New Roman';
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
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
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
                    

                    $query_orders = "SELECT * FROM ordens_admin WHERE purchaseid = '$idOrder'";
                    $result_orders = mysqli_query($conexion, $query_orders);

                    if($result_orders) {
                        $rowTwo = mysqli_fetch_array($result_orders);

                        $createdAt = $rowTwo['date_send'];
                        $numberNoteOne = $rowTwo['note_cobranza_credito'];
                        $numberNoteTwo = $rowTwo['note_cobranza_credito_two'];
                    }
                } 
            ?>
            <p class="centered fw-bold">Tortillería la Esperanza
                <br>Av. Paseo de la Primavera número #2195
                <br>Colonia Arenales Tapatios Zapopan Jalisco
                <br>Fecha: <?php echo date("m/d/Y", strtotime($createdAt)); ?>
                <br>Ticket No <?php echo $idOrder; ?>
                <br>Código postal: 45060
                <br>Telefono: 3312 333924
                <br>Número de nota: <?php 
                    if(!$numberNoteOne) {
                        echo $numberNoteTwo;
                    } else {
                        echo $numberNoteOne;
                    }
                ?>
            </p>

            <table>
                <thead>
                    <tr>
                        <th class="quantity text-center">Cliente</th>
                        <th class="quantity text-center">Cant</th>
                        <th class="description text-center">Producto</th>
                        <th class="price text-center">Precio</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    include "./config/conexion.php";
                    $idOrder = $_GET['purchaseid'];

                    $search_order_ticket = "SELECT * FROM ordens_admin INNER JOIN details_ordens_admin ON ordens_admin.purchaseid = details_ordens_admin.purchaseid WHERE ordens_admin.purchaseid = '$idOrder'";
                    $result_order_ticket = mysqli_query($conexion, $search_order_ticket);

                    while($row = mysqli_fetch_array($result_order_ticket)) {
                        $total = $row['monto'];
                                                        
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $row['name_client']; ?></td>

                        <td style="text-align: center !important;">
                            <?php echo $row['quantity']; ?>
                        </td>

                        <td class="text-center">
                            <?php echo $row['name_product']; ?>
                        </td>

                        <td><?php echo number_format($row['price'], 2); ?></td>

                    <?php }?>
                </tbody>
            </table>
            <hr class="style5">
            <div class="content">
                <p class="d-flex justify-content-end text-dark fw-bold mt-3">
                    Total Neto: $ <?php echo number_format($total, 2); ?>
                    <hr class="style5">
                </p>
            </div>
            <p class="centered text-dark fw-bold">¡GRACIAS POR SU COMPRA!</p>

            <div>
                <p class="text-center text-dark fw-bold">Escanea nuestro QR</p>
                <img src="./assets/img/qr-code.png" alt="QR" class="img-fluid">
            </div>
        </div>
        <button onclick="printTicket()" class="hidden-print btn-print">Imprimir ticket</button>
        <script>
            function printTicket() {
                window.print();
            }
        </script>
    </body>
</html>