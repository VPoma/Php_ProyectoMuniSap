<?Php if(isset($delete) && isset($cat) && is_object($cat)):?>
    <h1>Categoria: <?=$cat->nombre?></h1>
    <?Php $url_action = base_url."categoria/delete&id=".$cat->id;?>
<?Php else:?>
    <?Php require_once 'views/categoria/gestionCa.php'; ?>
<?Php endif;?>


<h2>¿Esta seguro que desea eliminar esta Categoría?</h2>

<br>

<div class="fila-1">
    <a href="<?=$url_action?>" class="button button-small button-f">
        SI
    </a>

    <a href="<?=base_url?>categoria/gestion" class="button button-small button-red">
        NO
    </a>
</div>