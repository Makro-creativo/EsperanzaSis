<?php 
    error_reporting(0);
    session_start();

    $typeUser = $_SESSION['Tipo'];

    include "./config/conexion.php";

    if(isset($_POST['sendOrder'])) {
        $product_name = $_POST['name_product'];
        $client_name = $_POST['name_client'];
        $address_send = $_POST['address_send'];
        $quantity_product = $_POST['quantity_product'];
        $date_send = $_POST['date_send'];
        $hour_send = $_POST['hour_send'];
        $people_order = $_POST['people_order'];

        $query = "INSERT INTO 
        orders(product_name, client_name, address_send, quantity_product, date_send, hour_send, people_order)
        VALUES ('$product_name', '$client_name', '$address_send', '$quantity_product', '$date_send', '$hour_send', '$people_order')";

        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se pudo enviar el pedido, verifique que sus datos sean correctos...");
        }

        header("location: new-order.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg"> 
    <title>EsperazaSis</title>

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
        <!-- Menu lateral -->
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Navigation -->
                <?php include "./partials/header.php" ?>

                <!-- Content main -->
                <div class="d-flex justify-content-around align-items-center my-5">
                <?php if($typeUser === "Client") {?>
                    <h2 class="text-dark">Nuevo pedido</h2>

                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-order">
                        Hacer un pedido
                        <i class="fas fa-plus-square mr-2"></i>
                    </button>
                <?php }?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Selecciona tu producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="new-order.php" method="POST">
                                    <select class="form-select" name="status" id="status" onChange="show(this.value);">
                                        <option selected disabled>---- Selecciona un Producto ---</option>
                                        <option value="totopos">Totopos especial para Chilaquiles</option>
                                        <option value="tortillas_de_maiz">Tortilla de Maíz</option>
                                        <option value="tortilla_de_harina">Tortilla de Harina</option>
                                        <option value="tortilla_artesanal">Tortilla Artesanal</option>
                                        <option value="masa">Masa</option>
                                        <option value="masa_azul">Masa Azul</option>
                                        <option value="tortilla_para_taco">Tortilla para Taco</option>
                                        <option value="tortilla_para_flauta">Tortilla para Flauta</option>
                                        <option value="huarache">Huarache</option>
                                        <option value="sopes">Sopes</option>
                                        <option value="mini_bolillo">Mini Bolillo (Fleima)</option>
                                        <option value="bolillo">Bolillo (Fleima)</option>
                                        <option value="bolillo_mini_salado">Bolillo mini Salado</option>
                                        <option value="bolillo_salado">Bolillo Salado</option>
                                        <option value="tostada">Tostada</option>
                                    </select>

                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="Agregar Producto" class="btn btn-dark mt-3">
                                    </div>
                                </form>

                                <div id="totopos" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envió..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envió..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="tortillas_de_maiz" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php   
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envió..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envió..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="tortilla_de_harina" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envió..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envió..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="tortilla_artesanal" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="masa" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="masa_azul" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="tortilla_para_taco" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="tortilla__para_flauta" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="huarache" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envip" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="sopes" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="mini_bolillo" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="bolillo" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>


                                <div id="bolillo_mii_salado" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="bolillo_salado" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                                <div id="tostada" style="display: none;" class="mt-4">
                                <h2 class="d-flex justify-content-start mt-3">Crear pedido</h2>
                                    <form action="new-order.php" method="POST">
                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM products");
                                            ?>
                                            <label>Selecciona el producto: </label>
                                            <select name="name_product" name="tipo" require class="form-select">
                                                <option selected disabled value="">Selecciona el producto</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_product = $row['name_product'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_product; ?>"><?php echo $name_product; ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = mysqli_query($conexion, "SELECT * FROM clients");
                                            ?>
                                            <label>Seleccionar cliente: </label>
                                            <select name="name_client" name="tipo" require class="form-select">
                                                <option selected disabled>Seleccionar cliente</option>
                                                <?php 
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $name_client = $row['name_client'];
                                                    }
                                                ?>
                                                <option value="<?php echo $name_client; ?>"><?php echo $name_client; ?><?php echo $row['quantity'] ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dirección de envio: </label>
                                            <input name="address_send" type="text" placeholder="Dirección de envio" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Cantidad de envio: </label>
                                            <input name="quantity_product" type="text" placeholder="Ejemplo: 2 bollilos, etc" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Fecha de envio: </label>
                                            <input name="date_send" type="date" placeholder="Fecha de envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora de entrega: </label>
                                            <input name="hour_send" type="time" placeholder="Selecciona horario para tu envio..." class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre a quien va el pedido: </label>
                                            <input name="people_order" type="text" placeholder="Nombre completo de la persona a quien va el pedido..." class="form-control">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="sendOrder">
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <div class="container">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xx-12 mx-auto">
                            <div class="card shadow-lg mb-4">
                                <h3 class="d-flex justify-content-start mr-3 p-2 text-dark">últimos pedidos realizados</h3>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Producto</th>
                                                    <th>Cliente</th>
                                                    <th>Dirección de envio</th>
                                                    <th>Cantidad de envio</th>
                                                    <th>Fecha de envio</th>
                                                    <th>Hora de entrega</th>
                                                    <th>Recibe</th>

                                                    <th>Pedido</th>
                                                    

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Editar</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Eliminar</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $query = "SELECT * FROM orders ORDER BY id ASC";
                                                    $result = mysqli_query($conexion, $query);

                                                    while($row = mysqli_fetch_array($result)) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['client_name']; ?></td>
                                                    <td><?php echo $row['address_send']; ?></td>
                                                    <td><?php echo $row['quantity_product']; ?></td>
                                                    <td><?php echo $row['date_send']; ?></td>
                                                    <td><?php echo $row['hour_send']; ?></td>
                                                    <td><?php echo $row['people_order']; ?></td>

                                
                                                        <td>
                                                            <a href="show-order.php?id=<?php echo $row['id']; ?>" class="btn btn-dark">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                   
                                                    
                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="edit-order.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="delete-order.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>
                                                </tr>

                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Footer -->
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
    <script>
        function show(id) {
            if(id === "totopos") {
                $("#totopos").show();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#tortilla_artesanl").hide();
                $("#masa").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "tortillas_de_maiz") {
                $("#totopos").hide();
                $("#tortillas_de_maiz").show();
                $("#tortilla_de_harina").hide();
                $("#tortilla_artesanl").hide();
                $("#masa").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "tortilla_de_harina") {
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").show();
                $("#totopos").hide();
                $("#tortilla_artesanl").hide();
                $("#masa").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "tortilla_artesanal") {
                $("#tortilla_de_harina").hide();
                $("#tortilla_artesanal").show();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "masa") {
                $("#tortilla_artesanal").hide();
                $("#masa").show();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "masa_azul") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").show();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "tortilla_para_taco") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").show();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "tortilla_para_flauta") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").show();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "huarache") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").show();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "sopes") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").show();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "mini_bolillo") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").show();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "bolillo") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").show();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "bolillo_mini_salado") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").show();
                $("#bolillo_salado").hide();
                $("#tostada").hide();
            }

            if(id === "bolillo_salado") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").show();
                $("#tostada").hide();
            }

            if(id === "tostada") {
                $("#tortilla_artesanal").hide();
                $("#masa").hide();
                $("#tortilla_de_harina").hide();
                $("#tortillas_de_maiz").hide();
                $("#tortilla_de_harina").hide();
                $("#totopos").hide();
                $("#masa_azul").hide();
                $("#tortilla_para_taco").hide();
                $("#tortilla_para_flauta").hide();
                $("#huarache").hide();
                $("#sopes").hide();
                $("#mini_bolillo").hide();
                $("#bolillo").hide();
                $("#bolillo_mini_salado").hide();
                $("#bolillo_salado").hide();
                $("#tostada").show();
            }

        }
    </script>
</body>
</html>