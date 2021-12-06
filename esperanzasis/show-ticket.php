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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/ticket.css">
</head>
<body>

    <div class="container p-5">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="ticket" id="printable">
                            <div class="d-flex justify-content-center">
                                <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Imagen la esperanza" class="img-fluid" style="width: 100px;">
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <p>Tortillería la Esperanza</p>
                                <p>Av. Cruz del Sur 3874A Loma Bonita Ejidal</p>
                                <p>3315 422122/3319 819626</p>
                            </div>
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>$Precio Unitario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        include "./config/conexion.php";
                                        $id_pedido = $_GET['purchaseid'];

                                        $query_ticket = "SELECT * FROM orders INNER JOIN purchase_detail ON orders.purchaseid = purchase_detail.purchaseid INNER JOIN products ON purchase_detail.productid = products.productid AND purchase_detail.purchaseid = '$id_pedido'";
                                        $result = mysqli_query($conexion, $query_ticket);

                                        while($row = mysqli_fetch_array($result)) {
                                            $idProduct = $row['productid']; //30
                                            $priceNormal =  number_format($row['price'], 2);

                                            //Buscar si es que existe un descuento
                                            $searchData = "SELECT * FROM promotions WHERE productid='$idProduct' AND id_user = '$uid'";
                                            $result_price = mysqli_query($conexion, $searchData);
                                                        
                                            $rowProductDiscount = mysqli_fetch_array($result_price);
                                            $discountProduct = $rowProductDiscount['discount'];
                                    
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $row['quantity']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['name_product']; ?>
                                        </td>

                                        <td class="d-flex justify-content-center">
                                           <?php 
                                            if($productDiscount) {
                                                echo $productDiscount;
                                            } else {
                                                echo $priceNormal;
                                            }
                                           
                                           ?>
                                        </td>
                                    </tr>

                                    

                                    <?php }?>
                                    
                                </tbody>
                            </table>
                            
                            <div class="d-flex justify-content-end">
                                <h3 class="text-dark mt-4">
                                    TOTAL:
                                    <?php echo number_format($total, 2); ?>
                                </h3>
                            </div>
                            
                            
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-success print mt-4" id="hide-button">
                                    Imprimir Ticker
                                </button>
                            </div>
                
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

    <script>
        $(function() {
            $('#hide-button').click(function() {
                $('button').hide();
            })
        });
    </script>
</body>
</html>