<?php 
    include "./config/conexion.php";


    if(isset($_POST['save'])) {
        $dniProvider = $_POST['dni_provider'];
        $nameProvider = $_POST['name_provider'];
        $adressProvider = $_POST['adress'];
        $contactProvider = $_POST['contact'];
        $dateSave = $_POST['date'];
        $numberCel = $_POST['number_cel'];
        $rfcProvider = $_POST['rfc_provider'];
        $giroProvider = $_POST['giro_provider'];
        $statusProvider = $_POST['status_provider'];
        $codePostal = $_POST['code_postal'];
        $municipioProvider = $_POST['municipio_provider'];
        $emailProvider = $_POST['email_provider'];


        $search_dni = mysqli_query($conexion, "SELECT dni_provider FROM providers WHERE dni_provider='$dniProvider'");

        if(mysqli_num_rows($search_dni) > 0) {
            echo '<script language="javascript">';
            echo 'alert("El DNI que intenta registrar ya existe, verifique nuevamente para registrarlo correctamente...")';
            echo '</script>';
        } else {
            $query_save_provider = "INSERT INTO providers(dni_provider, name_provider, adress, contact, date, number_cel, rfc_provider, giro_provider, status_provider, code_postal, municipio_provider, email_provider) VALUES('$dniProvider', '$nameProvider', '$adressProvider', '$contactProvider', '$dateSave', '$numberCel', '$rfcProvider', '$giroProvider', '$statusProvider', '$codePostal', '$municipioProvider', '$emailProvider')";
            $result_query = mysqli_query($conexion, $query_save_provider);

            header("location: show-providers.php"); 
        }

    }
?>