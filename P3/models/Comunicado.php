<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");

class Comunicado extends Modelo {

    private $titulo;
    private $texto;

    public function __construct() {
		parent::__construct();
        $this->table = "comunicados_sitio";
    }


    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (titulo, texto) VALUES (:titulo, :texto)");
        $result = $consulta->execute(array(
            "titulo" => $this->titulo,
            "texto" => $this->texto
        ));

        return $result; //true if OK.
    }

    public function actualizar(){

        $consulta = conexion()->prepare("
            UPDATE " . $this->table . "
            SET
                texto = :texto,
                titulo = :titulo

            WHERE id = :id
        ");

        $resultado = $consulta->execute(array(
          "texto" => $this->texto,
          "titulo" => $this->titulo
        ));


        return $resultado; //true if OK.
    }




}
?>
