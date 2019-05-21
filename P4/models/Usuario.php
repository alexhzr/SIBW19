<?php
require_once  __DIR__ . "/Modelo.php";
require_once("conexion.php");

class Usuario extends Modelo {

    private $nombre;
    private $login;
    private $tipoUsuario;
    private $password;

    public function __construct() {
		parent::__construct();
        $this->table = "usuario";
    }


    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    public function getLogin() { return $this->login; }
    public function setLogin($login) { $this->login = $login; }
    
    public function getTipoUsuario() { return $this->tipoUsuario; }
    public function setTipoUsuario($tipoUsuario) { $this->tipoUsuario = $tipoUsuario; }

    public function getPassword() { return $this->password; }
    public function setPassword() { $this->password = $password; }


    public function existeUsuario($login, $password) {
        $consulta = conexion()->prepare("SELECT * FROM ".$this->table." WHERE login=:login;");
        $result = $consulta->execute(array("login" => $login));
        $resultado = $consulta->fetchObject();

        print($resultado);
        print_r($resultado);
        print("estoy en el metodo");
        //if (password_verify($password, ))
    }

    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (nombre, login, password, tipoUsuario) VALUES (:nombre, :login, :password, :tipoUsuario)");
        $result = $consulta->execute(array(
            "nombre" => $this->nombre,
            "login" => $this->login,
            "password" => password_hash($this->password),
            "tipoUsuario" => $this->tipoUsuario
        ));

        return $result; //true if OK.
    }

    public function actualizar(){

        $consulta = conexion()->prepare("
            UPDATE " . $this->table . "
            SET
                nombre = :nombre,
                tipoUsuario = :tipoUsuario,
                login = :login,
                password = :password

            WHERE id = :id
        ");

        $resultado = $consulta->execute(array(
            "nombre" => $this->nombre,
            "login" => $this->login,
            "password" => password_hash($this->password),
            "tipoUsuario" => $this->tipoUsuario
        ));


        return $resultado; //true if OK.
    }
}
?>
