 <?php 
    error_reporting(0);
    session_start();

    $name = $_SESSION['name'];
    $typeUser = $_SESSION['Tipo'];
    $id_user = $_SESSION['id_user'];
 ?>

 <!-- Sidebar -->
 <ul class="navbar-nav bg-green sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<?php if($typeUser === "SuperAdmin") {?>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardSuperAdmin.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo la esperanza" class="img-fluid" style="width: 150px; height: 150px;">
    </div>
    <div class="sidebar-brand-text mx-3">EsperanzaSis</div>
</a>
<?php }?>

<?php if($typeUser === "Cliente") {?>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardCliente.php">
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

<?php if($typeUser === "Repartidor") {?>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardRepartidor.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo la esperanza" class="img-fluid" style="width: 150px; height: 150px;">
    </div>
    <div class="sidebar-brand-text mx-3">EsperanzaSis</div>
</a>
<?php }?>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<?php if($typeUser === "SuperAdmin") {?>
<li class="nav-item active">
    <a class="nav-link" href="DashboardSuperAdmin.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Panel de Control</span></a>
</li>
<?php }?>

<?php if($typeUser === "Cliente") {?>
<li class="nav-item active">
    <a class="nav-link" href="DashboardCliente.php">
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

<?php if($typeUser === "Repartidor") {?>
<li class="nav-item active">
    <a class="nav-link" href="DashboardRepartidor.php">
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

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<?php if($typeUser === "Cliente") {?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-truck"></i>
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

<?php if($typeUser === "Repartidor") {?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-truck"></i>
        <span>Gestión de Pedidos</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="show-all-orders.php">Lista de pedidos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordersAdmin"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-cart-flatbed"></i>
        <span>Pedidos Admin</span>
    </a>
    <div id="ordersAdmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="show-all-orders-admin.php">Lista de pedidos admin</a>
        </div>
    </div>
</li>
<?php }?>

<?php if($typeUser === "Administrador") {?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-truck"></i>
        <span>Gestión de Pedidos</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="show-all-orders.php">Lista de pedidos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordersAdmin"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-cart-flatbed"></i>
        <span>Pedidos Admin</span>
    </a>
    <div id="ordersAdmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-order-admin.php">Crear un nuevo pedido</a>
            <a class="collapse-item" href="show-all-orders-admin.php">Lista de mis pedidos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#delivery-man"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-bicycle"></i>
        <span>Gestión de repartidores</span>
    </a>
    <div id="delivery-man" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-delivery-man.php">Crear nuevo repartidor</a>
            <a class="collapse-item" href="show-deliveries-man.php">Repartidores</a>
        </div>
    </div>
</li>
<?php }?>


<?php if($typeUser === "Administrador") {?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-box-open"></i>
        <span>Gestión de Productos</span>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
            <a class="collapse-item" href="show-roles.php">Roles de usuarios</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-tags"></i>
        <span>Gestión de descuentos</span>
    </a>
    <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-promotion.php">Crear nuevo descuento</a>
            <a class="collapse-item" href="show-promotions.php">Lista de descuentos</a>
        </div>
    </div>
</li>

<!--<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Gestión de facturación</span>
    </a>
    <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-invoice.php">Crear nueva factura</a>
            <a class="collapse-item" href="show-invoices.php">Lista de facturas</a>
            <a class="collapse-item" href="invoices-receivable.php">Facturas por Cobrar</a>
            <a class="collapse-item" href="bills-paid.php">Facturas Pagadas</a>
        </div>
    </div>
</li>-->

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-list"></i>
        <span>Categorias de gastos</span>
    </a>
    <div id="collapseNine" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-categories.php">Crear nueva categoría</a>
            <a class="collapse-item" href="show-categories.php">Lista de categorias</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-list"></i>
        <span>Categorias de ingresos</span>
    </a>
    <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-categories-income.php">Crear nueva categoría</a>
            <a class="collapse-item" href="show-categories-income.php">Lista de categorias</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFeenten"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-wallet"></i>
        <span>Gestión proveedor</span>
    </a>
    <div id="collapseFeenten" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-bills-to-pay.php">Crear factura</a>
            <a class="collapse-item" href="show-providers.php">Lista de proveedores</a>
        </div>
    </div>
</li>

<!--<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeventen"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-user-tag"></i>
        <span>Gestión de proveedores</span>
    </a>
    <div id="collapseSeventen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-provider.php">Crear proveedor</a>
            <a class="collapse-item" href="show-providers.php">Lista de proveedores</a>
        </div>
    </div>
</li> -->

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleven"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-money-check-alt"></i>
        <span>Gastos</span>
    </a>
    <div id="collapseEleven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-expense.php">Crear nuevo gasto</a>
            <a class="collapse-item" href="show-expenses.php">Lista de gastos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwelven"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-hand-holding-usd"></i>
        <span>Ingresos</span>
    </a>
    <div id="collapseTwelven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-income.php">Crear nuevo ingreso</a>
            <a class="collapse-item" href="show-incomes.php">Lista de ingresos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cutBox"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-cash-register"></i>
        <span>Corte de Caja</span>
    </a>
    <div id="cutBox" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-cut-box.php">Super</a>
            <a href="show-cut-box.php" class="collapse-item">Lista corte de super</a>
            <a class="collapse-item" href="new-cut-box-repartidores.php">Repartidores</a>
            <a class="collapse-item" href="show-cut-box-repartidores.php">Lista de corte repartidores</a>
            <a class="collapse-item" href="total-cut-day-super.php">Total de día súper</a>
            <a class="collapse-item" href="total-cut-day-repartidores.php">Total de día repartidores</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCobranza"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-money-check-dollar"></i>
        <span>Cobranza</span>
    </a>
    <div id="collapseCobranza" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-cobranza.php">Registrar cobranza</a>
            <a class="collapse-item" href="show-cobranza.php">Lista de cobranza</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#invoice_or_providers"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-folder-open"></i>
        <span>Facturas y Proveedores</span>
    </a>
    <div id="invoice_or_providers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-provider-or-client.php">Capturar factura</a>
            <a class="collapse-item" href="show-bills-to-pay.php">Facturas proveedores</a>
            <a class="collapse-item" href="bills-to-paid.php">Facturas pagadas</a>
            <a class="collapse-item" href="bills-not-to-paid.php">Facturas por pagar</a>

            <hr>
            <a class="collapse-item" href="show-invoices.php">Facturas clientes</a>
            <a class="collapse-item" href="invoices-receivable.php">Facturas por Cobrar</a>
            <a class="collapse-item" href="bills-paid.php">Facturas Pagadas</a>
        </div>
    </div>
</li>

<?php }?>

<?php if($typeUser === "SuperAdmin") {?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user-tag"></i>
            <span>Roles de Usuario</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="new-admin.php">Registrar nuevo Admin</a>
                <a class="collapse-item" href="show-admin.php">Roles de admin</a>
                <a class="collapse-item" href="show-roles.php">Roles de usuario</a>
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