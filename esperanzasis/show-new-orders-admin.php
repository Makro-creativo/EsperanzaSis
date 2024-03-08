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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body id="page-top">
    <div id="wrapper">

        <?php   
            if(isset($_GET['delete'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se elimino correctamente!',
                    icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-new-orders-admin.php";
                });
            </script>
        <?php } ?>

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
                                        <h6 class="text-center text-primary p-3">Buscar por cliente</h6>

                                        <div class="card-body">
                                            <form action="" method="GET">
                                                <div class="row mt-3">
                                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <div class="form-group">
                                                            <label>Cliente: </label>
                                                            <select name="client_id" class="form-control js-example-basic-single" value="<?php if(isset($_GET['client_id'])){ echo $_GET['client_id']; } ?>">
                                                                <option selected disabled>Seleccionar cliente</option>
                                                                <?php 
                                                                    include "./config/conexion.php";

                                                                    $search_name_client = "SELECT DISTINCT new_orders_admin.date_send, new_orders_admin.status_payment, 
                                                                    new_orders_admin.number_note, new_orders_admin.amount, 
                                                                    new_orders_admin.client_id AS idClient, clients.name_client 
                                                                    FROM new_orders_admin INNER JOIN clients ON new_orders_admin.client_id = clients.id 
                                                                    GROUP BY clients.name_client ORDER BY clients.name_client DESC";
                                                                    $result_name_client = mysqli_query($conexion, $search_name_client);

                                                                    while($rowClient = mysqli_fetch_array($result_name_client)) {
                                                                        $idClient = $rowClient['idClient'];
                                                                        $nameClient = $rowClient['name_client'];
                                                                        $statusPayment = $rowClient['status_payment'];
                                                                ?>
                                                                    <option value="<?php echo $idClient; ?>"><?php echo $nameClient; ?> - <?php echo $statusPayment; ?></option>
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
                                                                    <th>Fecha de entrega</th>
                                                                    <th>Estatus de pago</th>
                                                                    <th>Número de nota</th>
                                                                    <th>Monto</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <?php 
                                                                include "./config/conexion.php";

                                                                if(isset($_GET['client_id']))
                                                                {
                                                                    $idClient = $_GET['client_id'];
                                                                    $total_neto = 0;

                                                                    $query = "SELECT * FROM new_orders_admin INNER JOIN purchase_detail_admin ON new_orders_admin.id = purchase_detail_admin.purchaseid 
                                                                    INNER JOIN clients ON clients.id = new_orders_admin.client_id INNER JOIN products ON products.id = purchase_detail_admin.productid 
                                                                    WHERE new_orders_admin.client_id = '$idClient' GROUP BY purchase_detail_admin.purchaseid";
                                                                    $query_run = mysqli_query($conexion, $query);

                                                                    $total_row = 0;

                                                                    if(mysqli_num_rows($query_run) > 0) {
                                                                        while($row = mysqli_fetch_array($query_run)) {
                                                                            $nameClientResult = $row['name_client'];
                                                                            $dateSend = $row['date_send'];
                                                                            $statusPayment = $row['status_payment'];
                                                                            $numberNote = $row['number_note'];
                                                                            $amount = $row['amount'];

                                                                            $total_neto += $row['amount'];

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $nameClientResult; ?></td>
                                                                                    <td><?php echo date('d/m/Y', strtotime($dateSend)); ?></td>
                                                                                    <td><span class="badge bg-primary"><?php echo $statusPayment; ?></span></td>
                                                                                    <td>
                                                                                        <?php 
                                                                                            echo $numberNote;
                                                                                        ?>
                                                                                    </td>
                                                                                    <td><?php echo "$".number_format($amount, 2); ?></td>
                                                                                </tr>

                                                                            <?php 

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
                                                                        <td colspan="8" class="text-center bg-success" style="color: white !important;">
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
                                                    <th>Estatus de pago</th>
                                                    <th>Número de nota</th>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Ticket de compra</th>
                                                    <?php }?>
                                                    
                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Eliminar</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_order_admin = "SELECT new_orders_admin.client_id, new_orders_admin.date_send, new_orders_admin.number_note, new_orders_admin.status_payment, new_orders_admin.status_deleted, new_orders_admin.id AS orderid, clients.name_client 
                                                    FROM new_orders_admin 
                                                    INNER JOIN clients ON clients.id = new_orders_admin.client_id
                                                    WHERE new_orders_admin.status_deleted = 0 
                                                    ORDER BY new_orders_admin.date_send DESC
                                                    ";
                                                    $result_order_admin = mysqli_query($conexion, $search_order_admin);

                                                    while($row = mysqli_fetch_array($result_order_admin)) {
                                                        $purchaseid = $row['orderid'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name_client']; ?></td>
                                                    <td><?php echo date("m/d/Y", strtotime($row['date_send'])); ?></td>
                                                    <td>
                                                        <span class="badge bg-primary">
                                                            <?php 
                                                               echo $row['status_payment']; 
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['number_note']; ?>
                                                    </td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center"> 
                                                            <a href="show-ticket-for-client-id.php?id=<?php echo $purchaseid; ?>" class="btn btn-primary btn-sm">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center"> 
                                                            <a href="delete-order-for-client-id.php?id=<?php echo $purchaseid; ?>" class="btn btn-danger btn-sm">
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            "order": []
		});
	</script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>
</html>