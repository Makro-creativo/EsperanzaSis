<?php 
    include "./config/conexion.php";

    session_start();

    $typeUser = $_SESSION['Tipo'];

    $id_customer = $_GET['id_user'];

    $sql = "SELECT * FROM bills WHERE id_user = '$id_customer'";
    $query = $conexion->query($sql);

    $data = array();

    while($row = $query->fetch_object()){
     $data[] = $row;
    }
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <?php 
                    include "./config/conexion.php";

                    $id_customer = $_GET['id_user'];

                    $search_customer_id = "SELECT * FROM bills WHERE id_user = '$id_customer'";
                    $result_search = mysqli_query($conexion, $search_customer_id);
                
                ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                       
                            <div class="main">
                                <div class="container mt-3">
                                    <div class="card animate__animated animate__fadeIn shadow-lg">
                                        <div class="card-header d-flex justify-content-around">
                                            <?php 
                                                include "./config/conexion.php";

                                                $id_customer = $_GET['id_user'];

                                                $query_date = "SELECT date_bills FROM bills WHERE id_user = '$id_customer'";
                                                $result_date = mysqli_query($conexion, $query_date);

                                                while($row = mysqli_fetch_array($result_date)) {
                                            ?>

                                        
                                            <strong>Fecha: <?php echo date('M d, Y h:i A', strtotime($row['date_bills'])); ?></strong>
                                            
                                            <?php }?>

                                            <strong>
                                            Estatus: <?php 
                                                    include "./config/conexion.php";

                                                    $search_status = "SELECT payment, CASE WHEN payment = 'Pagada' THEN 'Pagada' WHEN payment = 'Por cobrar' THEN 'Por cobrar' ELSE 'No hay estatus' END FROM payment_status WHERE id_user = '$id_customer'";
                                                    $result_status = mysqli_query($conexion, $search_status);

                                                    while($row = mysqli_fetch_array($result_status)) {
                                                    
                                                ?>

                                                    <strong><?php echo $row['payment']; ?></strong>
                                                <?php }?>
                                            </strong>

                                           <a href="edit-status-id.php?id_user=<?php echo $id_customer; ?>" class="btn btn-info btn-sm">
                                               Editar estatus
                                               <i class="fas fa-edit mr-2"></i>
                                           </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-4">
                                                <div class="col-6 col-md-6">
                                                    <h6 class="mb-2">De:</h6>
                                                    <div>
                                                        <strong>Tortillería la Esperanza</strong>
                                                    </div>
                                                    <div>Av. Paseo de la Prímavera 2195,</div>
                                                    <div>CP 45006, Zapopan, Jal.</div>
                                                    <div>Teléfono: (33) 3180 5555</div>
                                                </div>

                                                <div class="col-6 col-md-6">
                                                    <?php 
                                                        include "./config/conexion.php";
                                                        $id_customer = $_GET['id_user'];

                                                        $query_customer_data = "SELECT customer_name FROM bills WHERE id_user = '$id_customer'";
                                                        $result_customers_data = mysqli_query($conexion, $query_customer_data);

                                                        while($row = mysqli_fetch_array($result_customers_data)) {
                                                    
                                                    ?>
                                                    <h6 class="mb-2">Para:</h6>
                                                    <div>
                                                        <strong>Cliente: <?php echo $row['customer_name']; ?></strong>
                                                    </div>
                                            
                                                    <?php }?>
                                                </div>

                                            </div>

                                            <div class="table-responsive-sm">
                                                <table class="table table-sm table-striped" id="table-render">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" width="2%" class="center">#</th>
                                                            <th scope="col" width="20%">Nombre del cliente</th>
                                                            <th scope="col" class="d-none d-sm-table-cell" width="50%">Monto</th>

                                                            <th scope="col" width="10%" class="text-left">Iva</th>
                                                            <th scope="col" width="8%" class="text-right">Concepto</th>
                                                            <th scope="col" width="10%" class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            include "./config/conexion.php";
                                                            $id_customer = $_GET['id_user'];

                                                            $query_bills = "SELECT * FROM bills WHERE id_user = '$id_customer'";
                                                            $result_bills = mysqli_query($conexion, $query_bills);

                                                            while($row = mysqli_fetch_array($result_bills)) {
                                                        ?>
                                                        <tr>
                                                            <td class="text-left"><?php echo $row['id_customer']; ?></td>
                                                            <td class="item_name"><?php echo $row['customer_name']; ?></td>
                                                            <td class="item_desc d-none d-sm-table-cell">
                                                                <?php echo number_format($row['amount'], 2); ?>
                                                            </td>

                                                            <td class="text-left"><?php echo number_format($row['iva'], 2); ?></td>
                                                            <td class="text-center"><?php echo $row['concept']; ?></td>
                                                            <td class="text-right">
                                                                <?php 
                                                                    $result_calculation = ( $row['amount'] ) + ( $row['iva']);

                                                                    echo number_format($result_calculation, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-5">
                                                </div>

                                                <div class="col-lg-4 col-sm-5 ml-auto">
                                                    <table class="table table-sm table-clear">
                                                        <tbody>
                                                            <?php 
                                                                include "./config/conexion.php";
                                                                $id_customer = $_GET['id_user'];

                                                                $query_calculation_customer = "SELECT iva, amount FROM bills WHERE id_user = '$id_customer'";
                                                                $result_customer = mysqli_query($conexion, $query_calculation_customer);
                                                                
                                                                while($row = mysqli_fetch_array($result_customer)) {
                                                            ?>
                                                            <tr>
                                                                <td class="left">
                                                                    <strong>Iva</strong>
                                                                </td>
                                                                <td class="text-right bg-light"><?php echo number_format($row['iva'], 2); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="left">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="text-right bg-light">
                                                                    <?php 
                                                                        $result_calculation = ( $row['amount'] ) + ( $row['iva']);

                                                                        echo number_format($result_calculation, 2);
                                                                    ?>
                                                                </td>
                                                            </tr>   

                                                            <?php }?>
                                                        </tbody>
                                                    </table>
                                                    
                                                    <div class="d-flex justify-content-end">
                                                        <button id="generate-pdf" class="btn btn-primary mt-4">
                                                            <i class="fas fa-file-pdf mr-2"></i>
                                                            Generar PDF
                                                        </button>
                                                    </div>
                                                
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Start form for save status of payment -->

                <div class="container p-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="card shadow-lg card-hide"  style="display: block;">
                                <div class="card-header">Estatus de la factura</div>

                                <div class="card-body">
                                    <form action="save-status-bills.php" method="POST">
                                        <input type="hidden" name="id_save_payment" value="<?php echo $id_customer; ?>">
                                        <div class="form-group">
                                            <label>Registrar status de la factura: </label>
                                            <select name="payment" require required class="form-select">
                                                <option selected disabled>Seleccionar status</option>
                                                <option value="Pagada">Pagada</option>
                                                <option value="Por cobrar">Por cobrar</option>
                                            </select>
                                        </div>

                                        <button id="hideClick" type="submit" class="btn btn-success btn-block" name="saveStatus">
                                            Guardar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End form for save status of payment -->

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
    $("#generate-pdf").click(function(){
        let pdf = new jsPDF();
        pdf.text(20,20,"Factura Tortillería la Esperanza");

        var columns = ["Id", "Nombre del cliente", "Monto", "Iva", "Fecha", "Fecha de pago", "Concepto"];
        var data = [
        <?php foreach($data as $bills):?>
            [<?php echo $bills->id_user; ?>, 
            "<?php echo $bills->customer_name; ?>", 
            "<?php echo number_format($bills->amount, 2); ?>", 
            "<?php echo number_format($bills->iva, 2); ?>",
            "<?php echo date("d/m/Y", strtotime($bills->date_saved)); ?>",
            "<?php echo date("d/m/Y", strtotime($bills->date_to_pay_bills)); ?>",
            "<?php echo $bills->concept; ?>"
            
        ],
            <?php endforeach; ?>
        ];

        pdf.autoTable(columns,data,
            { margin:{ top: 25  }}
        );

        pdf.save('factura.pdf');

    });
</script>

<script>
    function hideForm() {
        const button = document.getElementById("hideClick");

        button.addEventListener('click', e => {
            e.preventDefault();

            const card = document.querySelector(".card-hide");
            card.style.display = 'none';
        });
    }

    
</script>
</body>
</html>