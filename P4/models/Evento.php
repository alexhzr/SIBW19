<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");

class Evento extends Modelo {

    private $nombre;
    private $descripcion;
    private $fecha;
    private $imagen;
    private $organizador;

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

    public function getOrganizador() {
        return $this->organizador;
    }

    public function setOrganizador($organizador) {
        $this->organizador = $organizador;
    }

    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (nombre, descripcion, fecha, imagen, organizador)
                                        VALUES (:nombre, :descripcion, :fecha, :imagen, :organizador)");
        $result = $consulta->execute(array(
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion,
            "fecha" => $this->fecha,
            "imagen" => $this->imagen,
            "organizador" => $this->organizador
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
          "imagen" => $this->imagen,
          "organizador" => $this->organizador
      ));
      //conexion() = null;
      $result = $consulta->fetchAll();
      return $result;
    }

    public function getEventosPorTag($tag) {
      $consulta = conexion()->prepare("SELECT evento FROM tiene_tag A LEFT JOIN evento B ON A.evento=B.id LEFT JOIN tags C ON A.tag=C.id WHERE A.tag=".$tag.";");
      $consulta->execute(array());
      $idEventos = $consulta->fetchAll();
      $eventos = array();

      for ($i = 0; $i < sizeof($idEventos); $i++) {
        $eventos[$i] = $this->getById($idEventos[$i]['evento']);
      }
      
      return $eventos;
    }

    
    public function actualizar(){
        $consulta = conexion()->prepare("
            UPDATE " . $this->table . "
            SET
                nombre = ?,
                descripcion = ?,
                imagen = ?,
                fecha = ?,
                organizador = ?,

            WHERE id = ?
        ");

        $consulta->bindParam(1, $this->nombre);
        $consulta->bindParam(2, $this->descripcion);
        $consulta->bindParam(3, $this->imagen);
        $consulta->bindParam(4, $this->fecha);
        $consulta->bindParam(5, $this->organizador);
        $consulta->bindParam(6, $this->id);
       
        // Excecute
        $resultado = $consulta->execute();
        
        /*$resultado = $consulta->execute(array(
          "nombre" => $this->nombre,
          "descripcion" => $this->descripcion,
          "fecha" => $this->fecha,
          "imagen" => $this->imagen,
          "organizador" => $this->organizador,
          "id" => $this->id
        ));*/

        
        print($resultado);
        //return $resultado; //true if OK.
    }

    public function subirImagen($imagen){
        print_r($imagen);
        if(!empty($imagen)){
            $errors= array();
            $file_name = $imagen['name'];
            $file_size =$imagen['size'];
            $file_tmp =$imagen['tmp_name'];
            $file_type=$imagen['type'];
            $file_ext=strtolower(end(explode('.',$imagen['name'])));
            
            $extensions= array("jpeg","jpg","png","JPG");
            
            if(in_array($file_ext,$extensions)=== false){
               $errors[]="Extensión de archivo no adecuada, formatos adecuados: jpeg, jpg y png";
            }
            
            if($file_size > 2097152){
               $errors[]='El archivo no debe superar los 2MB de tamaño';
            }
            
            if(empty($errors)==true){
               move_uploaded_file($file_tmp,"img/".$file_name);
               echo "Success";
            }else{
               print_r($errors);
               echo "ERROR";
            }
        }
    }




}
?>
