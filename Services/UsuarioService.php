<?php
namespace Services;

use Models\Usuario;
use Repositories\UsuarioRepository;

class UsuarioService {
    private $usuarioRepository;

    public function __construct() {
        $this->usuarioRepository = new UsuarioRepository();
    }


    public function iniciarSesion(string $nombre, string $contrasena): ?array {
        $usuario = $this->usuarioRepository->existeNombre($nombre);

        //sanitizar la contraseña
        if ($usuario && password_verify($contrasena, $usuario->getContrasena())) {
            // Devuelve un array con la información básica del usuario
            return [
                'nombreusu' => $usuario->getNombreUsuario(),
                'email' => $usuario->getEmail(),
                'rol' => $usuario->getRol()
            ];
        }

        return null;
    }

    public function registro(string $nombre, string $contrasena,string $email): ?array
    {
        $usuario = $this->usuarioRepository->existeNombre($nombre);

        if (!$usuario) {
            $usuario = new Usuario($nombre,"usur",$email,password_hash($contrasena,PASSWORD_DEFAULT));
            $this->usuarioRepository->crearUsuario($usuario);
            return [
                'nombreusu' => $usuario->getNombreUsuario(),
                'email' => $usuario->getEmail(),
                'rol' => $usuario->getRol()
            ];
        }
            return null;
    }

    public function asegurarAdmin() {
        $nombreUsuario = 'admin';
        $rol = 'admin';
        $email = 'admin@gmail.com';
        $contrasena = '1234';

        // Comprobar si el usuario admin ya existe
        $usuarioExistente = $this->usuarioRepository->existeNombre($nombreUsuario);

        if (!$usuarioExistente) {
            // Crear el hash de la contraseña
            $hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            // Crear el objeto Usuario
            $admin = new \Models\Usuario($nombreUsuario, $rol, $email, $hashContrasena);

            // Guardar el usuario admin en la base de datos
            $this->usuarioRepository->crearUsuario($admin);
        }
    }

}
?>