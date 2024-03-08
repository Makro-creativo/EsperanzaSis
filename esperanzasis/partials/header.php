<?php  
    include "../config/conexion.php";

    error_reporting(0);
    session_start();

    $typeUser = $_SESSION['Tipo'];
    $name = $_SESSION['name'];
    $uid = $_SESSION['UID'];
?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->

    <?php if($typeUser === "SuperAdmin") {?>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="DashboardSuperAdmin.php" class="nav-link">Inicio</a>
        </li>
    </ul>
    <?php }?>

    <?php if($typeUser === "Cliente") {?>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="DashboardCliente.php" class="nav-link">Inicio</a>
        </li>
    </ul>
    <?php }?> 
    
    <?php if($typeUser === "Administrador") {?>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="DashboardAdmin.php" class="nav-link">Inicio</a>
        </li>
    </ul>
    <?php }?>


    <?php if($typeUser === "Repartidor") {?>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="DashboardRepartidor.php" class="nav-link">Inicio</a>
            </li>
        </ul>
    <?php }?>
    

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" onclick="cleanNotificationPayments()" id="count-notification-payments">
                    <?php 
                        include "./config/conexion.php";

                        $search_count_notification = "SELECT * FROM new_orders_admin COUNT WHERE status_payment = 'credito' AND notification_status = 0 ORDER BY created_at DESC LIMIT 10";
                        $result_count_notification = mysqli_query($conexion, $search_count_notification);

                        $count_notification_to_credito = mysqli_num_rows($result_count_notification);

                        if($count_notification_to_credito > 0){
                            echo $count_notification_to_credito."+";
                        } else {
                            echo $count_notification_to_credito;
                        }
                    ?>
                </span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-success border-success">
                    Notificaciones
                </h6>
                <?php 
                    include "./config/conexion.php";

                    $show_data_notification = "SELECT clients.name_client, new_orders_admin.status_payment, new_orders_admin.id AS order_id, 
                    DATE_FORMAT(new_orders_admin.date_send, '%m/%d/%Y') AS date_send_formatted 
                    FROM new_orders_admin 
                    INNER JOIN clients ON new_orders_admin.client_id = clients.id 
                    WHERE new_orders_admin.status_payment = 'credito' 
                    AND new_orders_admin.status_deleted = 0
                    ORDER BY new_orders_admin.created_at DESC LIMIT 10";
                    $result_data_notification = mysqli_query($conexion, $show_data_notification);

                    while($rowNotification = mysqli_fetch_array($result_data_notification)) {
                ?>
                <a class="dropdown-item d-flex align-items-center" href="show-ticket-for-client-id.php?id=<?php echo $rowNotification['order_id']; ?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fa-solid fa-money-check-dollar text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?php echo $rowNotification['date_send_formatted']; ?></div>
                        <span class="font-weight-bold"><?php echo $rowNotification['name_client']; ?> - <span class="badge bg-primary text-white"><?php echo $rowNotification['status_payment']; ?></span></span>
                    </div>
                </a>
                <?php }?>
                <a class="dropdown-item text-center small text-gray-500" href="show-all-orders-credito.php">Ver todas las notificaciones</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $name; ?> | <?php echo $typeUser; ?></span>
                    <img class="img-profile rounded-circle"
                    src="assets/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="profile.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a>

                    <?php if($typeUser === "Administrador") {?>
                        <a class="dropdown-item" href="create-inbox.php">
                            <i class="fas fa-inbox fa-sm fa-fw mr-2 text-gray-400"></i>
                            Soporte tecnico
                        </a>
                    <?php }?>

                    <?php if($typeUser === "SuperAdmin") {?>
                        <a class="dropdown-item" href="new-inbox.php">
                            <i class="fas fa-inbox fa-sm fa-fw mr-2 text-gray-400"></i>
                            Soporte tecnico
                        </a>
                    <?php }?>
                                
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar Sesión
                    </a>
            </div>
        </li>

        

    </ul>

    

</nav>
<!-- End of Topbar -->


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Esta seguro de cerrar sesión?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-outline-danger" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    
</div>