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
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                <h2 class="d-flex justify-content-center mb-4">Total de corte Repartidores</h2>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-sm table-striped" id="table-render">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="2%" class="center">Fecha</th>
                                                    <th scope="col" width="20%">Persona que entrego</th>
                                                    <th scope="col" class="d-none d-sm-table-cell" width="50%">Persona que recibio</th>

                                                    <th scope="col" width="10%" class="text-left">Tipo de ruta</th>
                                                    <th scope="col" width="8%" class="text-right">Concepto</th>
                                                    <th scope="col" width="10%" class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php 
                                                        include "./config/conexion.php";
                                                        
                                                        $query_total_morning = mysqli_query($conexion, "SELECT * FROM cutbox_ruta ORDER BY opening_date ASC");
                                                        
                                                        $total = 0;
                                                        $total_rute = 0;


                                                        while($row = mysqli_fetch_array($query_total_morning)) {
                                                            $closing_amount = $row['amount'];   
                                                            $total_services = $row['payment_services_two'];
                                                            $gastosSuper = $row['gastos_super'];

                                                            $total_super = $closing_amount + $total_services + $gastosSuper;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date("d/m/Y", strtotime($row['opening_date'])); ?></td>
                                                        <td><?php echo $row['person_delivery']; ?></td>
                                                        <td>
                                                            <?php echo $row['person_receive']; ?>
                                                        </td>

                                                        <td class="text-left"><?php echo $row['turn']; ?></td>
                                                        <td class="text-center"><?php echo $row['concept']; ?></td>
                                                        <td class="text-right">
                                                            $<?php 
                                                                $total_cut = $total_rute_two + $total_super;

                                                                echo number_format($total_cut, 2);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                        
                                                <?php 
                                                    $total+=$total_cut;
                                                }?>

                                                <div class="d-flex justify-content-end">
                                                    <tr>
                                                        <td>
                                                            Total del día: $<?php 
                                                                echo number_format($total, 2);
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