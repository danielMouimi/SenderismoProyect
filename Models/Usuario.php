<?php
namespace Models;

class Usuario {
    private $nombreUsuario;
    private $rol;
    private $email;
    private $contrasena;

    public function __construct($nombreUsuario, $rol, $email, $contrasena) {
        $this->nombreUsuario = $nombreUsuario;
        $this->rol = $rol;
        $this->email = $email;
        $this->contrasena = $contrasena;
    }

    public static function fromArray(array $data): Usuario{
        return new Usuario(
            $data['nombreusu']?? '',
            $data['rol']?? '',
            $data['email']?? '',
            $data['password']?? ''
        );
    }

    public function getNombreUsuario() { return $this->nombreUsuario; }
    public function getRol() { return $this->rol; }
    public function getEmail() { return $this->email; }
    public function getContrasena() { return $this->contrasena; }
}
?>