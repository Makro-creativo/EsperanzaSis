<?php 
    include "./config/conexion.php";

    if(isset($_POST['editExpense'])) {
        $idCategory = $_POST['id_category_expense'];
        $array = explode("_", $idCategory);
        $idName = $array[0];
        $nameCategory = $array[1];

        $id = $_POST['id_edit'];
        $createdAt = $_POST['created_at'];
        $description = $_POST['description'];
        $amount = floatval($_POST['amount']);
        $notesOrInvoice = $_POST['notes_or_invoice'];
        $numberNotes = $_POST['number_notes'];

        $query_edit = "UPDATE gastos SET name_category='$nameCategory', created_at='$createdAt', description='$description', amount='$amount', notes_or_invoice='$notesOrInvoice', number_notes='$numberNotes' WHERE id = '$id'";
        $result_edit = mysqli_query($conexion, $query_edit);

        header("location: show-expenses.php");
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

                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }

                    $query_with_id = "SELECT * FROM gastos WHERE id = '$id'";
                    $result_id = mysqli_query($conexion, $query_with_id);

                    if($result_id) {
                        $row = mysqli_fetch_array($result_id);

                        $nameCategory = $row['name_category'];
                        $createdAt = $row['created_at'];
                        $description = $row['description'];
                        $amount = $row['amount'];
                        $notesOrInvoice = $row['notes_or_invoice'];
                        $numberNotes = $row['number_notes'];
                    }
                ?>

                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Editar gasto</h2>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">Editar gasto</div>

                                <div class="card-body">
                                    <form action="edit-expense.php" method="POST">
                                        <input type="hidden" value="<?php echo $id; ?>" name="id_edit">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Fecha: </label>
                                                    <input type="date" value="<?php echo $createdAt; ?>" name="created_at" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Descripción: </label>
                                                    <textarea name="description" rows="1" class="form-control" placeholder="Ejemplo: Gastos de luz, etc..."><?php echo $row['description']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Cantidad: </label>
                                                    <input value="<?php echo $amount; ?>" type="text" class="form-control" name="amount">
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Categoría: </label>
                                                    <select name="id_category_expense" require required class="form-select">
                                                        <option selected disabled>Seleccionar categoría</option>
                                                        <?php 
                                                            include "./config/conexion.php";

                                                            $search_categories = "SELECT * FROM categories";
                                                            $result_categories = mysqli_query($conexion, $search_categories);

                                                            while($row = mysqli_fetch_array($result_categories)) {
                                                                $idCategory = $row['id_category'];
                                                                $nameCategory = $row['name'];
                                                        ?>
                                                            <option value="<?php echo $idCategory."_".$nameCategory; ?>"><?php echo $nameCategory; ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Factura o nota: </label>
                                                    <select name="notes_or_invoice" required require class="form-select">
                                                        <option disabled selected>Selecciona una opción</option>
                                                        <option value="Factura" <?php if($notesOrInvoice == "Factura"){?> selected <?php } ?>>Factura</option>
                                                        <option value="Notas" <?php if($notesOrInvoice == "Notas"){?> selected <?php } ?>>Notas</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Número de nota o factura: </label>
                                                    <input type="text" placeholder="Ejemplo: GHJ123, etc..." class="form-control" name="number_notes">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Editar gasto" class="btn btn-success btn-block" name="editExpense">
                                    </form>
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
</body>
</html>