<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EsperanzaSis</title>
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">

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
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex jusitify-content-start mb-4">Buscar entre fechas venta Tortillería</h2>    

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="row mt-2">
                                        <p class="text-primary text-center">Exportar a excel entre fechas</p>
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 cool-xxl-12">
                                                <form method="POST" class="form" action="report-export-sales-tortilleria.php">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="date" name="date1" class="form-control">
                                                            </div>
                                                        </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="date" name="date2" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                                
                                                        <div class="d-grid gap-2">
                                                        <input type="submit" name="generate-report" value="Descargar" class="btn btn-success">
                                                    </div>
                                                </form>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="container">
                    <div class="row">
                        <h2 class="d-flex jusitify-content-start mb-4">Buscar entre fechas cobranza Tortillería</h2>    

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="row mt-2">
                                        <p class="text-primary text-center">Exportar a excel entre fechas</p>
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 cool-xxl-12">
                                                <form method="POST" class="form" action="report-export-cobranza-tortilleria.php">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="date" name="date1" class="form-control">
                                                            </div>
                                                        </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="date" name="date2" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                                
                                                        <div class="d-grid gap-2">
                                                        <input type="submit" name="generate-report" value="Descargar" class="btn btn-success">
                                                    </div>
                                                </form>
                                            <br>
                                        </div>
                                    </div>
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
</body>
</html>