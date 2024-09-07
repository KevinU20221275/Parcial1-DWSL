<?php
if ($busqueda != NULL) {
    $query = "SELECT Empleado.id, nombre, telefono, correo, salario, nombreCargo 
                FROM Empleado INNER JOIN Cargo
                ON Empleado.cargoId = Cargo.id
                WHERE Empleado.id LIKE '%$busqueda%' OR
                nombre LIKE '%$busqueda%' OR 
                telefono LIKE '%$busqueda%' OR 
                correo LIKE '%$busqueda%' OR 
                nombreCargo LIKE '%$busqueda%' ";
} else {
    $query = "SELECT Empleado.id, nombre, telefono, correo, salario, nombreCargo FROM Empleado INNER JOIN Cargo ON Empleado.cargoId = Cargo.id";
}

?>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="container-fluid">
            <h6 class="mb-0">Registro de Empleados</h6>
            <div class="d-flex flex-column flex-sm-row gap-2 align-items-center justify-content-between mb-3 p-3">
                <a href="formularioEmpleado.php" class="btn btn-success btn-sm">
                    Agregar empleado
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

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['telefono'] . "</td>";
                            echo "<td>" . $row['correo'] . "</td>";
                            echo "<td>" . $row['salario'] . "</td>";
                            echo "<td>" . $row['nombreCargo'] . "</td>";
                            echo "<td>
                                                <a href='formularioEmpleado.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Editar</a>
                                                <a href='../Controllers/empleadoController.php?id=" . $row['id'] . "&bandera=3' class='btn btn-sm btn-primary'>Eliminar</a>
                                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="7">Sin resultados</td>';
                        echo '</tr>';
                    }
                    mysqli_close($conn);

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>