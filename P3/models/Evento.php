<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");

class Evento extends Modelo {

    private $nombre;
    private $descripcion;
    private $fecha;
    private $imagen;

    /*public function __construct($conexion) {
		parent::__construct($conexion);
        $this->table = "evento";
    }*/

    public function __construct() {
		parent::__construct();
        $this->table = "evento";
    }


    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (nombre, descripcion, fecha, imagen)
                                        VALUES (:nombre, :descripcion, :fecha, :imagen)");
        $result = $consulta->execute(array(
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion,
            "fecha" => $this->fecha,
            "imagen" => $this->imagen
        ));
//        conexion() = null;

        return $result; //true if OK.
    }

    public function getProximosEventos() {
                                        //SELECT * FROM evento ORDER BY evento.fecha ASC LIMIT 4
      $consulta = conexion()->prepare("SELECT * FROM ".$this->table." ORDER BY ".$this->table.".fecha ASC LIMIT 4;");
      $result = $consulta->execute(array(
          "nombre" => $this->nombre,
          "descripcion" => $this->descripcion,
          "fecha" => $this->fecha,
          "imagen" => $this->imagen
      ));
      //conexion() = null;
      $result = $consulta->fetchAll();
      return $result;
    }

    public function getEventosPorTag($tag) {
      $consulta = conexion()->prepare("SELECT * FROM tiene_tag A LEFT JOIN evento B ON A.evento=B.id LEFT JOIN tags C ON A.tag=C.id WHERE A.tag=".$tag.";");

      $result = $consulta->execute(array(
          "evento.nombre" => $this->nombre,
          "evento.descripcion" => $this->descripcion,
          "evento.fecha" => $this->fecha,
          "evento.imagen" => $this->imagen
      ));
    }

    public function actualizar(){

        $consulta = conexion()->prepare("
            UPDATE " . $this->table . "
            SET
                nombre = :nombre,
                descripcion = :descripcion,
                imagen = :imagen,
                fecha = :fecha

            WHERE id = :id
        ");

        $resultado = $consulta->execute(array(
          "nombre" => $this->nombre,
          "descripcion" => $this->descripcion,
          "fecha" => $this->fecha,
          "imagen" => $this->imagen
        ));
//        conexion() = null;

        return $resultado; //true if OK.
    }




}
?>
