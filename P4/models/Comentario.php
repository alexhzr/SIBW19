<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");
require_once("Evento.php");

class Comentario extends Modelo {

    private $autor;
    private $email;
    private $texto;
    private $evento;
    private $fecha;
    private $ip;
    private $avatar;
    private $modificado;


    public function __construct() {
		parent::__construct();
        $this->table = "comentario";
    }

    public function asignarValores($autor, $email, $texto, $evento, $fecha, $ip, $avatar) {
      $this->autor = $autor;
      $this->email = $email;
      $this->texto = $texto;
      $this->evento = $evento;
      $this->fecha = $fecha;
      $this->ip = $ip;
      $this->avatar = $avatar;
      $this->modificado = 0;

    }

    public function getModificado() { return $this->modificado; }
    public function setModificado() { $this->modificado = 1; }

    public function getEvento() {
        return $this->evento;
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

    public function setEmail($email) {
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

    public function getComentariosEvento($evento) {
      $consulta = conexion()->prepare("SELECT * FROM " . $this->table . " WHERE evento=".$evento.";");
      $result = $consulta->execute(array(
          "autor" => $this->autor,
          "email" => $this->email,
          "texto" => $this->texto,
          "avatar" => $this->avatar,
          "fecha" => $this->fecha,
          "evento" => $this->evento,
          "ip" => $this->ip
      ));

      $result = $consulta->fetchAll();
      return $result; //true if OK.
    }

    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (autor, email, avatar, texto, fecha, evento, ip)
                                        VALUES (:autor, :email, :avatar, :texto, :fecha, :evento, :ip)");
        $result = $consulta->execute(array(
            "autor" => $this->autor,
            "email" => $this->email,
            "avatar" => $this->avatar,
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
                modificado = 1

            WHERE id = :id
        ");

        $resultado = $consulta->execute(array(
          "autor" => $this->autor,
          "email" => $this->email,
          "texto" => $this->texto,
          "id" => $this->id
        ));

        return $resultado; //true if OK.
    }
}
?>
