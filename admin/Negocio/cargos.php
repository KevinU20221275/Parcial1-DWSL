<?php
require_once(__DIR__ . '/../../conf/conf.php');

class Cargo extends Conf {
    public $nombre_cargo;

    public $descripcion;

    public function listar_cargos(){
        $query = "SELECT * FROM Cargo";
        $result = $this->exec_query($query);

        if ($result){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function agregar(){
        $query= "INSERT INTO Cargo (
            nombreCargo,
            descripcion
        )
        VALUES (
            :nombre_cargo,
            :descripcion
        )";

        $params = [
            ':nombre_cargo' => $this->nombre_cargo,
            ':descripcion' => $this->descripcion
        ];

        return $this->exec_query($query,$params);
    }

    public function actualizar($id){
        $query = "UPDATE Cargo SET
            nombreCargo = :nombre_cargo,
            descripcion = :descripcion
        WHERE id = :id";

        $params = [
            ':id' => $id,
            ':nombre_cargo' => $this->nombre_cargo,
            ':descripcion' => $this->descripcion
        ];

        return $this->exec_query($query,$params);

    }

    public function eliminar($id){
        $query = "DELETE FROM Cargo WHERE id = :id";
        $params = [':id' => $id];

        return $this->exec_query($query, $params);
    }

    public function obtener_cargo_por_id($id){
        $query = "SELECT id, nombreCargo, descripcion FROM Cargo WHERE id = :id";
        $params = [':id' => $id];

        $result = $this->exec_query($query, $params);

        if ($result){
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function buscar_cargo($busqueda){
        $query = "SELECT * FROM Cargo
        WHERE id LIKE :busqueda OR
        nombreCargo LIKE :busqueda OR 
        descripcion LIKE :busqueda";
        
        $params = [':busqueda' => "%$busqueda%"];

        $result = $this->exec_query($query, $params);

        if ($result){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}



?>