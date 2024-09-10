<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="../../index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-solid fa-swatchbook me-2"></i>GTS</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="../../../assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $_SESSION['user_name'] ?></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="../../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="../Empleados/index.php" class="nav-item nav-link <?php echo $route == 'empleados' ? 'active' : ""  ?> "> <i class="fa fa-solid fa-user-group me-2"></i>Empleados</a>
            <a href="../Cargos/index.php" class="nav-item nav-link <?php echo $route == 'cargos' ? 'active' : ""  ?> "><i class="fa fa-briefcase fa-1x me-2"></i>Cargos</a>
        </div>
    </nav>
</div>