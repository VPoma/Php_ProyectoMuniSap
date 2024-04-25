<h1>Administración de Tickets</h1>

<table class="tablatadm">
    <tr>
        <th>Nombre Personal</th>
        <th>Categoría</th>
        <th>N° Tickets</th>
    </tr>
    <?Php while($tiadmcnt= $ticktadmcant->fetch_object()): ?>
    <tr>
        <td><?=$tiadmcnt->nombre?> <?=$tiadmcnt->apellidos?></td>
        <td><?=$tiadmcnt->categoria?></td>
        <td><?=$tiadmcnt->cantidad?></td>
    </tr>
    <?Php endwhile; ?>
</table>

<br>

<h2 class="comenta">Tickets</h2>

<?Php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <strong class="alert_green">Ticket ingresado/modificado Correctamente</strong>
<?Php elseif(isset($_SESSION['register']) && $_SESSION['register'] != 'complete'): ?>
    <strong class="alert_red">Error: Introduce bien los datos</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('register');?>

<?Php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">Ticket Eliminado correctamente</strong>
<?Php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El Ticket NO SE HA Eliminado</strong>
<?Php endif; ?>
<?Php Utils::deleteSession('delete');?>

<br>

<form action="<?=base_url?>ticket/filtrotickadm" method="POST" enctype="multipart/form-data">
    <table class="tablafilt">
        <tr>
            <th>Id</th>
            <th>Usuario (Apellido)</th>
            <th>Personal (Apellido)</th>
            <th rowspan="4"><input type="submit" value="BUSCAR" name="filtro" id="buttonfil"/></th>
        </tr>
        <tr>
            <td><input type="text"  name="id" id="filtex"/></td>
            <td><input type="text"  name="usuario" id="filtex"/></td>
            <td><input type="text"  name="personal" id="filtex"/></td>
        </tr>
        <tr>
            <th>Fecha Inicio (Apertura)</th>
            <th>Categoria</th>
            <th>Estado</th>
        </tr>
        <tr>
        <td><input type="date"  name="fechaini" class="fildt"/></td>
            <td>
                <?Php $categorias = utils::showCatTick(); ?>
                <select class="filselct" name="categoria" id="">
                        <option value="" >
                            TODOS
                        </option>
                    <?Php while($cat = $categorias->fetch_object()): ?>
                        <option value="<?=$cat->id?>" <?=isset($user) && is_object($user) && $cat->id == $user->id_categoria ? 'selected' : ''; ?>>
                            <?=$cat->nombre?>
                        </option>
                    <?Php endwhile; ?>
                </select>
            </td>
            <td>
                <Select class="filselct" name="estado">
                    <option value="" >
                        TODOS
                    </option>
                    <option class="PENDIENTE" value="PENDIENTE" >
                        PENDIENTE
                    </option>
                    <option class="PROCESO" value="PROCESO" >
                        PROCESO
                    </option>
                    <option class="ATENDIDO" value="ATENDIDO">
                        ATENDIDO
                    </option>
                    <option class="CERRADO" value="CERRADO">
                        CERRADO
                    </option>
                </Select>
            </td>       
        </tr>
    </table>
</form>

<br>

<table class="tablita">
        <tr>
            <th class="tbn">N°</th>
            <th class="tbf">APERTURA</th>
            <th>ASUNTO</th>
            <th>DESCRIPCIÓN</th>
            <th>USUARIO</th>
            <th>CATEGORIA</th>
            <th>PERSONAL</th>
            <th class="tbf">MODIFICACIÓN</th>
            <th>ESTADO</th>
            <th>ACCIÓN</th>
        </tr>
    <?Php while($ti= $tickets->fetch_object()): ?>
        <tr>
            <td><?=$ti->id?></td>
            <td><?=$ti->fecha_ini?></td>
            <td><?=$ti->asunto?></td>
            <td><?=$ti->descripcion?></td>
            <td><?=$ti->nombreu?> <?=$ti->apellidosu?></td>
            <td class="tbc"><?=$ti->categoria?></td>
            <td><?=$ti->nombree?> <?=$ti->apellidose?></td>
            <td><?=$ti->fecha_fin?></td>
            <td class="<?=$ti->estado?>"><?=$ti->estado?></td>
            <td>
                <div class="dropdown">
                    <button class="button-select">Acción</button>
                    <div class="dropdown-content">
                        <a class="dd" href="<?=base_url?>ticket/followadm&id=<?=$ti->id?>">Seguimiento</a>
                        <a class="dd" href="<?=base_url?>ticket/editadm&id=<?=$ti->id?>">Editar</a>
                        <a class="dd" href="<?=base_url?>ticket/eliminaradm&id=<?=$ti->id?>">Eliminar</a>
                    </div>
                </div>
            </td>
        </tr>
    <?Php endwhile; ?>
</table>