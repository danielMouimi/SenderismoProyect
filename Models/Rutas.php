<?php
namespace Models;


class Rutas
{
    public function __construct(
        private int|null $id=null,
        private string $titulo="",
        private string $descripcion="",
        private string $desnivel="",
        private float|null $distancia=null,
        private string $notas="",
        private int|null $dificultad=null
    ) {

    }

    public static function fromArray(array $data): Rutas{
        return new Rutas(
            $data['id']?? '',
            $data['titulo']?? '',
            $data['descripcion']?? '',
            $data['desnivel']?? '',
            $data['distancia']?? '',
            $data['notas']?? '',
            $data['dificultad']?? ''
        );
    }


    public function __toString() {
        return $this->titulo; //
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function getTitulo(): ?string {
        return $this->titulo;
    }

    public function getDescripcion(): ?string {
        return $this->descripcion;
    }
    public function getDesnivel(): ?string {
        return $this->desnivel;
    }
    public function getDistancia(): ?float {
        return $this->distancia;
    }

    public function getNotas(): ?string {
        return $this->notas;
    }
    public function getDificultad(): ?int {
        return $this->dificultad;
    }

    public function setId(int $id): Rutas {
        $this->id = $id;
    }
    public function setTitulo(string $titulo): Rutas {
        $this->titulo = $titulo;
    }

    public function setDescripcion(string $descripcion): Rutas {
        $this->descripcion = $descripcion;
    }
    public function setDesnivel(string $desnivel): Rutas {
        $this->desnivel = $desnivel;
    }
    public function setDistancia(float $distancia): Rutas {
        $this->distancia = $distancia;
    }
    public function setNotas(string $notas): Rutas {
        $this->notas = $notas;
    }

    public function setDificultad(int $dificultad): Rutas {
        $this->dificultad = $dificultad;
    }

}
