<?php
namespace Controllers;

use Services\UsuarioService;

class FrontController {
    public static function main() {

        $usuarioService = new UsuarioService();
        $usuarioService->asegurarAdmin();

        $controllerName = $_GET['controller'] ?? 'RutasController';
        $action = $_GET['action'] ?? 'mostrarRutas';
        if (isset($_GET['busqueda'])) {
            $action = 'buscarRutas';
        }

        $controllerName = "Controllers\\$controllerName";

        if (class_exists($controllerName) && method_exists($controllerName, $action)) {
            $controller = new $controllerName();
            $controller->$action();
        } else {
            echo "Página no encontrada.";
        }
    }
}
?>

