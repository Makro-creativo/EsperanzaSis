<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>EsperanzaSis</title>
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <link href="assets/css/style.css" rel="stylesheet" />
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
</head>
<body id="page-top">
    <div id="wrapper">
        <?php   
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se guardo correctamente el pedido!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-orders-admin-test.php";
                });
            </script>
        <?php } ?>

        <?php
        if(isset($_GET['verify'])) {
        ?>       

            <script>
                Swal.fire(
                    'Error',
                    'El número de nota que intentas registrar ya existe, intenta con uno nuevo...',
                    'error'
                )
            </script>
        <?php } ?>

        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                <div class="container outer-section" >
        
                                    <form action="purchase_admin.php" class="form-horizontal" role="form" id="orders_save" method="POST">
                                        <div id="print-area">
             
          
                                    <div class="row">
                                        <h2 class="mb-4">Agregar productos</h2>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr style="background-color: #4369dd; color: white;">
                                                            <th>Nombre del producto</th>
                                                            <th class='text-center'>Tipo de unidad</th>
                                                            <th class='text-center'>Cantidad</th>
                                                            <th class='text-right'>Precio unitario</th>
                                                            <th class='text-right'>Total</th>
                                                            <th class='text-right'>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class='items'>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                    <div class="form-group">
                                                        <label>Nombre del cliente: </label>
                                                        
                                                        <select name="id_client" class="form-control">
                                                            <option selected disabled>Seleccionar cliente</option>
                                                            <?php 
                                                                include "./config/conexion.php";

                                                                $search_clients = "SELECT * FROM clients ORDER BY name_client ASC";
                                                                $result_client = mysqli_query($conexion, $search_clients);

                                                                while($rowClient = mysqli_fetch_array($result_client)) {
                                                                    $nameClient = $rowClient['name_client'];
                                                                    $idClient = $rowClient['id_user'];
                                                            ?>
                                                                <option value="<?php echo $idClient; ?>"><?php echo $nameClient; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--<div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                    <div class="form-group">
                                                        <label>Dirección de entrega: </label>
                                                        <input type="text" placeholder="Direccion de entrega..." class="form-control" name="adress_send" id="adress_send" required>
                                                    </div>
                                                </div>-->

                                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                    <div class="form-group">
                                                        <label>Hora de entrega: </label>
                                                        <input type="time" name="hour_send" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                    <div class="form-group">
                                                        <label>Fecha de envío: </label>
                                                        <input type="date" name="date_send" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                    <div class="form-group">
                                                        <label>Persona quién ordeno: </label>
                                                        <input type="text" placeholder="Nombre de la persona quién solicito el pedido..." class="form-control" name="people_order" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                    <div class="form-group">
                                                        <label>Comentarios: </label>
                                                        <input type="text" placeholder="Comentarios..." class="form-control" name="comments">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                    <div class="form-group">
                                                        <label>Asignar pedido: </label>
                                                        <select name="name_delivery" class="form-control" required>
                                                            <option selected disabled>Seleccionar repartidor</option>
                                                            <?php 
                                                                include "./config/conexion.php";

                                                                $search_repartidores = "SELECT * FROM users WHERE tipo = 'Repartidor'";
                                                                $result_repartidores = mysqli_query($conexion, $search_repartidores);

                                                                while($row = mysqli_fetch_array($result_repartidores)) {
                                                                    $nameDelivery = $row['name'];
                                                            ?>
                                                                <option value="<?php echo $nameDelivery; ?>"><?php echo $nameDelivery; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3" required>
                                                    <div class="form-group">
                                                        <label>Estatus de pago: </label>
                                                        <select name="status_payment" class="form-control" id="status_payment" onChange="showRoleId(this.value);" required>
                                                            <option selected disabled>Seleccionar una opción</option>
                                                            <option value="credito">A credito</option>
                                                            <option value="contado">A contado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12" id="credito" style="display: none;">
                                                    <div class="form-group">
                                                        <label>Número de nota: </label>
                                                        <input type="text" name="note_cobranza_credito" placeholder="Ejemplo: 03456, etc..." class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12" id="contado" style="display: none;">
                                                    <div class="form-group">
                                                        <label>Número de nota: </label>
                                                        <input type="text" name="note_cobranza_credito_two" placeholder="Ejemplo: 03456, etc..." class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row"> <hr /></div>
                                        <div class="row pad-bottom  pull-right">
                                        
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit" class="btn btn-primary" name="save">
                                                    <i class="bi bi-plus-circle-fill"></i>
                                                    Guardar pedido
                                                </button> 
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Start Modal -->
            <form class="form-horizontal" name="guardar_item" id="guardar_item">
                <div class="modal fade" id="order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Nombre del producto: </label>
                                    <textarea class="form-control" id="name_product" name="name_product" required placeholder="Nombre del producto..."></textarea>
                                    <input type="hidden" class="form-control" id="action" name="action" value="ajax">
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Tipo de unidad: </label>
                                <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Ejemplo: Kilos, Bolsas, etc..." required>
                            </div>		
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Cantidad: </label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="0" required>
                            </div>
                                                    
                            <div class="col-md-6">
                                <label>Precio: </label>
                                <input type="text" class="form-control" id="price" name="price" value="0.00" required>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-x-circle-fill"></i>
                                Limpiar Producto
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cart-plus-fill"></i>
                                Agregar
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal -->
        </div>
        <br>
        <?php include "./partials/footer.php" ?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript">
        function showItems(){
            var parametros={"action":"ajax"};
            $.ajax({
                url:'./items.php',
                data: parametros,
                beforeSend: function(objeto){
                $('.items').html('Cargando...');
            },
                success:function(data){
                    $(".items").html(data).fadeIn('slow');
            }
            })
        }
        function deleteItem(id){
            $.ajax({
                type: "GET",
                url: "./items.php",
                data: "action=ajax&id="+id,
                beforeSend: function(objeto){
                    $('.items').html('Cargando...');
                },
                success: function(data){
                    $(".items").html(data).fadeIn('slow');
                }
            });
        }
        
        $( "#guardar_item" ).submit(function( event ) {
            parametros = $(this).serialize();
            $.ajax({
                type: "POST",
                url:'./items.php',
                data: parametros,
                beforeSend: function(objeto){
                    $('.items').html('Cargando...');
                },
                success:function(data){
                    $(".items").html(data).fadeIn('slow');
                    $("#order").modal('hide');
                }
            })
            
        event.preventDefault();
        });     

        showItems();   
    </script>
    <script>
        function showRoleId(id) {
            if(id === "credito") {
                $("#credito").show();
                $("#contado").hide();
            }

            if(id === "contado") {
                $("#credito").hide();
                $("#contado").show();
            }
        }
    </script>
</body>
</html>