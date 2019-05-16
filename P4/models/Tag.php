<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");

class Tag extends Modelo {

    private $nombre;

    public function __construct() {
		parent::__construct();
        $this->table = "tags";
    }


    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }


    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (nombre) VALUES (:nombre)");
        $result = $consulta->execute(array(
            "nombre" => $this->nombre
        ));

        return $result; //true if OK.
    }

    public function actualizar(){

        $consulta = conexion()->prepare("
            UPDATE " . $this->table . "
            SET
                nombre = :nombre

            WHERE id = :id
        ");

        $resultado = $consulta->execute(array(
          "nombre" => $this->nombre
        ));


        return $resultado; //true if OK.
    }




}
?>
