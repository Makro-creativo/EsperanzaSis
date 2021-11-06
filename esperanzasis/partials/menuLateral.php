 <?php 
    error_reporting(0);
    session_start();

    $name = $_SESSION['name'];
    $typeUser = $_SESSION['Tipo'];
 ?>

 <!-- Sidebar -->
 <ul class="navbar-nav bg-green sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<?php if($typeUser === "Client") {?>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardClient.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo la esperanza" class="img-fluid" style="width: 150px; height: 150px;">
    </div>
    <div class="sidebar-brand-text mx-3">EsperanzaSis</div>
</a>
<?php }?>

<?php if($typeUser === "Administrador") {?>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardAdmin.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo la esperanza" class="img-fluid" style="width: 150px; height: 150px;">
    </div>
    <div class="sidebar-brand-text mx-3">EsperanzaSis</div>
</a>
<?php }?>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<?php if($typeUser === "Client") {?>
<li class="nav-item active">
    <a class="nav-link" href="DashboardClient.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Panel de Control</span></a>
</li>
<?php }?>

<?php if($typeUser === "Administrador") {?>
<li class="nav-item active">
    <a class="nav-link" href="DashboardAdmin.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Panel de Control</span></a>
</li>
<?php }?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Menú
</div>

<!-- Nav Item - Pages Collapse Menu -->
<?php if($typeUser === "Client") {?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-sort-amount-up-alt"></i>
        <span>Gestión de Pedidos</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-order.php">Crear un nuevo pedido</a>
            <a class="collapse-item" href="show-sales.php">Lista de pedidos</a>
        </div>
    </div>
</li>
<?php }?>

<?php if($typeUser === "Administrador") {?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-box-open"></i>
        <span>Gestión de Productos</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-product.php">Crear producto</a>
            <a class="collapse-item" href="show-products.php">Ver lista de productos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-user-friends"></i>
        <span>Gestión de Clientes</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-client.php">Registrar nuevo cliente</a>
            <a class="collapse-item" href="show-clients.php">Ver lista de clientes</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-user-tag"></i>
        <span>Roles de Usuario</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-rol.php">Crear nuevo rol usuario  </a>
            <a class="collapse-item" href="show-roles.php">Lista de roles de usuarios </a>
        </div>
    </div>
</li>
<?php }?>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>