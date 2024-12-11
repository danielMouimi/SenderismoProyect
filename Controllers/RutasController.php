<?php
namespace Controllers;

use Models\Rutas;
use Lib\Pages;
use Services\RutasService;

class RutasController
{
    private $ruta;
    private $service;
    private $pages;

    public function __construct()
    {
        $this->ruta = new Rutas();
        $this->service = new RutasService();
        $this->pages = new Pages();
    }

    public function mostrarRutas() {
        $todas_las_rutas = $this->service->findAll();
        require_once __DIR__ . '/../Views/Rutas/mostrarRutas.php';
    }

    public function buscarRutas() {
        $termino = $_GET['busqueda'] ?? '';
        $todas_las_rutas = $this->service->buscarRutas($termino);
        require_once __DIR__ . '/../Views/Rutas/mostrarRutas.php';
    }

    public function mostrarAnadir()
    {
        require_once __DIR__ . '/../Views/Rutas/anadirRuta.php';
    }
    public function mostrarEditar() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            require_once __DIR__ . '/../Views/Rutas/editarRuta.php';
        }
    }

    public function anadirRutas() {
        $id = $_POST['id'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $desnivel = $_POST['desnivel'] ?? '';
        $distancia = $_POST['distancia'] ?? '';
        $notas = $_POST['notas'] ?? '';
        $dificultad = $_POST['dificultad'] ?? '';
        $r = new Rutas(intval($id), $titulo, $descripcion, $desnivel, $distancia, $notas, $dificultad);
        $ruta = $this->service->anadirRutas($r);
        if ($ruta) {
            header('Location: index.php?action=mostrarRutas');
            exit;
        }else {
            $error = "no se ha podido crear la ruta";
            require_once __DIR__ . '/../Views/Rutas/anadirRuta.php';

        }
    }

    public function editarRutas() {
        $idamodificar = $_GET['id'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $desnivel = $_POST['desnivel'] ?? '';
        $distancia = $_POST['distancia'] ?? '';
        $notas = $_POST['notas'] ?? '';
        $dificultad = $_POST['dificultad'] ?? '';
        $r = new Rutas($idamodificar, $titulo, $descripcion, $desnivel, $distancia, $notas, $dificultad);

        $ruta = $this->service->editarRutas($r); // if ruta existe
        if ($ruta) {
            $this->service->editarRutas($r);
            header('Location: ' . BASE_URL . 'RutasController/mostrarRutas');
            exit;
        }else {
            $error = "no se ha podido crear la ruta";
            require_once __DIR__ . '/../Views/Rutas/anadirRuta.php';

        }
    }

    public function mostrarEliminar()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            require_once __DIR__ . '/../Views/Rutas/eliminarRuta.php';
        }
    }
    public function eliminarRutas(): void {
        $id = $_GET['id'] ?? '';
        $this->service->eliminarRutas($id);
        header('Location: ' . BASE_URL . 'RutasController/mostrarRutas');
    }
}
