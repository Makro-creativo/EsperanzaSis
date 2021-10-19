<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EsperazaSis</title>

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
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Menu lateral -->
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Navigation -->
                <?php include "./partials/header.php" ?>

                <!-- Content main -->
                <div class="d-flex justify-content-around align-items-center my-5">
                    <h2 class="text-dark">Nuevo pedido</h2>

                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-order">
                        Registrar pedido
                        <i class="fas fa-plus-square mr-2"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Selecciona tu producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="new-order.php" method="POST">
                                    <select class="form-select" name="status" id="status" onChange="show(this.value);">
                                        <option selected disabled>---- Selecciona un Producto ---</option>
                                        <option value="totopos">Totopos especial para Chilaquiles</option>
                                        <option value="tortilla">Tortilla de Maíz</option>
                                    </select>
                                </form>

                                <div id="totopos" style="display: none;" class="mt-4">
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <label>Nombre del Producto: </label>
                                            <input type="text" placeholder="Nombre del producto" class="form-control">
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <div class="container">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xx-12 mx-auto">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre del producto</th>
                                                    <th>Nombre del cliente</th>
                                                    <th>Dirección de envió</th>
                                                    <th>Cantidad en exitencia</th>
                                                    <th>Kilogramos</th>
                                                    <th>Fecha de envió</th>
                                                    <th>Hora de envió</th>
                                                    <th>Nombre de quien hace el pedido</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Footer -->
            <?php include "./partials/footer.php" ?>
        </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>

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
        function show(id) {
            if(id === "totopos") {
                $("#totopos").show();

            }
        }
    </script>
</body>
</html>