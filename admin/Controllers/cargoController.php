<?php
session_start();
if ($_SESSION['usuario'] == "") {
    header("Location: ../../index.php");
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bandera = isset($_POST['bandera']) ? $_POST['bandera'] : "";
$nombre_cargo = isset($_POST['nombreCargo']) ? $_POST['nombreCargo'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

$banderaGet = isset($_GET['bandera']) ? $_GET['bandera'] : '';

include_once('../../conf/conf.php');

$message = "";

if ($bandera == 1){
    echo "si";
    $query = "INSERT INTO Cargo (id, nombreCargo, descripcion) VALUES (null, '$nombre_cargo', '$descripcion')";

    $guardar = mysqli_query($conn, $query);

    if ($guardar) {
        $_SESSION['message_header'] = "Cargo Guardado";
        $_SESSION['message'] = "Cargo agregado correctamente";
        $_SESSION['message_type'] = "success";
        header("Location: ../Cargos/index.php");
    } else {
        $_SESSION['message_header'] = "Error al Guardar";
        $_SESSION['message'] = "No se pudo agregado el Cargo";
        $_SESSION['message_type'] = "danger";
        header("Location: ../Cargos/index.php");
    }
} else if ($bandera == 2){
    $id = isset($_POST['id'])? $_POST['id'] : '';
    $query = "UPDATE Cargo SET nombreCargo='$nombre_cargo', descripcion='$descripcion' WHERE id=$id";

    $actualizar = mysqli_query($conn, $query);

    if ($actualizar){
        $_SESSION['message_header'] = "Cargo Actualizado";
        $_SESSION['message'] = "Cargo actualizado correctamente";
        $_SESSION['message_type'] = "";
        header("Location: ../Cargos/index.php");
    } else {
        $_SESSION['message_header'] = "Error al Actualizar";
        $_SESSION['message'] = "No se pudo actualizar el Cargo";
        $_SESSION['message_type'] = "danger";
        header("Location: ../Cargos/index.php");
    }
} else if ($banderaGet == 3){
    $id = isset($_GET['id'])? $_GET['id'] : '';
    $query = "DELETE FROM Cargo WHERE id=$id";

    $eliminar = mysqli_query($conn, $query);

    if ($eliminar){
        $_SESSION['message_header'] = "Cargo Eliminado";
        $_SESSION['message'] = "Cargo eliminado correctamente";
        $_SESSION['message_type'] = "success";
        header("Location: ../Cargos/index.php");
    } else {
        $_SESSION['message_header'] = "Error al Eliminar";
        $_SESSION['message'] = "No se pudo eliminar el Cargo";
        $_SESSION['message_type'] = "danger";
        header("Location: ../Cargos/index.php");
    }
}

mysqli_close($conn);
?>