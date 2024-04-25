<?Php if(isset($delete) && isset($tic) && is_object($tic)):?>
    <h1>Ticket: <?=$tic->asunto?></h1>
    <?Php $url_action = base_url."ticket/delete&id=".$tic->id;?>
<?Php else:?>
    <?Php require_once 'views/ticket/gestiont.php'; ?>
<?Php endif;?>


<h2>¿Esta seguro que desea eliminar este Ticket?</h2>

<br>

<div class="fila-1">
    <a href="<?=$url_action?>" class="button button-small button-f">
        SI
    </a>

    <a href="<?=base_url?>ticket/gestion" class="button button-small button-red">
        NO
    </a>
</div>