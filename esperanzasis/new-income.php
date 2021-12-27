<?php 
    include "./config/conexion.php";

    if(isset($_POST['savedIncome'])) {
        $idCategories = $_POST['id_category_income'];
        $array = explode("_", $idCategories);
        $idNameCategory = $array[0];
        $nameCategories = $array[1];

        $createdAt = $_POST['created_at'];
        $description = $_POST['description'];
        $quantity = floatval($_POST['quantity']);

        $query_save_income = "INSERT INTO ingresos(id_categories, category_name, created_at, description, quantity) VALUES('$idNameCategory', '$nameCategories', '$createdAt', '$description', '$quantity')";
        $result_income = mysqli_query($conexion, $query_save_income);

        if(!$result_income) {
            die("No se pudo guardar correctamente, intentelo de nuevo...");
        }

        header("location: show-incomes.php");
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

                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Crear nuevo ingreso</h2>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">Crear nuevo ingreso</div>

                                <div class="card-body">
                                    <form action="new-income.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Fecha: </label>
                                                    <input type="date" name="created_at" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Descripción: </label>
                                                    <textarea name="description" rows="1" class="form-control" placeholder="Ejemplo: Ingreso de venta de maíz, etc..."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Cantidad: </label>
                                                    <input type="text" name="quantity" class="form-control" placeholder="Ejemplo: 2000">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Categoría: </label>
                                                    <select name="id_category_income" required require class="form-select">
                                                        <option selected disabled>Seleccionar categoría</option>
                                                        <?php 
                                                            include "./config/conexion.php";

                                                            $search_income = "SELECT * FROM categories_income";
                                                            $result_income = mysqli_query($conexion, $search_income);

                                                            while($row = mysqli_fetch_array($result_income)) {
                                                                $id_categories = $row['id_categories'];
                                                                $categoryName = $row['name_category'];
                                                        ?> 
                                                            <option value="<?php echo $id_categories."_".$categoryName; ?>"><?php echo $categoryName; ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Registrar ingreso" class="btn btn-success btn-block" name="savedIncome">
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