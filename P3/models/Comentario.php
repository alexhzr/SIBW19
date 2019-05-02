<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");

class Evento extends Modelo {

    private $autor;
    private $email;
    private $texto;
    private $evento;
    private $fecha;
    private $ip;


    public function __construct() {
		parent::__construct();
        $this->table = "comentario";
    }


    public function getNombre() {
        return $this->evento;
    }

    public function setNombre($nombre) {
        $this->evento = $nombre;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($Email) {
        $this->email = $email;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->autor = $ip;
    }


    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (autor, email, texto, fecha, evento, ip)
                                        VALUES (:autor, :email, :texto, :fecha, :evento, :ip)");
        $result = $consulta->execute(array(
            "autor" => $this->autor,
            "email" => $this->email,
            "texto" => $this->texto,
            "fecha" => $this->fecha,
            "evento" => $this->evento,
            "ip" => $this->ip
        ));

        return $result; //true if OK.
    }

    public function actualizar(){

        $consulta = conexion()->prepare("
            UPDATE " . $this->table . "
            SET
                autor = :autor,
                email = :email,
                texto = :texto,
                fecha = :fecha,
                evento = :evento,
                ip = :ip

            WHERE id = :id
        ");

        $resultado = $consulta->execute(array(
          "autor" => $this->autor,
          "email" => $this->email,
          "texto" => $this->texto,
          "fecha" => $this->fecha,
          "evento" => $this->evento,
          "ip" => $this->ip
        ));

        return $resultado; //true if OK.
    }
}
?>
