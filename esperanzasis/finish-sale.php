<?php 
     $contraseña = "";
     $usuario = "root";
     $nombre_base_de_datos = "esperanza";
 
     try{
         $base_de_datos = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
         $base_de_datos->query("set names utf8;");
         $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
         $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
     }catch(Exception $e){
         echo "Ocurrió algo con la base de datos: " . $e->getMessage();
     }

    if(!isset($_POST["total"])) exit;


    session_start();
    
    
    $total = $_POST["total"];
    $nameOrder = $_POST['name_order'];
    
    
    $ahora = date("Y-m-d H:i:s");
    
    
    $sentencia = $base_de_datos->prepare("INSERT INTO sales(date, total) VALUES (?, ?);");
    $sentencia->execute([$ahora, $total]);
    
    $sentencia = $base_de_datos->prepare("SELECT id FROM sales ORDER BY id DESC LIMIT 1;");
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
    
    $idVenta = $resultado === false ? 1 : $resultado->id;
    
    $base_de_datos->beginTransaction();
    $sentencia = $base_de_datos->prepare("INSERT INTO products_sale(id_product, id_sale, quantity, name_order) VALUES (?, ?, ?, ?)");
    $sentenciaExistencia = $base_de_datos->prepare("UPDATE products SET name_product = name_product - ? WHERE productid = ?;");

    foreach ($_SESSION["carrito"] as $producto) {
        $total += $producto->total;
        $sentencia->execute([$producto->id, $idVenta, $producto->quantity, $producto->name_order]);
        $sentenciaExistencia->execute([$producto->quantity, $producto->id, $producto->name_order]);
    }
    $base_de_datos->commit();
    unset($_SESSION["carrito"]);
    $_SESSION["carrito"] = [];
    header("Location: show-orders-admin-test.php");
?>