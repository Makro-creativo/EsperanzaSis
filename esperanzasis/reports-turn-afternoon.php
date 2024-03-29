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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

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
                        <h2 class="d-flex justify-content-start mb-4">Corte del súper de la tarde</h2>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12-col-xl-12 xol-xx-12">
                                    <div class="card shadow-lg">
                                    <h6 class="text-center text-primary p-3">Buscar entre fechas</h6>

                                        <div class="card-body">
                                            <form action="" method="GET">
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>De que fecha: </label>
                                                            <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Hasta que fecha: </label>
                                                            <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-success btn-block">Filtrar</button>
                                            </form>
                                        </div>
                                        
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 colxx-l-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="data" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Persona que entrego</th>
                                                                    <th>Persona que recibio</th>
                                                                    <th>Turno</th>
                                                                    <th>Concepto</th>
                                                                    <th>Efectivo</th>
                                                                    <th>Bauchers</th>
                                                                    <th>Gastos de Súper</th>
                                                                    <th>Gastos de Trotillería</th>
                                                                    <th>Recargas</th>
                                                                    <th>Ticket</th>
                                                                    <th>Total del corte</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <?php 
                                                                include "./config/conexion.php";

                                                                if(isset($_GET['from_date']) && isset($_GET['to_date']))
                                                                {
                                                                    $from_date = $_GET['from_date'];
                                                                    $to_date = $_GET['to_date'];

                                                                    $query = "SELECT * FROM cutbox_super WHERE opening_date BETWEEN '$from_date' AND '$to_date' AND turn = 'tarde' ORDER BY opening_date DESC";
                                                                    $query_run = mysqli_query($conexion, $query);

                                                                    $total_row = 0;

                                                                    if(mysqli_num_rows($query_run) > 0)
                                                                    {
                                                                        foreach($query_run as $row)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= date("d/m/Y", strtotime($row['opening_date'])); ?></td>
                                                                                <td><?= $row['person_delivery']; ?></td>
                                                                                <td><?= $row['person_receive']; ?></td>
                                                                                <td><?= $row['turn']; ?></td>
                                                                                <td><?= $row['concept']; ?></td>
                                                                                <td><?= number_format($row['closing_amount'], 2); ?></td>
                                                                                <td><?= number_format($row['payment_services'], 2); ?></td>
                                                                                <td><?= number_format($row['gastos_super'], 2); ?></td>
                                                                                <td><?= number_format($row['gastos_tortilleria'], 2); ?></td>
                                                                                <td><?= number_format($row['recargas'], 2); ?></td>
                                                                                <td><?= number_format($row['number_notes'], 2); ?></td>
                                                                                <td>
                                                                                    <?php 
                                                                                        $closingAmount = $row['closing_amount'];
                                                                                        $paymentServices = $row['payment_services'];
                                                                                        $gastosSuper = $row['gastos_super'];
                                                                                        $gastosTrotilleria = $row['gastos_tortilleria'];

                                                                                        $total = $closingAmount + $paymentServices + $gastosSuper + $gastosTrotilleria;
                                                                                        echo number_format($total, 2);
                                                                                    ?>
                                                                                </td>
                                                                            </tr>

                                                                            
                                                                            <?php
                                                                            $total_neto = $total_row+=$total;
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "<p class='text-center'>No se encontraron resultados...</p>";
                                                                    }
                                                                }
                                                            ?>
                                                                <div class="d-flex justify-content-end">
                                                                    <tr>
                                                                        <td>
                                                                            Total: $<?php 
                                                                                echo number_format($total_neto, 2);
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                </div>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
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

    <!-- Scripts for buttons for export to excel -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
</body>
</html>