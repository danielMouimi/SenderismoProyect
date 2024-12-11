<h2>Añadir Ruta</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <p style="font-size: smaller">Nota:Alomejor necesitas registrarte</p>
<?php endif; ?>

<form method="POST" action="<?=BASE_URL?>RutasController/anadirRutas">
        <!-- Campo ID -->
        <label for="id">ID:</label>
        <input type="number" id="id" name="id" value="">

        <!-- Campo Título -->
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="">

        <!-- Campo Descripción -->
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4"></textarea>

        <!-- Campo Desnivel -->
        <label for="desnivel">Desnivel (m):</label>
        <input type="number" id="desnivel" name="desnivel" value="" step="any">

        <!-- Campo Distancia -->
        <label for="distancia">Distancia (km):</label>
        <input type="number" id="distancia" name="distancia" value="" step="any">

        <!-- Campo Notas -->
        <label for="notas">Notas:</label>
        <textarea id="notas" name="notas" rows="3"></textarea>

        <!-- Campo Dificultad -->
        <label for="dificultad">Dificultad:</label>
        <input type="number" id="dificultad" name="dificultad" value="" step="any">


        <!-- Botón de enviar -->
        <input type="submit" value="Añadir Ruta">

</form>
<a href="<?=BASE_URL?>RutasController/mostrarRutas">Volver</a>