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
    <?php if($typeUser === "Client") {?>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="DashboardClient.php" class="nav-link">Inicio</a>
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

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">   

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
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a>
                                
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Actividad reciente
                    </a>
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