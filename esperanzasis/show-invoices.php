<?php 
    session_start();

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

                <div class="d-flex justify-content-around align-items-center">
                    <h2>Facturas capturadas</h2>

                    <button type="button" class="btn btn-sm btn-success" onclick="exportTableToExcel('render')">
                        <i class="fas fa-file-excel mr-2"></i>
                        Exportar a excel
                    </button>
                </div>

                <div class="container">
                    
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="render" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Nombre del cliente</th>
                                            <th>Monto</th>
                                            <th>Iva</th>
                                            <th>Concepto</th>
                                            <th>Fecha</th>
                                            <th>Total de Factura</th>

                                            <?php if($typeUser === "Administrador") {?>
                                                <th>Editar</th>
                                            <?php }?>

                                            <?php if($typeUser === "Administrador") {?>
                                                <th>Eliminar</th>
                                            <?php }?>

                                            <?php if($typeUser === "Administrador") {?>
                                                <th>Ver factura</th>
                                            <?php }?>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                include "./config/conexion.php";

                                                //$query = "SELECT * FROM bills ORDER BY id_customer DESC";
                                                $query = "SELECT * FROM bills";
                                                $result = mysqli_query($conexion, $query);
                                                    
                                                while($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['customer_name']; ?></td>
                                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                                <td><?php echo number_format($row['iva'], 2); ?></td>
                                                <td><?php echo $row['concept']; ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($row['date_saved'])); ?></td>
                                                
                                                <td>
                                                    <?php 
                                                        $result_calculation = ($row['amount']) + ($row['iva']);

                                                        echo number_format($result_calculation, 2);
                                                    ?>
                                                </td>


                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a class="btn btn-success" href="edit-invoice.php?id_user=<?php echo $row['id_user']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                <?php }?>

                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a class="btn btn-danger" href="delete-invoice.php?id_user=<?php echo $row['id_user']; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                <?php }?>

                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a class="btn btn-primary" href="show-bills-id.php?id_user=<?php echo $row['id_user']; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                <?php }?>
                                            </tr>

                                            <?php }?>
                                        </tbody>
                                    </table>
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

	<script>
		$('#render').DataTable({
            "language": {
                "sProcessing":    "Procesando...",
                "sLengthMenu":    "Mostrar _MENU_ registros",
                "sZeroRecords":   "No se encontraron resultados",
                "sEmptyTable":    "Ningún dato disponible en esta tabla",
                "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":   "",
                "sSearch":        "Buscar:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                
            }

        });
	</script>

<script>
    function exportTableToExcel(tableID, filename = ''){
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      filename = filename?filename+'.xls':'facturas.xls';
      downloadLink = document.createElement("a");
      document.body.appendChild(downloadLink);
      if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
      }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
      }
    }


  </script>
</body>
</html>