<?php
session_start();
if ($_SESSION['user_name'] == "") {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>

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
                <a href="" class="navbar-brand mx-4 mb-3">
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
        <!-- Sidebar End -->


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

            <!-- Cards Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <a href="./Views/Empleados/index.php" class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-solid fa-user-group fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Empleados</p>
                                <h6 class="mb-0">Gestinar Empleados</h6>
                            </div>
                        </div>
                    </a>
                    <a href="./Views/Cargos/index.php" class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-briefcase fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cargos</p>
                                <h6 class="mb-0">Gestionar Cargos</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Cards End -->

        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Footer Start -->
    <?php include_once('./Views/modules/footer.php') ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>