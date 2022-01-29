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
                    <div class="row">
                    <div class="d-flex justify-content-around align-items-center" data-bs-toggle="modal" data-bs-target="#rol">
                        <h2>Facturas proveedores</h2>

                        <button class="btn btn-success btn-sm d-flex align-items-center">
                            <i class="fas fa-file-signature mr-2"></i>
                            Registrar nueva factura o proveedor
                        </button>
                       </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <th>Nombre del cliente</th>
                                                <th>Monto</th>
                                                <th>Iva</th>
                                                <th>Concepto</th>
                                                <th>Fecha de factura</th>
                                                <th>Fecha de pago de factura</th>
                                                <th>Total</th>

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

                                                    $search_bills_to_pay = "SELECT * FROM bills_to_pay";
                                                    $result_search_bills = mysqli_query($conexion, $search_bills_to_pay);

                                                    while($row = mysqli_fetch_array($result_search_bills)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name_customer']; ?></td>
                                                    <td><?php echo number_format($row['amount'], 2); ?></td>
                                                    <td><?php echo number_format($row['iva'], 2); ?></td>
                                                    <td><?php echo $row['concept']; ?></td>
                                                    <td><?php echo date("d/m/Y", strtotime($row['date_saved'])); ?></td>
                                                    <td><?php echo date("d/m/Y", strtotime($row['date_to_pay'])); ?></td>

                                                    <td>
                                                        <?php 
                                                            $result_calculation = ($row['amount']) + ($row['iva']);

                                                            echo number_format($result_calculation, 2);
                                                        ?>
                                                    </td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="edit-bills-to-pay.php?id_provider=<?php echo $row['id_provider']; ?>" class="btn btn-success">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="delete-bills-to-pay.php?id_provider=<?php echo $row['id_provider']; ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador")  {?>
                                                        <td>
                                                            <a href="bills-to-pay.php?id_provider=<?php echo $row['id_provider']; ?>" class="btn btn-primary">
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
                                    <option value="rol-provider">Nuevo proveedor</option>
                                    <option value="rol-bills">Nueva factura</option>
                                </select>
                            </form>

                            <div id="rol-provider" style="display: none;" class="p-3">
                                <form action="new-provider.php" method="POST">
                                        <div class="row">
                                        <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>DNI: </label>
                                                    <input type="text" placeholder="Ejemplo: 101, 102, 103, etc..." name="dni_provider" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Nombre del proveedor: </label>
                                                    <input type="text" placeholder="Ejemplo: Leche lala, coca cola, etc..." name="name_provider" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Dirección de la empresa: </label>
                                                    <input type="text" placeholder="Ejemplo: Gardines del bosque, etc..." name="adress" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Teléfono de contacto: </label>
                                                    <input type="tel" name="contact" placeholder="Ejemplo: 333 134 4567" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de celular: </label>
                                                    <input type="tel" name="number_cel" class="form-control" placeholder="Ejemplo: 33 135 4678">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha de registro: </label>
                                                    <input type="date" name="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>RFC: </label>
                                                    <input type="text" placeholder="Ejemplo: MELM8305281H0" class="form-control" name="rfc_provider">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Giro de la empresa: </label>
                                                    <input type="text" placeholder="Mueblería, Ferretería, etc..." class="form-control" name="giro_provider">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Estatus del proveedor: </label>
                                                    <select name="status_provider" require required class="form-select">
                                                        <option selected disabled>Elije un opción</option>
                                                        <option value="Activo">Activo</option>
                                                        <option value="Inactivo">Inactivo</option>
                                                        <option value="Suspendido">Suspendido</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Código postal: </label>
                                                    <input type="text" placeholder="Ejemplo: 47910, etc..." class="form-control" name="code_postal">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Municipio: </label>
                                                    <input type="text" placeholder="Ejemplo: San pedro tlaquepaque, etc..." class="form-control" name="municipio_provider">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Correo electronico: </label>
                                                    <input type="email" name="email_provider" class="form-control" placeholder="Ejemplo: mail@gmail.com">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Guardar proveedor" class="btn btn-success btn-block" name="save">
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

    <!-- Scripts for buttons for export to excel -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

	<script>
		$('#dataTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'EXCEL',
                    className: 'btn btn-success'
                }
            ],
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