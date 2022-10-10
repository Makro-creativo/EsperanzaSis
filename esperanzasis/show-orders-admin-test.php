<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Tipo'];

?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body id="page-top">
    <div id="wrapper">

    <?php   
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se guardo correctamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-orders-admin-test.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLateral.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Lista de pedidos</h2>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="card shadow-lg">
                                        <h6 class="text-center text-primary p-3">Buscar entre fechas</h6>

                                        <div class="card-body">
                                            <form action="" method="GET">
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>De que fecha: </label>
                                                            <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Hasta que fecha: </label>
                                                            <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Cliente: </label>
                                                            <select name="name_client" class="form-control">
                                                                <option selected disabled>Seleccionar cliente</option>
                                                                <?php 
                                                                    include "./config/conexion.php";

                                                                    $search_name_client = "SELECT * FROM ordens_admin ORDER BY name_client ASC";
                                                                    $result_name_client = mysqli_query($conexion, $search_name_client);

                                                                    while($rowClient = mysqli_fetch_array($result_name_client)) {
                                                                        $nameClient = $rowClient['name_client'];
                                                                ?>
                                                                    <option value="<?php echo $nameClient; ?>"><?php echo $nameClient; ?></option>
                                                                <?php }?>
                                                            </select>
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
                                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Cliente</th>
                                                                    <th>Dirección de entrega</th>
                                                                    <th>Fecha de entrega</th>
                                                                    <th>Hora de entrega</th>
                                                                    <th>Persona quién realizo el pedido</th>
                                                                    <th>Comentarios</th>
                                                                    <th>Estatus de pago</th>
                                                                    <th>Número de nota</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <?php 
                                                                include "./config/conexion.php";

                                                                if(isset($_GET['from_date']) && isset($_GET['to_date']))
                                                                {
                                                                    $from_date = $_GET['from_date'];
                                                                    $to_date = $_GET['to_date'];
                                                                    $nameClient = $_GET['name_client'];

                                                                    $query = "SELECT * FROM ordens_admin WHERE date_send BETWEEN '$from_date' AND '$to_date' AND name_client = '$nameClient' ORDER BY date_send DESC";
                                                                    $query_run = mysqli_query($conexion, $query);

                                                                    $total_row = 0;

                                                                    if(mysqli_num_rows($query_run) > 0)
                                                                    {
                                                                        foreach($query_run as $row)
                                                                            $numberNoteOne = $row['note_cobranza_credito'];
                                                                            $numberNoteTwo = $row['note_cobranza_credito_two'];
                                                                            $amount = $row['monto'];
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= $row['name_client'] ?></td>
                                                                                <td><?= $row['adress_send']; ?></td>
                                                                                <td><?= date("m/d/Y", strtotime($row['date_send'])); ?></td>
                                                                                <td><?= date("h:i a", strtotime($row['hour_send'])); ?></td>
                                                                                <td><?= $row['people_order']; ?></td>
                                                                                <td><?= $row['comments'] ?></td>
                                                                                <td><span class="badge bg-primary"><?= $row['status_payment'] ?></span></td>
                                                                                <td>
                                                                                    <?php 
                                                                                        if(!$numberNoteOne) {
                                                                                            echo $numberNoteTwo;
                                                                                        } else {
                                                                                            echo $numberNoteOne;
                                                                                        }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>

                                                                            
                                                                            <?php
                                                                            $total_neto = $total_row+=$amount;
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

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-4">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Fecha de entrega</th>
                                                    <th>Hora de entrega</th>
                                                    <th>Comentarios</th>
                                                    <th>Estatus de pago</th>
                                                    <th>Número de nota</th>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Estatus de pago</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Detalle del pedido</th>
                                                    <?php }?>
                                                    
                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Eliminar</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_order_admin = "SELECT * FROM ordens_admin ORDER BY purchaseid ASC";
                                                    $result_order_admin = mysqli_query($conexion, $search_order_admin);

                                                    while($row = mysqli_fetch_array($result_order_admin)) {
                                                        $numberNoteOne = $row['note_cobranza_credito'];
                                                        $numberNoteTwo = $row['note_cobranza_credito_two'];
                                                        $purchaseid = $row['purchaseid'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name_client']; ?></td>
                                                    <td><?php echo date("m/d/Y", strtotime($row['date_send'])); ?></td>
                                                    <td><?php echo date('h:i A', strtotime(($row['hour_send']))); ?></td>
                                                    <td><?php echo $row['comments']; ?></td>
                                                    <td><?php echo $row['status_payment']; ?></td>
                                                    <td>
                                                        <?php 
                                                            if(!$numberNoteOne) {
                                                                echo $numberNoteTwo;
                                                            } else {
                                                                echo $numberNoteOne;
                                                            }   
                                                        ?>
                                                    </td>
                                                    
                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center">
                                                           <?php 
                                                                $search_status = "SELECT * FROM ordens_admin INNER JOIN status_payment ON ordens_admin.purchaseid = status_payment.order_id WHERE status_payment.order_id = '$purchaseid'";
                                                                $result_status = mysqli_query($conexion, $search_status);

                                                                $data_status = mysqli_fetch_array($result_status);

                                                                $number_payment_status = mysqli_num_rows($result_status);

                                                                if($number_payment_status === 0) {

                                                                
                                                           ?>

                                                            <form action="created_status_payment.php" method="POST">
                                                                <input type="hidden" name="order_id" value="<?php echo $purchaseid; ?>">
                                                                <select name="payment_status" class="form-control">
                                                                    <option value="Por pagar">Por pagar</option>
                                                                    <option value="Pagado">Pagado</option>
                                                                </select>

                                                                <input type="submit" value="Guardar" class="btn btn-secondary btn-sm btn-block" name="save">
                                                            </form>

                                                            <?php } else if($number_payment_status === 'Pagado') { ?>
                                                                <form action="created_status_payment.php" method="POST">
                                                                    <input type="hidden" name="order_id" value="<?php echo $purchaseid; ?>">
                                                                    <select name="payment_status" class="form-control">
                                                                        <option selected disabled>Selecciona una opción</option>
                                                                        <option value="Pagado">Pagado</option>
                                                                    </select>

                                                                    <input type="submit" value="Guardar" class="btn btn-secondary btn-sm btn-block" name="save">
                                                                </form>
                                                            <?php } else {?>
                                                                <span class="badge badge-success"><?php echo $data_status['payment_status']; ?>
                                                                    <i class="fa-solid fa-money-bill-1-wave"></i>
                                                                </span>
                                                            <?php }?>
                                                        </td>
                                                    
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center"> 
                                                            <a href="show-detail-order.php?purchaseid=<?php echo $row['purchaseid']; ?>" class="btn btn-primary btn-sm">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center"> 
                                                            <a href="delete-order-admin-for-id.php?purchaseid=<?php echo $row['purchaseid']; ?>" class="btn btn-danger btn-sm">
                                                                <i class="bi bi-trash-fill"></i>
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
</body>
</html>