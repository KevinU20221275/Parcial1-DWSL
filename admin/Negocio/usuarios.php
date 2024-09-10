<?php
require_once(__DIR__ . '/../../conf/conf.php');

class Usuario extends Conf {
    public $nombre;

    public $nombreUsuario;

    public $password;
 

    public function get_usuario($usuario, $password){
        $query = "SELECT id,nombre,nombreUsuario FROM Usuario WHERE nombreUsuario=:nombreUsuario && password=:password";
        $params = [':nombreUsuario' => $usuario,
                    ':password' => md5($password)
        ];

        $result = $this->exec_query($query, $params);

        if ($result){
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function update($id){
        $query = "UPDATE Usuario SET
            nombre = :nombre,
            nombreUsuario = :nombreUsuario,
            password = :password
            WHERE id = :id";

        $params = [
            ':id' => $id,
            ':nombre' => $this->nombre,
            ':nombreUsuario' => $this->nombreUsuario,
            ':password' => md5($this->password)
        ];

        return $this->exec_query($query,$params);

    }

}