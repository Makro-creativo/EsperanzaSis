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

                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Lista de Ingresos</h2>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <label>Filtrar por descripción</label>
                                                        <select name="description" class="form-control">
                                                            <option selected disabled>Seleccionar descripción</option>
                                                            <?php
                                                            include "./config/conexion.php";

                                                            $search_filter_for_description = "SELECT DISTINCT description FROM ingresos ORDER BY description DESC";
                                                            $result_filter_description = mysqli_query($conexion, $search_filter_for_description);

                                                            while ($rowDescription = mysqli_fetch_array($result_filter_description)) {

                                                            ?>
                                                                <option value="<?php echo $rowDescription['description']; ?>"><?php echo $rowDescription['description']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        Filtrar
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <label>Filtrar por categoría</label>
                                                        <select name="category_name" class="form-control">
                                                            <option selected disabled>Seleccionar categoría</option>
                                                            <?php
                                                            include "./config/conexion.php";

                                                            $search_filter_for_category = "SELECT DISTINCT category_name FROM ingresos ORDER BY category_name DESC";
                                                            $result_filter_for_category = mysqli_query($conexion, $search_filter_for_category);

                                                            while ($rowCategory = mysqli_fetch_array($result_filter_for_category)) {

                                                            ?>
                                                                <option value="<?php echo $rowCategory['category_name']; ?>"><?php echo $rowCategory['category_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        Filtrar
                                                    </button>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="render" width="100%" cellspacing="0">
                                            <thead>
                                                <th>Fecha</th>
                                                <th>Descripción</th>
                                                <th>Efectivo</th>
                                                <th>Categoría</th>

                                                <?php if($typeUser === "Administrador") {?>
                                                    <th>Editar</th>
                                                <?php }?>

                                                <?php if($typeUser === "Administrador") {?>
                                                    <th>Eliminar</th>
                                                <?php }?>
                                            </thead>

                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    if(isset($_POST['description'])) {
                                                        $description = $_POST['description'];

                                                        $query_incomes = "SELECT * FROM ingresos WHERE description='$description' ORDER BY description DESC";
                                                    } else if(isset($_POST['category_name'])) {
                                                        $category = $_POST['category_name'];

                                                        $query_incomes = "SELECT * FROM ingresos WHERE category_name='$category' ORDER BY category_name DESC";
                                                    } else  {
                                                        $query_incomes = "SELECT * FROM ingresos ORDER BY created_at ASC";
                                                    }

                                                    $result_incomes = mysqli_query($conexion, $query_incomes);

                                                    while($row = mysqli_fetch_array($result_incomes)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php echo number_format($row['quantity'], 2); ?></td>
                                                    <td><?php echo $row['category_name']; ?></td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="edit-incomes.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="delete-incomes.php?id=<?php echo $row['id']; ?></php>" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
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

    <!-- Scripts for buttons for export to excel -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

	<script>
		$('#render').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'EXCEL',
                    className: 'btn btn-success'
                }
            ],
            "order": [[ 3, "desc" ]],
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
                }
            }
        });
	</script>
</body>
</html>