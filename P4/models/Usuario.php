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
    public function setPassword($password) { $this->password = $password; }


    public function existeUsuario($login, $password) {
        $consulta = conexion()->prepare("SELECT * FROM ".$this->table." WHERE login = :login");
        $consulta->execute(array(":login" => $login));
        $resultado = $consulta->fetchObject("Usuario");

        if (!empty($resultado)) {
            if (password_verify($password, $resultado->getPassword()) )
                return $resultado;

            // contraseña errónea
            else {
                return -1;
            }
        
        // no existe el usuario
        } else {
            return 0;
        }
        
    }

    public function nickLibre($login) {
        $consulta = conexion()->prepare("SELECT * FROM ".$this->table." WHERE login = :login");
        $consulta->execute(array(":login" => $login));
        $resultado = $consulta->fetchObject("Usuario");

        if (empty($resultado)) 
            return true;
        
        // ya existe el usuario
        else 
            return false;
        
    }

    public function guardar(){

        $consulta = conexion()->prepare("INSERT INTO " . $this->table . " (nombre, login, password) VALUES (:nombre, :login, :password)");
        $result = $consulta->execute(array(
            "nombre" => $this->nombre,
            "login" => $this->login,
            "password" => password_hash($this->password, PASSWORD_DEFAULT)
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
            "password" => password_hash($this->password, PASSWORD_DEFAULT),
            "tipoUsuario" => $this->tipoUsuario,
            "id" => $this->id
        ));


        return $resultado; //true if OK.
    }
}
?>
