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

    if (!isset($_POST["name_product"])) {
        return;
    }
    
    $description = $_POST["name_product"];
    $sentencia = $base_de_datos->prepare("SELECT * FROM products WHERE name_product = ? LIMIT 1");
    $sentencia->execute([$description]);
    $producto = $sentencia->fetch(PDO::FETCH_OBJ);
    # Si no existe, salimos y lo indicamos
    if (!$producto) {
        header("Location: new-orders-admin-test.php");
        exit;
    }

    session_start();
    # Buscar producto dentro del cartito
    $indice = false;
    for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
        if ($_SESSION["carrito"][$i]->name_product === $description) {
            $indice = $i;
            break;
        }
    }
    # Si no existe, lo agregamos como nuevo
    if ($indice === false) {
        $producto->quantity = 1;
        $producto->total = $producto->price;
        array_push($_SESSION["carrito"], $producto);
    } else {
        # Si ya existe, se agrega la cantidad
        # Pero espera, tal vez ya no haya
        $cantidadExistente = $_SESSION["carrito"][$indice]->quantity;
        # si al sumarle uno supera lo que existe, no se agrega
        
        $_SESSION["carrito"][$indice]->quantity++;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->quantity * $_SESSION["carrito"][$indice]->price;
    }
    header("Location: new-orders-admin-test.php");
?>