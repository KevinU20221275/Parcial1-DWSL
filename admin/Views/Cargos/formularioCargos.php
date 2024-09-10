<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../../../index.php");
    exit();
}

$id_get = isset($_GET['id']) ? $_GET['id'] : "";

$id = $id_get; // lo guardo aqui como $id porque es el parametro que resibe las funcion

$title = "Agregar Cargo";
$action = "Agregar";

if ($id != "") {
    require_once('../../Negocio/cargos.php');

    $cargo = new Cargo();
    
    $datos = $cargo->obtener_cargo_por_id($id);
    $nombre_cargo = $datos['nombreCargo'];
    $descripcion = $datos['descripcion'];

    $title = "Modificar Cargo";
    $action = "Modificar";
}

// esta variable es solo para cambiar la clase 'active' del sidebar
$route = 'cargos';
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
                <h2 class="text-white text-center pt-2">Detalles del Cargo</h2>
                <form action="../../Controllers/cargoController.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="bandera" value="<?php echo $action == 'Agregar' ? '1' : '2' ?>" hidden>
                    <?php if ($action == 'Modificar') {
                        echo '<input type="text" name="id" value="' . $id . '" hidden>';
                    } ?>
                    <div class="bg-secondary rounded p-4 pt-1  my-2 mx-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="nombreCargo" class="form-control" id="nombreCargo" value="<?php echo isset($nombre_cargo) ? $nombre_cargo : "" ?>" placeholder="Nombre del Cargo" required>
                            <label for="nombreCargo">Nombre del Cargo <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="descripcion" class="form-control" id="descripcion" value="<?php echo isset($descripcion) ? $descripcion : "" ?>" placeholder="Descripcion del Cargo" required>
                            <label for="salario">Descripcion del Cargo <span class="text-danger">*</span></label>
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../../../assets/js/main.js"></script>
</body>

</html>