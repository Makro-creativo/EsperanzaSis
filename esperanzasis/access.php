<?php 
    require "./config/conexion.php";

    // extrayendo los datos de la BD
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Consultas
    $query_user = "SELECT * FROM users WHERE user = '$user' AND pass = '$password'";
    $result = mysqli_query($conexion, $query_user);

    // Preguntando si hay algún usario registrado en la BD
    if(mysqli_num_rows($result) > 0) { 
        $row = mysqli_fetch_array($result);
        $profile = $row['tipo'];

        //Varaibles de Sesión
        $_SESSION['name'] = $row['name'];
        $_SESSION['user'] = $user;
        $_SESSION['Tipo'] = $row['tipo'];
        $_SESSION['UID'] = $row['id'];

        // Redireccionar según el tipo de usuario
        if($profile == "Client") {
            echo "<script>window.location='DashboardClient.php'; </script>";
        } else  if($profile == "Administrador") {
            echo "<script>window.location='DashboardAdmin.php'; </script>";
        } else {
            echo "<script>window.location='login.php?error'; </script>";
        }
    } else {
        echo "<script>window.location='login.php?error'; </script>";
    }

?>