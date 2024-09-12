<?php
$error = "";

require_once(__DIR__ . '/admin/Negocio/usuarios.php');
require_once('./conf/functions.php');

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = isset($_POST['user_name']) ? $_POST['user_name'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if (hasEmptyField([$nombre_usuario, $password])) {
        $erro = "Debe llenar todos los campos";
    } else {
        $datosUsuario = $usuario->get_usuario($nombre_usuario, $password);

        if (!empty($datosUsuario)) {
            session_start();
            $_SESSION['user'] = $datosUsuario['nombre'];
            $_SESSION['user_id'] = $datosUsuario['id'];
            $_SESSION['user_name'] = $datosUsuario['nombreUsuario'];
            header("Location: ./admin/index.php");
        } else {
            $error = "Contraseña o usuario incorrectos";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GTS - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <form action="index.php" method="post" style="max-width: 600px;" class="bg-secondary rounded">
                    <div class="p-4 pb-1 my-4 mb-2 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-solid fa-swatchbook me-2"></i>Global Tech Solutions</h3>
                            </a>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="user_name" class="form-control" id="floatingInput" placeholder="Nombre de Usuario">
                            <label for="floatingInput">Nombre de Usuario <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Contraseña" required>
                            <label for="floatingPassword">Contraseña <span class="text-danger">*</span></label>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Ingresar</button>
                        <p class="text-center mb-0">Olvidaste tu contraseña? <a href="#">Click aqui</a></p>
                        <p class="text-center text-danger mt-0"><?= $error ?></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>