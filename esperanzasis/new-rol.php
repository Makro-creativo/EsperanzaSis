<?php 
    include "./config/conexion.php";


    if(isset($_POST['saveRol'])) {
        $info_client = $_POST['info_client'];
        $array = explode("_", $info_client);
        $idClient = $array[0];
        $nameClient = $array[1];


        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $tipo = $_POST['tipo'];
        
        $query_user = "INSERT INTO users(id_user, name, user, pass, tipo) VALUES('$idClient','$nameClient', '$user', '$pass', '$tipo')";
        //$query = "INSERT INTO users(name, user, pass, tipo) VALUES('$name', '$user', '$pass', '$tipo')";
        $result = mysqli_query($conexion, $query_user);

        if(!$result) {
            die("No se pudo registrar el usuario, verifica de nuevo por favor...");
        }

        header("location: show-roles.php");
    }

?>