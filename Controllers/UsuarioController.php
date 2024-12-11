<?php
namespace Controllers;

use Models\Usuario;
use Lib\Pages;
use Services\UsuarioService;

class UsuarioController {
    private $pages;
    private $usuarioService;

    public function __construct() {
        $this->pages = new Pages();
        $this->usuarioService = new UsuarioService();
    }

    public function mostrarLogin() {
        require_once __DIR__ . '/../Views/Usuarios/login.php';
    }
    public function mostrarRegistro() {
        require_once __DIR__ . '/../Views/Usuarios/Register.php';
    }


    public function procesarLogin() {
        $nombre = $_POST['nombreUsuario'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        $usuario = $this->usuarioService->iniciarSesion($nombre, $contrasena);

        if ($usuario) {
            // Iniciar sesión y guardar datos en $_SESSION
            session_start();
            $_SESSION['usuario'] = $usuario;

//            if ($usuario['rol'] === 'admin') { esto en el header
            header('Location: ' . BASE_URL . 'RutasController/mostrarRutas');

            exit;
        } else {
            $error = "Credenciales inválidas";
            require_once __DIR__ . '/../Views/Usuarios/login.php';
        }
    }

    public function procesarRegistro() {
        $nombre = $_POST['nombreUsuario'] ?? '';
        $email = $_POST['email'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        $usuario = $this->usuarioService->registro($nombre, $email, $contrasena);


        if ($usuario) {
            // Iniciar sesión y guardar datos en $_SESSION
            session_start();
            $_SESSION['usuario'] = $usuario;

            header('Location: ' . BASE_URL . 'RutasController/mostrarRutas');

            exit;
        } else {
            $error = "Usuario ya existente";
            require_once __DIR__ . '/../Views/Usuarios/Register.php';
        }
    }

    public function cerrarSesion() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'RutasController/mostrarRutas');
        exit;
    }
}
