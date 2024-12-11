<h2>Iniciar Sesión</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="<?=BASE_URL?>UsuarioController/procesarRegistro">
    <label for="name">Nombre de usuario: </label>
    <input id="name" name="nombreUsuario" type="text">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br>
    <button type="submit">Registrarse</button>
</form>
<a href="<?=BASE_URL?>RutasController/mostrarRutas">Volver</a>

