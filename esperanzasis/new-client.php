<?php 
    include "./config/conexion.php";

    if(isset($_POST['saveClient'])) {
        $name_client = $_POST['name_client'];
        $address_fiscal = $_POST['address_fiscal'];
        $address_company = $_POST['address_company'];
        $giro_company = $_POST['giro_company'];
        $rfc = $_POST['rfc'];
        $manager_payments = $_POST['manager_payments'];
        $activate = $_POST['activate'];
        $tel = $_POST['tel'];
        $cel = $_POST['cel'];
        $email = $_POST['email'];
        $cp = $_POST['cp'];
        
        $query_client = "INSERT INTO clients(name_client, address_fiscal, address_company, giro_company, rfc, manager_payments, activate, tel, cel, email, cp) VALUES('$name_client', '$address_fiscal', '$address_company', '$giro_company', '$rfc', '$manager_payments', '$activate', '$tel', '$cel', '$email', '$cp')";
        $result = mysqli_query($conexion, $query_client);

        if(!$result) {
            die("No se pudo guardar el cliente, verifique de nuevo sus datos");
        }

        json_encode($result);

        //header("location: show-clients.php");
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
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Nuevo cliente</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-header">Registrar nuevo cliente</div>

                                <div class="card-body" id="app">
                                    <form @submit.prevent="createClient()" method="POST">
                                    
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Nombre de la empresa: </label>
                                                    <input v-model="name" name="name_client" type="text" placeholder="Ejemplo: Hotel malibu, Hotel hd, etc ..." autocomplete="off" class="form-control" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Dirección Fiscal: </label>
                                                    <input v-model="address_fiscal" autocomplete="off" name="address_fiscal" type="text" placeholder="Ejemplo: Calle santa cecilia #345" autocomplete="off" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Código postal: </label>
                                                    <input v-model="cp" name="cp" type="text" placeholder="Ejemplo: 47910, etc.." autocomplete="off" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Dirección de la empresa: </label>
                                                    <input type="text" placeholder="Ejemplo: Avenida los Arcos..." class="form-control" name="address_company" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Giro de la empresa: </label>
                                                    <input type="text" placeholder="Ejemplo: Mueblería, ferretería, etc..." class="form-control" name="giro_company" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>RFC: </label>
                                                    <input type="text" placeholder="MELM8305281H0" class="form-control" name="rfc" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Encargado de compras: </label>
                                                    <input type="text" placeholder="Ejemplo: Mariano gonzales" class="form-control" name="manager_payments">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Estatus del cliente: </label>
                                                    <select name="activate" require class="form-select">
                                                        <option selected disabled>Elije una opción</option>
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
                                                    <label>Número de teléfono: </label>
                                                    <input type="text" placeholder="Ejemplo: 393 93 5 35 13" name="tel" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de celular: </label>
                                                    <input type="text" placeholder="Ejemplo: 333 102 3456" name="cel" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Correo electronico: </label>
                                                    <input type="email" placeholder="Ejemplo: jose@gmail.com" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Registrar" class="btn btn-outline-success mt-4" name="saveClient">
                                        </div>
                                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="./assets/js/clients.js"></script>
</body>
</html>