<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <link rel="shortcut icon" href="assets/img/favicon_makro_web.svg">

    <title>EsperanzaSis - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="assets/css/main.css">

</head>

<body class="bg-hero">
<?php
    if(isset($_GET['error'])) {
 ?>       

    <script>
        Swal.fire(
            'Error',
            'Acceso incorrecto, Intente de nuevo',
            'error'
        )
    </script>
 <?php } ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                <div class="card border-0 shadow-lg mt-6">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo la esperanza" class="img-fluid mx-auto mt-2" style="width: 80px; height: 80px;">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Iniciar Sesión</h1>
                                    </div>
                                    <form class="user" action="access.php" method="POST">
                                        <div class="form-group">
                                            <input name="user" autocomplete="off" type="text" class="form-control form-control-user" placeholder="Nombre de usuario...">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user" placeholder="Contraseña">
                                        </div>
                    

                                        <input type="submit" value="Ingresar" class="btn btn-success btn-block btn-user mt-4">
                                       
                                    </form>

                                    <div>
                                        <a href="index.html" class="text-dark mt-4 ml-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-arrow-left mr-2"></i>
                                            Regresar a inicio
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>