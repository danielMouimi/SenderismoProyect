<?php

namespace Lib;
use PDO;

class BaseDatosPDO extends PDO {
    private PDO $conexion;
    private mixed $resultado;
    public function __construct(
        private $tipo_de_base = "mysql",
        private string $servidor = SERVERNAME,
        private string $usuario = USERNAME,
        private string $pass = PASSWORD,
        private string $base_datos = DATABASE) {
        try{
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::MYSQL_ATTR_FOUND_ROWS => true);
            parent::__construct("$this->tipo_de_base:dbname=$this->base_datos;host=$this->servidor", $this->usuario, $this->pass, $opciones);
        }catch (PDOException $e) {
            die("ha surgido un error y no se puede conectar a la base de datos, detalle: " . $e->getMessage());
            exit;
        }
    }



    public function consulta(string $consultaSQL): void{
        $this->resultado = $this->query($consultaSQL);
    }

    public function extraer_todos(): array{
        return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function extraer_busqueda(string $termino): array{
        $consulta = $this->prepare("SELECT * FROM rutas WHERE titulo LIKE :termino");
        $termino = "%$termino%";
        $consulta->bindParam(':termino', $termino);

        $consulta->execute();


        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function comprobarUsuario(string $nombre): ?array{
        $consulta = $this->prepare("SELECT * FROM lista_usuarios WHERE nombreusu = :nombre");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($usuario): void {
        $consulta = $this->prepare("
        INSERT INTO lista_usuarios VALUES (:nombreUsuario, :rol, :email, :contrasena)
    ");

        $consulta->bindValue(':nombreUsuario', $usuario->getNombreUsuario());
        $consulta->bindValue(':rol', $usuario->getRol());
        $consulta->bindValue(':email', $usuario->getEmail());
        $consulta->bindValue(':contrasena', $usuario->getContrasena());

        $consulta->execute();
    }

    public function comprobarRuta(int $id): ?array
    {
        $consulta = $this->prepare("SELECT * FROM rutas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function anadirRuta($ruta): void {
        $consulta = $this->prepare("
        INSERT INTO rutas VALUES (:id,:titulo,:descripcion,:desnivel,:distancia,:notas,:dificultad)
    ");
        $consulta->bindValue(":id", $ruta->getId());
        $consulta->bindValue(":titulo", $ruta->getTitulo());
        $consulta->bindValue(":descripcion", $ruta->getDescripcion());
        $consulta->bindValue(":desnivel", $ruta->getDesnivel());
        $consulta->bindValue(":distancia", $ruta->getDistancia());
        $consulta->bindValue(":notas", $ruta->getNotas());
        $consulta->bindValue(":dificultad", $ruta->getDificultad());
        $consulta->execute();
    }

    public function editarRuta($ruta): void {
        $consulta = $this->prepare("UPDATE rutas SET titulo = :titulo,descripcion = :descripcion,desnivel = :desnivel,distancia = :distancia,notas = :notas,dificultad = :dificultad WHERE id = :id");

            $consulta->bindValue(":id", $ruta->getId());
            $consulta->bindValue(":titulo", $ruta->getTitulo());
            $consulta->bindValue(":descripcion", $ruta->getDescripcion());
            $consulta->bindValue(":desnivel", $ruta->getDesnivel());
            $consulta->bindValue(":distancia", $ruta->getDistancia());
            $consulta->bindValue(":notas", $ruta->getNotas());
            $consulta->bindValue(":dificultad", $ruta->getDificultad());
            $consulta->execute();

    }

    public function eliminarRuta($id): void {
        $consulta = $this->prepare("DELETE FROM rutas WHERE id = $id");
        $consulta->execute();
    }



}
