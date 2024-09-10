<?php
require_once(__DIR__ . '/../../conf/conf.php');

class Empleado extends Conf {
    public $nombre;

    public $telefono;
    public $correo;
    public $salario;
    public $cargo_id;

    public function listar_empleados(){
        $query = "SELECT Empleado.id, nombre, telefono, correo, salario, nombreCargo 
        FROM Empleado INNER JOIN Cargo 
        ON Empleado.cargoId = Cargo.id";

        $result = $this->exec_query($query);

        if ($result){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function agregar(){
        $query= "INSERT INTO Empleado (
            nombre,
            telefono,
            correo,
            salario,
            cargoId
        )
        VALUES (
            :nombre,
            :telefono,
            :correo,
            :salario,
            :cargo_id
        )";

        $params = [
            ':nombre' => $this->nombre,
            ':telefono' => $this->telefono,
            ':correo' => $this->correo,
            ':salario' => $this->salario,
            ':cargo_id' => $this->cargo_id
        ];

        return $this->exec_query($query,$params);
    }

    public function actualizar($id){
        $query = "UPDATE Empleado SET
            nombre = :nombre,
            telefono = :telefono,
            correo = :correo,
            salario = :salario,
            cargoId = :cargo_id
        WHERE id = :id";

        $params = [
            ':id' => $id,
            ':nombre' => $this->nombre,
            ':telefono' => $this->telefono,
            ':correo' => $this->correo,
            ':salario' => $this->salario,
            ':cargo_id' => $this->cargo_id
        ];

        return $this->exec_query($query,$params);

    }

    public function eliminar($id){
        $query = "DELETE FROM Empleado WHERE id = :id";
        $params = [':id' => $id];

        return $this->exec_query($query, $params);
    }

    public function obtener_empleado_por_id($id){
        $query = "SELECT id,nombre,telefono,correo,salario,cargoId FROM Empleado WHERE id = :id";
        $params = [':id' => $id];

        $result = $this->exec_query($query, $params);

        if ($result){
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function buscar_empleado($busqueda){
        $query = "SELECT Empleado.id, nombre, telefono, correo, salario, nombreCargo 
                FROM Empleado INNER JOIN Cargo
                ON Empleado.cargoId = Cargo.id
                WHERE Empleado.id LIKE :busqueda OR
                nombre LIKE :busqueda OR 
                telefono LIKE :busqueda OR 
                correo LIKE :busqueda OR 
                nombreCargo LIKE :busqueda ";
        
        $params = [':busqueda' => "%$busqueda%"];

        $result = $this->exec_query($query, $params);

        if ($result){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}