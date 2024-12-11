<?php
namespace Services;
use Models\Rutas;
use Repositories\RutasRepository;

class RutasService {
    private RutasRepository $ruta;

    function __construct() {
        $this->ruta = new RutasRepository();
    }

    public function findAll(): ?array {
        return $this->ruta->findAll();
    }

    public function buscarRutas(string $termino): array {
        return $this->ruta->buscarPorTitulo($termino);
    }

    public function anadirRutas(Rutas $ruta): ?Rutas {

        $id = $ruta->getId();
        $existe = $this->ruta->comprobarRuta($id);

        if (!$existe) {
            $r = new Rutas($ruta->getId(), $ruta->getTitulo(), $ruta->getDescripcion(),$ruta->getDesnivel(),$ruta->getDistancia(),$ruta->getNotas(),$ruta->getDificultad());
            $this->ruta->anadirRutas($r);
            return $r;
        }
        return null;
    }

    public function editarRutas(Rutas $ruta): ?Rutas {


            $r = new Rutas($ruta->getId(), $ruta->getTitulo(), $ruta->getDescripcion(), $ruta->getDesnivel(), $ruta->getDistancia(), $ruta->getNotas(), $ruta->getDificultad());
            $this->ruta->editarRutas($r);
            return $r;
    }

    public function eliminarRutas(int $id): void
    {
        $this->ruta->eliminarRuta($id);
    }

}