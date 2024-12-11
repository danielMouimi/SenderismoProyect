<?php
namespace Repositories;
use Lib\BaseDatosPDO;
use Models\Rutas;

class RutasRepository {
    private basedatosPDO $conexion;

    function __construct() {
        $this->conexion = new BaseDatosPDO();
    }

    public function findAll(): ?array {
        $this->conexion->consulta("SELECT * FROM rutas");
        return $this->extractAll();
    }

    public function extractAll(): ?array {
        $rutas = [];
        $rutasData = $this->conexion->extraer_todos();
        foreach ($rutasData as $ruta) {
            $rutas[] = Rutas::fromArray($ruta);
        }
        return $rutas;
    }

    public function buscarPorTitulo(string $termino): array {

        $resultado = $this->conexion->extraer_busqueda($termino);

        $rutas = [];
        foreach ($resultado as $ruta) {
            $rutas[] = Rutas::fromArray($ruta);
        }
        return $rutas;
    }

    public function anadirRutas(Rutas $ruta) {
        $this->conexion->anadirRuta($ruta);
    }
    public function comprobarRuta(int $id)
    {
        $this->conexion->comprobarRuta($id);
    }
    public function editarRutas(Rutas $ruta) {
        $this->conexion->editarRuta($ruta);
    }

    public function eliminarRuta(int $id) {
        $this->conexion->eliminarRuta($id);
    }
}
