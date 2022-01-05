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
                        <h2 class="d-flex justify-content-start mb-4">Roles de usuario</h2>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <td>Nombre de usuario</td>
                                                <td>nombre de Rol de usuario</td>
                                                <td>Contraseña</td>
                                                <td>Tipo de usuario</td>
                        
                    
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

                                                $query = "SELECT * FROM users WHERE Tipo != 'SuperAdmin'";
                                                $result = mysqli_query($conexion, $query);

                                                while($row = mysqli_fetch_array($result)) {
                                            ?>
                                            
                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['user']; ?></td>
                                                <td><?php echo $row['pass']; ?></td>
                                                <td><?php echo $row['tipo']; ?></td>


                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a href="edit-rol.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-success">
                                                            Editar
                                                            <i class="fas fa-edit mr-2"></i>
                                                        </a>
                                                    </td>
                                                <?php }?>

                                                <?php if($typeUser === "Administrador") {?>
                                                    <td>
                                                        <a href="delete-rol.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-danger">
                                                            Eliminar
                                                            <i class="fas fa-trash-alt mr-2"></i>
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


                <!-- Modal -->
                <div class="modal fade" id="rol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo rol</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <label>Selecciona una opción: </label>
                                <select name="status" id="status" onChange="showForm(this.value);" class="form-select">
                                    <option selected disabled>Elije una opción</option>
                                    <option value="rol-client">Rol de cliente</option>
                                    <option value="rol-repartidor">Rol de repartidor</option>
                                </select>
                            </form>

                            <div id="rol-client" style="display: none;">
                                    <form action="new-rol.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                                <div class="form-group">
                                                    <label>Elije un usuario: </label>
                                                    <select name="info_client" require class="form-select">
                                                        <option selected disabled>Elije un usuario</option>
                                                        <?php 
                                                            include "./config/conexion.php"; 

                                                            $query = "SELECT * FROM clients";
                                                            $result = mysqli_query($conexion, $query);

                                                            while($row = mysqli_fetch_array($result)) {
                                                                $id_client = $row['id_user'];
                                                                $name_client = $row['name_client'];
                                                        
                                                            ?>

                                                            <option value="<?php echo $id_client."_".$name_client; ?>"><?php echo $name_client; ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                                <div class="form-group">
                                                    <label>Nombre de usuario: </label>
                                                    <input type="text" placeholder="Ejemplo: HotelHg, HotelMali, etc..." name="user" autocomplete="off" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <label>Contraseña para el usuario: </label>
                                                <input type="password" placeholder="Ejemplo: cliente1234, cliente*2021, etc..." name="pass" class="form-control">
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Asignar tipo de permiso para nuevo usuario</label>
                                                    <select name="tipo" require class="form-select">
                                                        <option selected disabled>Eliga un Rol para el usuario</option>
                                                        <option value="Cliente">Cliente</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Crear nuevo rol" class="btn btn-outline-success" name="saveRol">
                                        </div>
                                </form>

                            </div>

                            <div id="rol-repartidor" style="display: none;">
                                
                            <form action="new-rol-repartidor.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                                <div class="form-group">
                                                    <label>Elije un usuario: </label>
                                                    <input type="text" name="name" class="form-control" placeholder="Ejemplo: Jose, Miguel, etc.." autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                                <div class="form-group">
                                                    <label>Nombre de usuario: </label>
                                                    <input type="text" placeholder="Ejemplo: HotelHg, HotelMali, etc..." name="user" autocomplete="off" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <label>Contraseña para el usuario: </label>
                                                <input type="password" placeholder="Ejemplo: cliente1234, cliente*2021, etc..." name="pass" class="form-control">
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Asignar tipo de permiso para nuevo usuario</label>
                                                    <select name="tipo" require class="form-select">
                                                        <option selected disabled>Eliga un Rol para el usuario</option>
                                                        <option value="Repartidor">Repartidor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Crear nuevo rol" class="btn btn-outline-success" name="saveRepartidor">
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
                <!-- End Modal -->

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

    <script>
		const table = $('#dataTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'EXCEL',
                    className: 'btn btn-success'
                }
            ],
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

    <script>
        function showForm(id) {
            if(id === "rol-client") {
                $("#rol-client").show();
                $("#rol-repartidor").hide();
            }

            if(id === "rol-repartidor") {
                $("#rol-client").hide();
                $("#rol-repartidor").show();
            }
        }
    </script>
</body>
</html>