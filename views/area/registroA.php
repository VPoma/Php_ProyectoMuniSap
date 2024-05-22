<?Php if(isset($edit) && isset($are) && is_object($are)):?>
    <h1>Editar Área: <?=$are->nombre?></h1>
    <?Php $url_action = base_url."area/save&id=".$are->id;?>
<?Php else:?>
    <h1>Registro de Areas Municipales</h1>
    <?Php $url_action = base_url."area/save";?>
<?Php endif;?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($are) && is_object($are) ? $are->nombre : ''; ?>" required/>
    
    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" required><?=isset($are) && is_object($are) ? $are->descripcion : ''; ?></textarea>
    <!--<input type="text" name = "descripcion" value=" entra la condicion de $area->descripcion">-->

    <input type="submit" value="Aceptar" class="button button-small">

    <div class="fila-2">
        <a href="<?=base_url?>area/gestion" class="button button-small button-red regresar">
            Regresar
        </a>
    </div>

</form>