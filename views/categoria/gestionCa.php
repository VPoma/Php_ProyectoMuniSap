<h1>Categorias - Soporte Informático</h1>

<a href="<?=base_url?>categoria/registro" class="button button-small">
    Agregar Nuevo
</a>

<?Php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <strong class="alert_green">Categoría ingresada/modificada Correctamente</strong>
<?Php elseif(isset($_SESSION['register']) && $_SESSION['register'] != 'complete'): ?>
    <strong class="alert_red">Error: Introduce bien los datos</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('register');?>

<?Php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">Categoría Eliminada correctamente</strong>
<?Php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">La Categoría NO SE HA Eliminado</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('delete');?>

<table class="tablita">
    <tr>
        <th>ID</th>
        <th>CATEGORIA</th>
        <th>DESCRIPCIÓN</th>
        <th>ACCIONES</th>
    </tr>
    <?Php while($cat= $categorias->fetch_object()): ?>
    <tr>
        <td><?=$cat->id; ?></td>
        <td><?=$cat->nombre; ?></td>
        <td><?=$cat->descripcion; ?></td>
        <td>
            <a href="<?=base_url?>categoria/edit&id=<?=$cat->id?>" class="button button-gestion ">Editar</a>
            <a href="<?=base_url?>categoria/eliminar&id=<?=$cat->id?>" class="button button-gestion button-red">Eliminar</a>
        </td>
    </tr>
    <?Php endwhile; ?>
    <tr>
        <!--Paginador-->
        <td class="text-center" colspan="4">
        <?Php for($i=1; $i<=$totalPag; $i++): ?>
            <a href="<?=base_url?>categoria/gestion&pag=<?=$i?>"><?=$i?></a> -
        <?Php endfor; ?>
        </td>
    </tr>
</table>