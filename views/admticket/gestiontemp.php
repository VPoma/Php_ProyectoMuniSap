<h1>Cantidad de Tickets de <?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h1>

<table class="tablatempl">
    <tr>
        <th class="tepc">Categoría</th>
        <th class="tepe">Estado</th>
        <th class="tept">N° Tickets</th>
    </tr>
    <?Php while($tiempcnt= $ticktempcant->fetch_object()): ?>
    <tr>
        <td><?=$tiempcnt->categoria?></td>
        <td class="<?=$tiempcnt->estado?>"><?=$tiempcnt->estado?></td>
        <td><?=$tiempcnt->cantidad?></td>
    </tr>
    <?Php endwhile; ?>
</table>