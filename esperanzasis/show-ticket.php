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
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <title>EsperanzaSis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/ticket.css">
</head>
<body>

    <div class="container p-5">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-lg-5 col-xl-5 col-xxl-5 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="ticket" id="printable">
                            <div class="d-flex justify-content-center">
                                <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Imagen la esperanza" class="img-fluid" style="width: 100px;">
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <p>Chevere Trotillería</p>
                                <p>Av. Cruz del Sur 3874A Loma Bonita Ejidal</p>
                                <p>3315 422122/3319 819626</p>
                            </div>
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>$Precio Unitario</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        include "./config/conexion.php";
                                        $id_pedido = $_GET['purchaseid'];

                                        $query_ticket = "SELECT * FROM orders INNER JOIN purchase_detail ON orders.purchaseid = purchase_detail.purchaseid INNER JOIN products ON purchase_detail.productid = products.productid AND purchase_detail.purchaseid = '$id_pedido'";
                                        $result = mysqli_query($conexion, $query_ticket);

                                        while($rowTicket = mysqli_fetch_array($result)) {
                                    
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $rowTicket['quantity']; ?>
                                        </td>

                                        <td>
                                            <?php echo $rowTicket['name_product']; ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($rowTicket['price'], 2); ?>
                                        </td>

                                        <td>
                                            <?php
                                                $subt = $rowTicket['price']*$rowTicket['quantity'];
                                                echo number_format($subt, 2);
                                            ?>
                                        </td>

                                        <!-- <td>
                                            <?php echo number_format($total, 2); ?>
                                        </td> -->
                                    </tr>

                                    

                                    <?php }?>
                                    
                                </tbody>
                            </table>

                            <h3 class="text-dark mt-4">
                                TOTAL:
                                <?php echo number_format($total, 2); ?>
                            </h3>
                            
                            <?php if($ty) ?>
                            <button class="btn btn-outline-success print mt-4">
                                Imprimir Ticker
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="assets/js/jQuery.print.js"></script>
    <script src="assets/js/print-ticket.js"></script>
</body>
</html>