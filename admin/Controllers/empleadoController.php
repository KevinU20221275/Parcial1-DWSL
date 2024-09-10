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

    $bandera = isset($_POST['bandera']) ? $_POST['bandera'] : "";
    
    if (!is_numeric($empleado->salario) || $empleado->salario <= 0) {
        $_SESSION['error_message'] = "El salario debe ser un número positivo";
        $_SESSION['formData'] = [
            'action' => $bandera == 1 ? 'Agregar' : 'Modificar',
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
    
    $result = $bandera == 1 ? $empleado->agregar() : $empleado->actualizar($id);

    if ($result) {
        $message_header = $bandera == 1 ? "Empleado Guardado" : "Empleado Actualizado";
        $message = $bandera == 1 ? "Empleado Agregado correctamente" : "Empleado Actualizado correctamente";
        set_message($message_header, $message, "success");
    } else {
        $error_header = $bandera == 1 ? "Error al Guardar" : "Error al Actualizar";
        $message = $bandera == 1 ? "No se puedo Agregar el Empleado" : "No se puedo Actualizar el Empleado";
        set_message($error_header, $message, "danger");
    }
    header("Location: ../Views/Empleados/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['bandera']) && $_GET['bandera'] == 3) {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($empleado->eliminar($id)) {
        set_message("Empleado Eliminado", "Empleado eliminado correctamente", "success");
    } else {
        set_message("Error al Eliminar", "No se pudo eliminar el Empleado", "danger");
    }
    header("Location: ../Views/Empleados/index.php");
    exit();
}



