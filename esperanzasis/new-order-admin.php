<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Tipo'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <title>EsperanzaSis</title>

    <!-- Custom fonts for this template-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Crear nuevo pedido</h2>
                        
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <form action="create-order.php" method="POST">
                                        <input type="hidden" value="<?php echo $typeUser; ?>" name="id_user_active_order">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th class="text-center">Seleccionar productos<input type="hidden" id="checkAll"></th>
                                                    <th>Nombre del producto</th>
                                                    <th>Tipo de unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                        include "./config/conexion.php";

                                                        $query = "SELECT * FROM products WHERE price != '' AND unidad != ''";
                                                        $result = mysqli_query($conexion, $query);
                                                        
                                                        $iterate=0;

                                                        while($row = mysqli_fetch_array($result)){ 
                                                            $priceNormal =  number_format($row['price'], 2);
                                                        ?>
                                                            <tr>
                                                                <!--<td required class="text-center"><input type="checkbox" value="<?php //echo $row['productid']; ?>||<?php //echo $iterate; ?>" name="productid[]" style=""></td>-->
                                                                <td required class="text-center"><input type="checkbox" value="<?php echo $row['productid']."_".$row['price']; ?>" name="productid[]" style=""></td>
                                                                <td><?php echo $row['name_product']; ?></td>

                                                                <td><?php echo $row['unidad']; ?></td>

                                                                <td>
                                                                    <input placeholder="Agregar cantidad del producto: 0" type="text" class="form-control" autocomplete="off" name="quantity[]">
                                                                    <!--<input placeholder="Agregar cantidad del producto: 0" type="text" class="form-control" autocomplete="off" name="quantity">-->
                                                                </td>

                                                                <td>
                                                                    <?php echo number_format($row['price'], 2); ?>		
                                                                </td>
                                                                
                                                            </tr>
                                                            <?php
                                                            $iterate++;
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Nombre del cliente: </label>
                                                    <input name="name_order" type="text" placeholder="Ejemplo: Hotel Malibu, Guillermo, etc..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Dirección de envío: </label>
                                                    <input name="address_send" type="text" placeholder="Ejemplo: Avenida los arcos, etc..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Hora de entrega: </label>
                                                    <input type="time" name="hour_send" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Fecha de envío: </label>
                                                    <input type="date" name="date_send" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Persona quién ordeno pedido: </label>
                                                    <input name="people_order" type="text" placeholder="Ejemplo: Jorge Hernandez, etc..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Comentarios: </label>
                                                    <textarea name="comments" rows="1" placeholder="Ejemplo: Buen servicio, siempre a tiempo, etc..." class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Asignar pedido: </label>
                                                    <select name="name_delivery" require required class="form-select">
                                                        <option disabled selected>Seleccionar repartidor</option>
                                                        <?php 
                                                            include "./config/conexion.php";
                                                            
                                                            $sarch_user_delivery = "SELECT * FROM users WHERE Tipo = 'Repartidor'";
                                                            $result = mysqli_query($conexion, $sarch_user_delivery);

                                                            while($row = mysqli_fetch_array($result)) {
                                                                $nameDelivery = $row['name'];
                                                        ?>
                                                            <option value="<?php echo $nameDelivery; ?>"><?php echo $nameDelivery; ?></option>

                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Estatus de pago: </label>
                                                    <select name="status_payment" id="status_payment" onChange="showRoleId(this.value);" require required class="form-select">
                                                        <option disabled selected>Selecciona un opción</option>
                                                        <option value="credito">A credito</option>
                                                        <option value="contado">A contado</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12" id="credito" style="display: none;">
                                                <div class="form-group">
                                                    <label>Número de nota: </label>
                                                    <input type="text" name="note_cobranza_credito" placeholder="Ejemplo: 03456, etc..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12" id="contado" style="display: none;">
                                                <div class="form-group">
                                                    <label>Número de nota: </label>
                                                    <input type="text" name="note_cobranza_credito" placeholder="Ejemplo: 03456, etc..." class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                                        
                                        <input type="submit" value="Registrar pedido" class="btn btn-success btn-block mt-4" name="newOrder">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>

            <?php include "./partials/footer.php" ?>

        </div>

    </div>







    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Data tables -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
		});
	</script>

    <script>
        function showRoleId(id) {
            if(id === "credito") {
                $("#credito").show();
                $("#contado").hide();
            }

            if(id === "contado") {
                $("#credito").hide();
                $("#contado").show();
            }
        }
    </script>
</body>
</html>