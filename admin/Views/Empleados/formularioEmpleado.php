<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../../../index.php");
    exit();
}

require_once('../../Negocio/cargos.php');
$cargo = new Cargo();
$cargos = $cargo->listar_cargos();

$idGet = isset($_GET['id']) ? $_GET['id'] : "";

$id = $idGet; // lo guardo aqui como $id porque es el parametro que resibe la funcion

$action = "Agregar";
$title = "Agregar Empleado";

if ($id != "") {
    require_once('../../Negocio/empleados.php');

    $empleado = new Empleado();
    
    $datos = $empleado->obtener_empleado_por_id($id);

    $nombre = $datos['nombre'];
    $telefono = $datos['telefono'];
    $correo = $datos['correo'];
    $salario = $datos['salario'];
    $cargoId = $datos['cargoId'];

    $title = "Modificar Empleado";
    $action = "Modificar";
    
} else if (isset($_SESSION['formData'])) {
    $id = $_SESSION['formData']['id'];
    $nombre = $_SESSION['formData']['nombre'];
    $telefono = $_SESSION['formData']['telefono'];
    $correo = $_SESSION['formData']['correo'];
    $salario = $_SESSION['formData']['salario'];
    $cargoId = $_SESSION['formData']['cargoId'];
    $action = $_SESSION['formData']['action'];

    $title = $action == "Agregar" ? "Agregar Empleado" : "Modificar Empleado";

    $_SESSION['formData'] = null;
    unset($_SESSION['formData']);
}

// esta variable solo sirver para cambiar la clase 'active' del sidebar
$route = 'empleados';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Favicon -->
    <link href="./img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">


    <!-- Icon Font Stylesheet -->
    <script src="https://kit.fontawesome.com/3fb00ab759.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../assets/css/style.css">

    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <?php include_once('../modules/spinner.php') ?>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php include_once('../modules/sidebar.php') ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">

            <!-- Navbar Start -->
            <?php include_once('../modules/navbar.php') ?>
            <!-- Navbar End -->

            <div class="container bg-secondary mt-4 rounded" style="max-width: 600px;">
                <h2 class="text-white text-center pt-2">Datos del Empleado</h2>
                <form action="../../Controllers/empleadoController.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="bandera" value="<?php echo $action == 'Agregar' ? '1' : '2' ?>" hidden>
                    <?php if ($action == 'Modificar') {
                        echo '<input type="text" name="id" value="' . $id . '" hidden>';
                    } ?>
                    <div class="bg-secondary rounded p-4 pt-1  my-2 mx-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo isset($nombre) ? $nombre : "" ?>" placeholder="Nombre" required>
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="telefono" class="form-control" id="telefono" value="<?php echo isset($telefono) ? $telefono : "" ?>" placeholder="Telefono" required>
                            <label for="telefono">Telefono <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="correo" class="form-control" id="email" value="<?php echo isset($correo) ? $correo : "" ?>" placeholder="Email" required>
                            <label for="email">Email <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="salario" class="form-control" id="salario" value="<?php echo isset($salario) ? $salario : "" ?>" placeholder="Salario" required>
                            <label for="salario">Salario <span class="text-danger">*</span></label>
                            <span class="text-danger">
                            <?php
                                echo $_SESSION['error_message'];
                                unset($_SESSION['error_message']);
                            ?>
                            </span>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="cargoId" id="cargoId" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($cargos as $cargo) {
                                    if (isset($cargoId) && $cargo['id'] == $cargoId) {
                                ?>
                                        <option selected value='<?= $cargo['id'] ?>'><?= $cargo['nombreCargo'] ?></option>";
                                    <?php } else { ?>
                                        <option value='<?= $cargo['id'] ?>'> <?= $cargo['nombreCargo'] ?></option>";
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <label for="puestoId">Cargo <span class="text-danger">*</span></label>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary py-3 w-50  mb-0"><?= $action ?></button>
                            <a href="./index.php" class="btn btn-light py-3 w-50 mb-0">Volver</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Footer Start -->
    <?php include_once('../modules/footer.php') ?>
    <!-- Footer End -->

    x

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../../../assets/js/main.js"></script>
</body>

</html>