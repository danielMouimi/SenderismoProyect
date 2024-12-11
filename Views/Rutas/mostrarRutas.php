<?php
$pagination = new Zebra_Pagination();
$elementosPorPagina = 1;
$totalElementos = $pagination->records(count($todas_las_rutas));
$pagination->records_per_page($elementosPorPagina);

$inicio = (($pagination->get_page() - 1) * $elementosPorPagina);

$elementos = array_slice($todas_las_rutas, $inicio, $elementosPorPagina);
?>

<style>
    table th{
        background-color: white;
        color: black;
    }
    table td {
        border-top: 2px solid white;
    }
</style>

<h2>Las rutas:</h2>
<div>

    <?php if (!empty($todas_las_rutas)): ?>
    <table >
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Desnivel (m)</th>
            <th>Distancia (Km)</th>
            <th>Dificultad</th>
            <th>Operaciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $contador = 0;
        $masLarga = 0;
        foreach ($elementos as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r->getTitulo()) ?></td>
                <td><?= htmlspecialchars($r->getDescripcion()) ?></td>
                <td><?= htmlspecialchars($r->getDesnivel()) ?></td>
                <td><?= htmlspecialchars($r->getDistancia()) ?></td>
                <td><?= htmlspecialchars($r->getDificultad()) ?></td>
                <td>
                    <a href="<?=BASE_URL?>RutasController/comentarRuta/">Comentar</a>
                    <?php if (isset($_SESSION['usuario'])): ?>
                    <?php if ($_SESSION['usuario']["rol"] === "admin"): ?>
                        <a href="<?=BASE_URL?>RutasController/mostrarEditar?id=<?=$r->getId()?>">Modificar</a>
                        <a href="<?=BASE_URL?>RutasController/mostrarEliminar?id=<?=$r->getId()?>">Borrar</a>

                    <?php endif; ?>
                    <?php endif; ?>

                </td>
            </tr>
        <?php
        if ($r->getDistancia() > $masLarga){
            $masLarga = $r->getDistancia();
        }
        $contador = $contador + 1;
        endforeach; ?>
        </tbody>
    </table>
        <div>
            <?php $pagination->render(); ?>
        </div>
    <div>
        <p>El numero Total de rutas es: <?= $contador ?></p>
        <p>la ruta mas larga tiene: <?= $masLarga ?> Km</p>
    </div>
    <?php else: ?>

            <p>No se encontraron resultados</p>

    <?php endif; ?>
</div>