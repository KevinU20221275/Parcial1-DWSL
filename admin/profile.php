<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../index.php");
    exit();
}
require_once('../conf/functions.php');
require_once('./Negocio/usuarios.php');
$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $usuario->nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : "";
    $usuario->password = isset($_POST['password']) ? $_POST['password'] : "";

    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $re_password = isset($_POST['re_password']) ? $_POST['re_password'] : "";

    if ($re_password != $usuario->password){
        $_SESSION['error_message'] = "Las contraseñas no coinciden";
    } else {
        if ($usuario->update($id)) {
            set_message("Perfil Actualizado","Se actualizaron tus datos correctamente", "success");
    
            $_SESSION['user'] = $_POST['nombre'];
            $_SESSION['user_name'] = $_POST['nombreUsuario'];
        } else {
            set_message("Error al Actualizar","No se pudo actualizar tus datos","danger");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>

    <!-- Favicon -->
    <link href="./img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">


    <!-- Icon Font Stylesheet -->
    <script src="https://kit.fontawesome.com/3fb00ab759.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <?php include_once('./modules/spinner.php') ?>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-solid fa-swatchbook me-2"></i>GTS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['user_name'] ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="./Views/Empleados/index.php" class="nav-item nav-link"> <i class="fa fa-solid fa-user-group me-2"></i>Empleados</a>
                    <a href="./Views/Cargos/index.php" class="nav-item nav-link"><i class="fa fa-briefcase fa-1x me-2"></i>Cargos</a>
                </div>
            </nav>
        </div>

        <!-- Content Start -->
        <div class="content">

            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-solid fa-swatchbook"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['user_name'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.php" class="dropdown-item">Mi Perfil</a>
                            <a href="logOut.php" class="dropdown-item">Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Alert Message Start -->
            <?php include_once('./Views/modules/alertMessage.php') ?>
            <!-- Alert Message End -->

            <div class="container bg-secondary mt-4 rounded" style="max-width: 600px;">
                <h2 class="text-white text-center pt-2">Perfil</h2>
                <div class='ms-2 rounded mt-2 p-2 bg-secondary mx-3 w-full text-center'>
                    <img class="mb-2" src="../assets/img/user.jpg" alt="" style="width: 50px; border-radius:100% !important;">
                    <h6 class='fw-normal mb-2'>Nombre: <small class="text-warning"><?= $_SESSION['user'] ?></small> </h6>
                    <h6 class="fw-normal mb-2">Nombre de Usuario: <small class="text-warning"><?= $_SESSION['user_name'] ?> </small></h6>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Modificar
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-secondary">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Editar Datos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="text" name="id" value="<?= $_SESSION['user_id'] ?>" hidden>
                                <div class="bg-secondary rounded p-4 pt-1  my-2 mx-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'] : "" ?>" placeholder="Nombre" required>
                                        <label for="nombre">Nuevo Nombre <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nombreUsuario" class="form-control" id="nombreUsuario" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "" ?>" placeholder="Telefono" required>
                                        <label for="nombreUsuario">Nuevo Nombre de Usuario <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password" class="form-control" id="password" value="" placeholder="Password" required>
                                        <label for="password">Nueva Contraseña <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="re_password" class="form-control" id="re_password" value="" placeholder="Confirmar Password" required>
                                        <label for="re_password">Confirmar Nueva Contraseña <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <span class="text-danger">
                                            <?php
                                            echo $_SESSION['error_message'];
                                            unset($_SESSION['error_message']);
                                            ?>
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary py-3 w-50  mb-0">Modificar</button>
                                        <a href="index.php" class="btn btn-light py-3 w-50 mb-0">Volver</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Footer Start -->
    <?php include_once('./Views/modules/footer.php') ?>
    <!-- Footer End -->

    x

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>