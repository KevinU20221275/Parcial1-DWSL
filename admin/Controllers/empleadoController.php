<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../../index.php");
    exit();
}

require_once('../Negocio/empleados.php');
require_once('../../conf/functions.php');

$empleado = new Empleado();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empleado->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $empleado->telefono = isset($_POST['telefono']) ? ($_POST['telefono']) : '';
    $empleado->correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $empleado->salario = isset($_POST['salario']) ? str_replace(['$', ','], '', $_POST['salario']) : '';
    $empleado->cargo_id = isset($_POST['cargoId']) ? $_POST['cargoId'] : '';

    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $action = isset($_POST['action']) ? $_POST['action'] : "";

    if (hasEmptyField([$empleado->nombre,$empleado->telefono, $empleado->correo,$empleado->salario, $empleado->cargo_id])) {
        $_SESSION['empty_field_error'] = "Debe llenar todos los campos";
        $_SESSION['formData'] = [
            'action' => $action,
            'id' => $id,
            'nombre' => $empleado->nombre,
            'telefono' => $empleado->telefono,
            'correo' => $empleado->correo,
            'salario' => $empleado->salario,
            'cargoId' => $empleado->cargo_id,
        ];
        header("Location: ../Views/Empleados/formularioEmpleado.php");
        exit();
    }
    
    if (!is_numeric($empleado->salario) || $empleado->salario <= 0) {
        $_SESSION['error_message'] = "El salario debe ser un número positivo";
        $_SESSION['formData'] = [
            'action' => $action,
            'id' => $id,
            'nombre' => $empleado->nombre,
            'telefono' => $empleado->telefono,
            'correo' => $empleado->correo,
            'salario' => $empleado->salario,
            'cargoId' => $empleado->cargo_id,
        ];
        header("Location: ../Views/Empleados/formularioEmpleado.php");
        exit();
    }
    
    $result = $action == "Agregar" ? $empleado->agregar() : $empleado->actualizar($id);

    if ($result) {
        $action_message = $action == "Agregar" ? "Agregado" : "Actualizado";
        set_message("Empleado $action_message", "Empleado $action_message correctamente", "success");
    } else {
        set_message("Error al $action", "No se pudo $action el Empleado", "danger");
    }
    header("Location: ../Views/Empleados/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'Eliminar') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($empleado->eliminar($id)) {
        set_message("Empleado Eliminado", "Empleado eliminado correctamente", "success");
    } else {
        set_message("Error al Eliminar", "No se pudo eliminar el Empleado", "danger");
    }
    header("Location: ../Views/Empleados/index.php");
    exit();
}



