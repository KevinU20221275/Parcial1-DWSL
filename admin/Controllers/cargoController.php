<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../../index.php");
    exit();
}

require_once('../Negocio/cargos.php');
require_once('../../conf/functions.php');

$cargo = new Cargo();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cargo->nombre_cargo = isset($_POST['nombreCargo']) ? $_POST['nombreCargo'] : '';
    $cargo->descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $bandera = isset($_POST['bandera']) ? $_POST['bandera'] : '';

    $result = $bandera == 1 ? $cargo->agregar() : $cargo->actualizar($id);

    if ($result) {
        $message_header = $bandera == 1 ? "Cargo Guardado" : "Cargo Actualizado";
        $message = $bandera == 1 ? "Cargo Agregado correctamente" : "Cargo Actualizado correctamente";
        set_message($message_header, $message, "success");
    } else {
        $error_header = $bandera == 1 ? "Error al Guardar" : "Error al Actualizar";
        $message = $bandera == 1 ? "No se puedo Agregar el Cargo" : "No se puedo Actualizar el Cargo";
        set_message($error_header, $message, "danger");
    }
    header("Location: ../Views/Cargos/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['bandera']) && $_GET['bandera'] == 3) {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($cargo->eliminar($id)) {
        set_message("Cargo Eliminado", "Cargo eliminado correctamente", "success");
    } else {
        set_message("Error al Eliminar", "No se pudo eliminar el Cargo", "danger");
    }
    header("Location: ../Views/Cargos/index.php");
    exit();
}

?>
