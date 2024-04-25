<?Php if(isset($delete) && isset($user) && is_object($user)):?>
    <h1>Usuario: <?=$user->nombre?> <?=$user->apellidos?></h1>
    <?Php $url_action = base_url."usuario/delete&id=".$user->id;?>
<?Php else:?>
    <?Php require_once 'views/usuario/gestionU.php'; ?>
<?Php endif;?>


<h2>¿Esta seguro que desea eliminar este Usuario?</h2>

<br>

<div class="fila-1">
    <a href="<?=$url_action?>" class="button button-small button-f">
        SI
    </a>

    <a href="<?=base_url?>usuario/gestion" class="button button-small button-red">
        NO
    </a>
</div>