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

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container p-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-primary">Capturar nueva factura</h6>

                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#rol">
                                        Capturar nueva factura
                                        <i class="fa-solid fa-credit-card mr-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>

            <!-- Modal -->
            <div class="modal fade" id="rol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo proveedor o factura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <label>Selecciona una opción: </label>
                                <select name="status" id="status" onChange="showForm(this.value);" class="form-select">
                                    <option selected disabled>Elige una opción</option>
                                    <option value="rol-provider">Nueva factura a proveedor</option>
                                    <option value="rol-bills">Nueva factura a cliente</option>
                                </select>
                            </form>

                            <div id="rol-provider" style="display: none;" class="p-3">
                            <form action="new-bills-to-pay.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Elejir cliente: </label>
                                                    <select name="info_client_id" require required class="form-select">
                                                        <option selected disabled>Seleccionar cliente</option>
                                                        <?php 
                                                            include "./config/conexion.php";
                                                            
                                                            $search_client = "SELECT * FROM providers ORDER BY name_provider ASC";
                                                            $result_search_client = mysqli_query($conexion, $search_client);

                                                            while($row = mysqli_fetch_array($result_search_client)) {
                                                                $idClient = $row['id_provider'];
                                                                $nameClient = $row['name_provider'];
                                                        ?>
                                                            <option value="<?php echo $idClient."_".$nameClient; ?>"><?php echo $nameClient; ?></option>

                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Monto: </label>
                                                    <input type="text" placeholder="Ejemplo: 1250, 1500, etc..." name="amount" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Iva: </label>
                                                    <input type="text" placeholder="Ejemplo: 280, 130, etc..." name="iva" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Concepto: </label>
                                                    <input type="text" placeholder="Ejemplo: Se debe pago de 50 kilos de maíz, etc..." class="form-control" name="concept">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha de factura: </label>
                                                    <input type="date" name="date_saved" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha de pago de factura: </label>
                                                    <input type="date" name="date_to_pay" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Guardar factura" class="btn btn-success btn-block" name="save">
                                    </form>
                            </div>

                            <div id="rol-bills" style="display: none;">
                                
                            <form action="new-invoice.php" method="POST" class="p-3">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Eligir cliente: </label>
                                                    <select name="info_client_id" require class="form-select">
                                                        <option selected disabled>Seleccionar cliente</option>
                                                        <?php 
                                                            include "./config/conexion.php";

                                                            $query_customer = "SELECT * FROM clients ORDER BY name_client ASC";
                                                            $result_customers = mysqli_query($conexion, $query_customer);

                                                            while($row = mysqli_fetch_array($result_customers)) {
                                                                $id_user = $row['id_user'];
                                                                $name_customer = $row['name_client'];
                                                        ?>
                                                        
                                                            <option value="<?php echo $id_user."_".$name_customer; ?>"><?php echo $name_customer; ?></option>

                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Monto: </label>
                                                    <input type="text" name="amount" class="form-control" placeholder="Ejemplo: 1500">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Iva: </label>
                                                    <input type="text" name="iva" class="form-control" placeholder="Ejemplo: 380,">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Concepto: </label>
                                                    <input type="text" name="concept" class="form-control" placeholder="Ejemplo: Describir servicio, producto, etc...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Fecha de la factura: </label>
                                                    <input type="date" name="date_saved" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Fecha de pago de factura: </label>
                                                    <input type="date" name="date_to_pay_bills" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Eligir opción: </label>
                                                    <select name="invoice_notes" require required class="form-select">
                                                        <option disabled selected>Selecciona una opción</option>
                                                        <option value="Nota">Nota</option>
                                                        <option value="Factura">Factura</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Número de nota o factura: </label>
                                                    <input type="text" name="number_notes" class="form-control" placeholder="Ejemplo: 456789, etc...">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Registrar factura" class="btn btn-success btn-block" name="saveBills">
                                    </form>
                            </div>

                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

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

    <script>
        function showForm(id) {
            if(id === "rol-provider") {
                $("#rol-provider").show();
                $("#rol-bills").hide();
            }

            if(id === "rol-bills") {
                $("#rol-provider").hide();
                $("#rol-bills").show();
            }
        }
    </script>
</body>
</html>