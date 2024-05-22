<?Php if(isset($edit) && isset($cat) && is_object($cat)):?>
    <h1>Editar Categoría: <?=$cat->nombre?></h1>
    <?Php $url_action = base_url."categoria/save&id=".$cat->id;?>
<?Php else:?>
    <h1>Registro de Categorias - Soporte Informático</h1>
    <?Php $url_action = base_url."categoria/save";?>
<?Php endif;?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($cat) && is_object($cat) ? $cat->nombre : ''; ?>" required/>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" required><?=isset($cat) && is_object($cat) ? $cat->descripcion : ''; ?></textarea>
    <!--<input type="text" name = "descripcion" value=" entra la condicion de $area->descripcion">-->

    <input type="submit" value="Aceptar" class="button button-small">

    <div class="fila-2">
        <a href="<?=base_url?>categoria/gestion" class="button button-small button-red regresar">
            Regresar
        </a>
    </div>

</form>