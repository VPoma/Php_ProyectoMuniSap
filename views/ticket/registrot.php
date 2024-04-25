<?Php if(isset($edit) && isset($tic) && is_object($tic)):?>
    <h1>Editar Ticket: <?=$tic->asunto?></h1>
    <?Php $url_action = base_url."ticket/save&id=".$tic->id;?>
<?Php else:?>
    <h1>Ticket</h1>
    <?Php $url_action = base_url."ticket/save";?>
<?Php endif;?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

    <input type="hidden" value="<?=$_SESSION['identity']->id?>" name="usuario"/>

    <label for="asunto">Asunto</label>
    <input type="text" name="asunto" value="<?=isset($tic) && is_object($tic) ? $tic->asunto : ''; ?>" required/>

    <label for="categoria">Categoria</label>
    <?Php $categorias = utils::showCatTick(); ?>
    <select name="categoria" id="">
        <?Php while($cat = $categorias->fetch_object()): ?>
            <option value="<?=$cat->id?>" <?=isset($tic) && is_object($tic) && $cat->id == $tic->id_categoria ? 'selected' : ''; ?>>
                <?=$cat->nombre?>
            </option>
        <?Php endwhile; ?>
    </select>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion"><?=isset($tic) && is_object($tic) ? $tic->descripcion : ''; ?></textarea>

    <input type="submit" value="Aceptar" class="button button-small">

    <div class="fila-2">
        <a href="<?=base_url?>ticket/gestion" class="button button-small button-red regresar">
            Regresar
        </a>
    </div>

</form>