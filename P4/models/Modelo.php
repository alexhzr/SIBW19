<?php
  require_once("conexion.php");

class Modelo {
   protected $table = "";
    //protected $conexion;
    protected $id;

    /*public function __construct($conexion) {
		conexion() = $conexion;

  }*/

    public function __construct() {}

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAll(){

        $consulta = conexion()->prepare("SELECT * FROM " . $this->table);
        $consulta->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consulta->fetchAll();
        //conexion() = null; //cierre de conexión
        return $resultados;

    }


    public function getById($id){
        $consulta = conexion()->prepare("SELECT *
                                                FROM " . $this->table . "  WHERE id = :id");
        $consulta->execute(array(
            "id" => $id
        ));
        /* Fetch all of the remaining rows in the result set */
        $resultado = $consulta->fetchObject();
        //conexion() = null; //cierre de conexión
        return $resultado;
    }

    public function getByColumn($column,$value){
        $consulta = conexion()->prepare("SELECT *
                                                FROM " . $this->table . " WHERE " . $column . " = :value");
        $consulta->execute(array(
            "value" => $value
        ));
        $resultados = $consulta->fetchAll();
        //conexion() = null; //cierre de conexión
        return $resultados;
    }

    public function deleteById($id){
        try {
            $consulta = conexion()->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $consulta->execute(array(
                "id" => $id
            ));
            $conexion = null;
        } catch (Exception $e) {
            echo 'Falló el DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }

    public function deleteByColumn($column,$value){
        try {
            $consulta = conexion()->prepare("DELETE FROM " . $this->table . " WHERE :column = :value");
            $consulta->execute(array(
                "column" => $value,
                "value" => $value,
            ));
            $conexion = null;
        } catch (Exception $e) {
            echo 'Falló el DELETE (deleteBy): ' . $e->getMessage();
            return -1;
        }
    }
}
?>
