<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Senderismo</title>
    <style>
        body {
            background-color: #3d3d3d;
            color: white;
        }
        a {
            color: wheat;
        }
        a:visited {
            color: #8f7542;
        }
    </style>
</head>
<body>
<?php session_start(); ?>
<h1>Senderismo</h1>

<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="busqueda">Buscar por titulo:</label>
    <input type="text" name="busqueda" placeholder="Buscar rutas..." value="<?= htmlspecialchars($_GET['busqueda'] ?? '') ?>">
    <button type="submit">Buscar</button>
</form>

<?php if (!isset($_SESSION['usuario'])): ?>

    <a href="<?=BASE_URL?>UsuarioController/mostrarLogin">Iniciar Sesion</a>
    <a href="<?=BASE_URL?>UsuarioController/mostrarRegistro">Registrarse</a>
<?php else: ?>

User: <?= htmlspecialchars($_SESSION['usuario']["nombreusu"] ?? '') ?>
<a href="<?=BASE_URL?>UsuarioController/cerrarSesion">Cerrar Sesion</a>
<?php if ($_SESSION['usuario']["rol"] === "admin"): ?>
<a href="<?=BASE_URL?>RutasController/mostrarAnadir">Añadir Ruta</a>

<?php endif; ?>
<?php endif; ?>

<a href="<?=BASE_URL?>RutasController/mostrarRutas">Mostrar las Rutas</a>



