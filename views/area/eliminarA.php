<?Php if(isset($delete) && isset($are) && is_object($are)):?>
    <h1>Área: <?=$are->nombre?></h1>
    <?Php $url_action = base_url."area/delete&id=".$are->id;?>
<?Php else:?>
    <?Php require_once 'views/area/gestionA.php'; ?>
<?Php endif;?>


<h2>¿Esta seguro que desea eliminar esta Área?</h2>

<br>

<div class="fila-1">
    <a href="<?=$url_action?>" class="button button-small button-f">
        SI
    </a>

    <a href="<?=base_url?>area/gestion" class="button button-small button-red">
        NO
    </a>
</div>