<!DOCTYPE html>
<html lang="en">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body id="page-top">
    <div id="wrapper">
        <?php   
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se guardo existosamente el pedido!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-new-orders-admin.php";
                });
            </script>
        <?php } ?>

        <?php   
            if(isset($_GET['error'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo guardar el pedido!',
                    icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-orders-admin.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLateral.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php"; ?>

                <div class="container">
                    <div class="row">
                        <h2 class="text-center text-primary">Pedidos Admin</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <select name="id_client" id="clients" class="form-control js-example-basic-single">
                                                <option selected disabled>Seleccionar cliente</option>
                                                
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_all_clients = "SELECT * FROM clients WHERE status_deleted = 0 ORDER BY name_client DESC";
                                                    $result_clients = mysqli_query($conexion, $search_all_clients);

                                                    while($rowClients = mysqli_fetch_array($result_clients)) {
                                                        $idClient = $rowClients['id'];
                                                        $nameClient = $rowClients['name_client'];
                                                ?>
                                                    <option value="<?php echo $idClient; ?>"><?php echo $nameClient; ?></option>
                                                <?php }?>
                                            </select>

                                            <button id="btnShowProducts" type="button" class="btn btn-success btn-block mt-4" onclick="showProducts()">Mostrar Productos</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-4">
                                            <div class="table-responsive">
                                            <form method="POST" action="process_orders.php" enctype='multipart/form-data'>
                                                <table class="table table-bordered table" id="table-products">
                                                    <tr>
                                                        <th>Cliente</th>
                                                        <th>Producto</th>
                                                        <th>Precio</th>
                                                        <th>Tipo de unidad</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "./partials/footer.php"; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        function showProducts() {
                let idCliente = document.getElementById("clients").value;
            
                let xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_products.php?id=' + idCliente, true);
                xhr.onload = function () {

                if (xhr.status === 200) {
                    document.querySelector("tbody").innerHTML = xhr.responseText;
                } else {
                    console.log('Error al obtener los productos');
                }
            };
                xhr.send();
            }

    </script>
    <script>
		const table = $('#table-products').DataTable({
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