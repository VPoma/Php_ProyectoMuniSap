<h1>Áreas Municipalidad</h1>

<a href="<?=base_url?>area/registro" class="button button-small">
    Agregar Nuevo
</a>

<?Php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <strong class="alert_green">Área ingresada/modificada Correctamente</strong>
<?Php elseif(isset($_SESSION['register']) && $_SESSION['register'] != 'complete'): ?>
    <strong class="alert_red">Error: Introduce bien los datos</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('register');?>

<?Php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">Área Eliminada correctamente</strong>
<?Php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El Área NO SE HA Eliminado</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('delete');?>

<table class="tablita">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>ACCIONES</th>
        </tr>
    <?Php while($ar= $areas->fetch_object()): ?>
        <tr>
            <td><?=$ar->id; ?></td>
            <td><?=$ar->nombre; ?></td>
            <td><?=$ar->descripcion; ?></td>
            <td>
                <a href="<?=base_url?>area/edit&id=<?=$ar->id?>" class="button button-gestion ">Editar</a>
                <a href="<?=base_url?>area/eliminar&id=<?=$ar->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?Php endwhile; ?>
</table>