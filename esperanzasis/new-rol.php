<?php 
    include "./config/conexion.php";


    if(isset($_POST['saveRol'])) {
        $name = $_POST['name_client'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $tipo = $_POST['tipo'];
        

        echo $query = "INSERT INTO users(name, user, pass, tipo) VALUES('$name', '$user', '$pass', '$tipo')";
        //$result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se pudo registrar el usuario, verifica de nuevo por favor...");
        }

        //header("location: show-roles.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-header">Crear nuevo Rol de Usuario</div>

                                <div class="card-body">
                                    <form action="new-rol.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Elije un usuario: </label>
                                                    <select name="name_client" require class="form-select">
                                                        <option selected disabled>Elije un usuario</option>
                                                        <?php 
                                                            include "./config/conexion.php"; 


                                                            $query = "SELECT * FROM clients";
                                                            $result = mysqli_query($conexion, $query);

                                                            while($row = mysqli_fetch_array($result)) {
                                                                $id = $row['id'];
                                                        
                                                            ?>

                                                            <option value="<?php echo $id; ?>"><?php echo $id; ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
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
                                                        <option value="Administrador">Administrador</option>
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