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
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if (hasEmptyField([$cargo->nombre_cargo, $cargo->descripcion])){
        $_SESSION['empty_field_error'] = "Debe llenar todos los campos";
        $_SESSION['formData'] = [
            'action' => $action,
            'id' => $id,
            'nombreCargo' => $cargo->nombre_cargo,
            'descripcion' => $cargo->descripcion,
        ];
        header("Location: ../Views/Cargos/formularioCargos.php");
        exit();
    }

    $result = $action == "Agregar" ? $cargo->agregar() : $cargo->actualizar($id);

    if ($result) {
        $action_message = $action == "Agregar" ? "Agregado" : "Actualizado";
        set_message("Cargo $action_message", "Cargo $action_message correctamente", "success");
    } else {
        set_message("Error al $action" , "No se pudo $action el Cargo", "danger");
    }
    header("Location: ../Views/Cargos/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'Eliminar') {
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
