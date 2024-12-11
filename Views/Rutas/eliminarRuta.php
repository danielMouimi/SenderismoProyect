<h2>¿Seguro que deseas borrar?</h2>

<form method="POST" action="<?=BASE_URL?>RutasController/eliminarRutas?id=<?=$id?>">
    <input type="submit" value="Borrar Ruta">
</form>
<a href="<?=BASE_URL?>RutasController/mostrarRutas">Volver</a>