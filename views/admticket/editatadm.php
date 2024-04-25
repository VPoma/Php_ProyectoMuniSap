<?Php if(isset($edit) && isset($tic) && is_object($tic)):?>
    <h1>Edición Completa Ticket: <?=$tic->id?></h1>
    <?Php $url_action = base_url."ticket/savetadm&id=".$tic->id;?>

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

        <label for="usuario">Usuario</label>
        <?Php $usuarios= utils::showUsuario(); ?>
        <select name="usuario" id="">
            <?Php while($usu = $usuarios->fetch_object()): ?>
                <option value="<?=$usu->id?>" <?=isset($tic) && is_object($tic) && $usu->id == $tic->id_usuario ? 'selected' : ''; ?>>
                    <?=$usu->nombre?> <?=$usu->apellidos?>
                </option>
            <?Php endwhile; ?>
        </select>
    
        <label for="categoria">Categoria</label>
        <?Php $categorias = utils::showCatTick(); ?>
        <select name="categoria" id="">
            <?Php while($cat = $categorias->fetch_object()): ?>
                <option value="<?=$cat->id?>" <?=isset($tic) && is_object($tic) && $cat->id == $tic->id_categoria ? 'selected' : ''; ?>>
                    <?=$cat->nombre?>
                </option>
            <?Php endwhile; ?>
        </select>

        <label for="personal">Personal</label>
        <?Php $personal= utils::showPersonal(); ?>
        <select name="personal" id="">
            <?Php while($per = $personal->fetch_object()): ?>
                <option value="<?=$per->id?>" <?=isset($tic) && is_object($tic) && $per->id == $tic->id_upersonal ? 'selected' : ''; ?>>
                    <?=$per->nombre?> <?=$per->apellidos?> - <?=$per->catnombre?>
                </option>
            <?Php endwhile; ?>
        </select>

        <label for="asunto">Asunto</label>
        <input type="text" name="asunto" value="<?=isset($tic) && is_object($tic) ? $tic->asunto : ''; ?>" required/>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion"><?=isset($tic) && is_object($tic) ? $tic->descripcion : ''; ?></textarea>

        <label for="estado">Estado</label>
        <Select class="estd <?=$tic->estado?>" name="estado">
            <option class="PENDIENTE" value="PENDIENTE" <?=isset($tic) && is_object($tic) && $tic->estado == "PENDIENTE" ?  'selected' : ''; ?>>
                PENDIENTE
            </option>
            <option class="PROCESO" value="PROCESO" <?=isset($tic) && is_object($tic) && $tic->estado == "PROCESO" ?  'selected' : ''; ?>>
                PROCESO
            </option>
            <option class="ATENDIDO" value="ATENDIDO" <?=isset($tic) && is_object($tic) && $tic->estado == "ATENDIDO" ?  'selected' : ''; ?>>
                ATENDIDO
            </option>
            <option class="CERRADO" value="CERRADO" <?=isset($tic) && is_object($tic) && $tic->estado == "CERRADO" ?  'selected' : ''; ?>>
                CERRADO
            </option>
        </Select>
        <div class="fila-4">
            <label class="timelabel" for="usuario">Modificación</label>
            <input class="time-ed" type="date" name="fechafin" value="<?=isset($tic) && is_object($tic) ? $tic->fecha_fin : ''; ?>" >
        </div>
        <br>
        <input type="submit" value="Aceptar" class="button button-small">

        <div class="fila-2">
            <a href="<?=base_url?>ticket/gestionadm" class="button button-small button-red regresar">
                Regresar
            </a>
        </div>

    </form>

<?Php endif;?>