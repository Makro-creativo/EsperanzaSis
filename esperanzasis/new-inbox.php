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

    <style>
        .acorted-text {
            text-overflow: ellipsis !important;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Inbox</h2>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-4">
                        
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    Folder
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-inbox"></i>
                                            Inbox
                                        </div>
                                        <span class="badge bg-primary rounded-pill">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query_notifications_count = mysqli_query($conexion, "SELECT * FROM notifications");
                                                $count_notifications = mysqli_num_rows($query_notifications_count);

                                                echo $count_notifications;
                                            ?>
                                        </span>
                                    </li>
                            
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 col-lg-8 col-xl-8 col-xxl-8 mt-4">
                            <div class="card shadow-lg">
                                <div class="card-header">Inbox</div>

                                <div class="card-body">
                                    <div class="list-group">
                                        <?php 
                                            include "./config/conexion.php";

                                            $query_notifications = "SELECT * FROM notifications WHERE status = '0'";
                                            $result_notifications = mysqli_query($conexion, $query_notifications);

                                            while($row = mysqli_fetch_array($result_notifications)) {
                                        ?>

                                            <?php if($result_notifications > 0) {?>
                                                <a href="show-inbox.php?id=<?php echo $row['id']; ?>" class="list-group-item list-group-item-action" aria-current="true">
                                                    <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1"><?php echo $row['subject']; ?></h5>
                                                    <small><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></small>
                                                    </div>
                                                    <p class="mb-1 acorted-text"><?php echo $row['description']; ?></p>
                                                </a>
                                            <?php }?>
                                        <?php }?>
                                    </div>
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