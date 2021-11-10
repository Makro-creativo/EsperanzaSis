<?php 
    error_reporting(0);
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
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Lista de clientes</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <td>Id</td>
                                                    <td>Nombre completo del cliente</td>
                                                    <td>Dirección del cliente</td>
                                                    <td>Dirección de la empresa</td>
                                                    <td>Giro de la empresa</td>
                                                    <td>RFC</td>
                                                    <td>Encargado de compras</td>
                                                    <td>Estatus</td>
                                                    <td>Número de teléfono</td>
                                                    <td>Celular</td>
                                                    <td>Correo electronico</td>
                                                    <td>Código postal</td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>Editar</td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>Eliminar</td>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php  
                                                include "./config/conexion.php";

                                                $query = "SELECT * FROM clients ORDER BY id ASC";
                                                $result = mysqli_query($conexion, $query);

                                                while($row = mysqli_fetch_array($result)) {
                                            ?>
                                            
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name_client']; ?></td>
                                                <td><?php echo $row['address_fiscal']; ?></td>
                                                <td><?php echo $row['address_company']; ?></td>
                                                <td><?php echo $row['giro_company']; ?></td>
                                                <td><?php echo $row['rfc']; ?></td>
                                                <td><?php echo $row['manager_payments']; ?></td>
                                                <td><?php echo $row['activate']; ?></td>
                                                <td><?php echo $row['tel']; ?></td>
                                                <td><?php echo $row['cel']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['cp']; ?></td>


                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a href="edit-client.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                                            
                                                            <i class="fas fa-edit mr-2"></i>
                                                        </a>
                                                    </td>
                                                <?php }?>

                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a href="delete-client.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt mr-2 "></i>
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
		const table = $('#dataTable').DataTable({
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
			
		});
	</script>
</body>
</html>