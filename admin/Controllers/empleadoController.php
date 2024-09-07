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
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$telefono = isset($_POST['telefono']) ? ($_POST['telefono']) : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$salario = isset($_POST['salario']) ? str_replace(['$', ','], '', $_POST['salario']) : '';
$cargoId = isset($_POST['cargoId']) ? $_POST['cargoId'] : '';

$banderaGet = isset($_GET['bandera']) ? $_GET['bandera'] : '';

include_once('../../conf/conf.php');

$message = "";

if ($bandera == 1) {
    if (!is_numeric($salario)) {
        $_SESSION['error_message'] = "El salario debe ser numérico";
        $_SESSION['formData'] = [
            'action' => 'Agregar',
            'nombre' => $nombre,
            'telefono' => $telefono,
            'correo' => $correo,
            'salario' => $salario,
            'cargoId' => $cargoId,
        ];
        header("Location:../Empleados/formularioEmpleado.php");
        exit();
    }

    $query = "INSERT INTO Empleado (id, nombre, telefono, correo, salario, cargoId) VALUES (null, '$nombre', $telefono, '$correo', $salario, $cargoId)";

    $guardar = mysqli_query($conn, $query);

    if ($guardar) {
        $_SESSION['message_header'] = "Empleado Guardado";
        $_SESSION['message'] = "Empleado agregado correctamente";
        $_SESSION['message_type'] = "success";
        header("Location: ../Empleados/index.php");
    } else {
        $_SESSION['message_header'] = "Error al Guardar";
        $_SESSION['message'] = "No se pudo agregado el Empleado";
        $_SESSION['message_type'] = "danger";
        header("Location: ../Empleados/index.php");
    }
} else if ($bandera == 2) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if (!is_numeric($salario)) {
        $_SESSION['error_message'] = "El salario debe ser numérico";
        $_SESSION['formData'] = [
            'action' => 'Modificar',
            'id' => $id,
            'nombre' => $nombre,
            'telefono' => $telefono,
            'correo' => $correo,
            'salario' => $salario,
            'cargoId' => $cargoId,
        ];
        header("Location:../Empleados/formularioEmpleado.php");
        exit();
    } else {

        $query = "UPDATE Empleado SET nombre='$nombre', telefono=$telefono, correo='$correo', salario=$salario, cargoId=$cargoId WHERE id=$id";

        $actualizar = mysqli_query($conn, $query);

        if ($actualizar) {
            $_SESSION['message_header'] = "Empleado Actualizado";
            $_SESSION['message'] = "Empleado actualizado correctamente";
            $_SESSION['message_type'] = "";
            header("Location: ../Empleados/index.php");
        } else {
            $_SESSION['message_header'] = "Error al Actualizar";
            $_SESSION['message'] = "No se pudo actualizar el Empleado";
            $_SESSION['message_type'] = "danger";
            header("Location: ../Empleados/index.php");
        }
    }
} else if ($banderaGet == 3) {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $query = "DELETE FROM Empleado WHERE id=$id";

    $eliminar = mysqli_query($conn, $query);

    if ($eliminar) {
        $_SESSION['message_header'] = "Empleado Eliminado";
        $_SESSION['message'] = "Empleado eliminado correctamente";
        $_SESSION['message_type'] = "success";
        header("Location: ../Empleados/index.php");
    } else {
        $_SESSION['message_header'] = "Error al Eliminar";
        $_SESSION['message'] = "No se pudo eliminar el Empleado";
        $_SESSION['message_type'] = "danger";
        header("Location: ../Empleados/index.php");
    }
}

mysqli_close($conn);
