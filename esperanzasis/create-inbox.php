<?php 
    session_start();

    include "./config/conexion.php";
    $msg = "";

    if(!isset($_SESSION['UID'])) {
        ?>
        <script>
            window.location.href='create-inbox.php';
        </script>
	    <?php
    }

    $uid = $_SESSION['UID'];

    if(isset($_POST['send'])) {
        $id_user_noti = $_POST['id_user_noti'];
        $array = explode("_", $id_user_noti);
        $idUser = $array[0];
        $tipoUser = $array[1];

        $to_id = $_POST['to_id'];
        $description = $_POST['description'];
        $subject = $_POST['subject'];
        $created_at = $_POST['created_at'];

        $query_notification = "INSERT INTO notifications(from_id, to_id, description, subject, status, created_at) VALUES('$uid', '$idUser', '$description', '$subject', '0', NOW())";
        $result_notification = mysqli_query($conexion, $query_notification);

        if(!$result_notification) {
            die("No se pudo enviar correctamente el mensaje, intentelo de nuevo...");
        }

        header("location: create-inbox.php");
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
                    <h2 class="d-flex justify-content-start mb-4">Crear nuevo mensaje</h2>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">Crear nuevo mensaje</div>

                                <div class="card-body">
                                    <form action="create-inbox.php" method="POST">
                                        <input type="hidden" value="<?php echo $idUser; ?>" name="id_user_noti">
                                        <div class="form-group">
                                            <label>Para: </label>
                                            <select name="id_user_noti" require required class="form-select">
                                                <option disabled requiered>Elejir usuario</option>
                                                    <?php 
                                                    include "./config/conexion.php";

                                                
                                                    $search_user = "SELECT * FROM users WHERE Tipo = 'SuperAdmin'";
                                                    $result_user = mysqli_query($conexion, $search_user);

                                                    while($row = mysqli_fetch_array($result_user)) {
                                                        $idUser = $row['id_user'];
                                                        $tipoUser = $row['tipo'];
                                                    ?>
                                                    
                                                        <option value="<?php echo $idUser."_".$tipoUser; ?>"><?php echo $tipoUser; ?></option>
                                                    <?php }?>
                                                </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Asunto: </label>
                                            <input type="text" placeholder="Asunto del mensaje" class="form-control" name="subject">
                                        </div>

                                        <div class="form-group">
                                            <label>Descripción del mensaje: </label>
                                            <textarea name="description" cols="10" rows="7" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Archivo: </label>
                                            <input class="form-control form-control-sm" id="formFileSm" type="file" name="image">
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="send">
                                            <i class="far fa-envelope"></i>
                                            Enviar
                                        </button>
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
</body>
</html>