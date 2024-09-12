<?php
include_once('../../Negocio/empleados.php');
$empleados = new Empleado();

if ($busqueda != NULL) {
    $result = $empleados->buscar_empleado($busqueda);
} else {
    $result = $empleados->listar_empleados();
}

?>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="container-fluid">
            <h6 class="mb-0">Registro de Empleados</h6>
            <div class="d-flex flex-column flex-sm-row gap-2 align-items-center justify-content-between mb-3 p-3">
                <a href="formularioEmpleado.php" class="btn btn-success btn-sm">
                    Agregar empleado <i class="fa-regular fa-square-plus"></i>
                </a>
                <div class="d-flex flex-column flex-sm-row gap-2 align-items-center">
                    <form action="index.php" method="post" class="d-flex ms-4">
                        <input class="form-control bg-dark border-0" type="search" name="busqueda" placeholder="Search" value="<?php echo $busqueda ?>">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-primary">
                    </form>
                    <a href="" class="btn btn-outline-primary btn-sm">Mostrar Todos</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Salario</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($result)) {
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['telefono'] . "</td>";
                            echo "<td>" . $row['correo'] . "</td>";
                            echo "<td>" . $row['salario'] . "</td>";
                            echo "<td>". $row['nombreCargo']. "</td>";
                            echo "<td>
                                        <a href='formularioEmpleado.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'><i class='fa-solid fa-pen-to-square'></i></a>
                                        <a href='../../Controllers/empleadoController.php?id=" . $row['id'] . "&action=Eliminar' class='btn btn-sm btn-primary'><i class='fa-solid fa-trash'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="7">Sin resultados</td>';
                        echo '</tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>