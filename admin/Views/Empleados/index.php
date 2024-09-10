<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../../../index.php");
    exit();
}

$busqueda = isset($_POST['busqueda']) ? ($_POST['busqueda']) : null;

$route = 'empleados';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>

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

            <!-- Alert Message Start -->
            <?php include_once('../modules/alertMessage.php') ?>
            <!-- Alert Message End -->

            <!-- table employee Start -->
            <?php include_once('tablaEmpleados.php') ?>
            <!-- table employee End -->

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