<h1>Usuarios Municipalidad</h1>

<a href="<?=base_url?>usuario/registro" class="button button-small">
    Agregar Nuevo
</a>

<?Php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):?>
    <strong class="alert_green">Usuario ingresado/modificado Correctamente</strong>
<?Php elseif(isset($_SESSION['register']) && $_SESSION['register'] != 'complete'):?>
    <strong class="alert_red">Error: Introduce bien los datos</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('register');?>

<?Php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">Usuario Eliminado correctamente</strong>
<?Php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El Usuario NO SE HA Eliminado</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('delete');?>

<br>

<form action="<?=base_url?>usuario/filtrousr" method="POST" enctype="multipart/form-data">
    <table class="tablafilt">
        <tr>
            <th>ÁREA</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th rowspan="2"><input type="submit" value="BUSCAR" name="filtro" id="buttonfil"/></th>
        </tr>
        <tr>
            <td>
                <?Php $areas = utils::showAreas(); ?>
                <Select name="area" id="">
                        <option value="" >
                                TODOS
                        </option>
                    <?Php while($ar = $areas->fetch_object()): ?>
                        <option value="<?=$ar->id?>" <?=isset($user) && is_object($user) && $ar->id == $user->id_area ? 'selected' : ''; ?>>
                            <?=$ar->nombre?>
                        </option>
                    <?Php endwhile; ?>
                </Select>
            </td>
            <td><input type="text"  name="nombre" id="filtex"/></td>
            <td><input type="text"  name="apellidos" id="filtex"/></td>
        </tr>
    </table>
</form>

<br>

<table class="tablita">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>CORREO</th>
            <th>ÁREA</th>
            <th>CATEGORIA</th>
            <th>TIPO</th>
            <th>ACCIONES</th>
        </tr>
    <?Php while($user= $usuarios->fetch_object()): ?>
        <tr>
            <td><?=$user->id; ?></td>
            <td><?=$user->nombre; ?></td>
            <td><?=$user->apellidos; ?></td>
            <td><?=$user->email; ?></td>
            <td><?=$user->arnombre; ?></td>
            <td><?=$user->catnombre; ?></td>
            <td><?=$user->tipo; ?></td>
            <td>
                <a href="<?=base_url?>usuario/edit&id=<?=$user->id?>" class="button button-gestion ">Editar</a>
                <a href="<?=base_url?>usuario/eliminar&id=<?=$user->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?Php endwhile; ?>
</table>