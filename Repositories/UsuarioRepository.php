<?php
namespace Repositories;

use Lib\BaseDatosPDO;
use Models\Usuario;


class UsuarioRepository
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new BaseDatosPDO();
    }




    public function existeNombre(string $nombre): ?Usuario
    {
        $resultado = $this->conexion->comprobarUsuario($nombre);

        $usuario = null;
        foreach ($resultado as $usr) {
            $usuario = Usuario::fromArray($usr);
        }
        return $usuario;
    }

    public function crearUsuario(Usuario $usuario): void {
        $this->conexion->crearUsuario($usuario);

    }

}
?>