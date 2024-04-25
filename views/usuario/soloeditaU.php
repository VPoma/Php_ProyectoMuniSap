<?Php if(isset($edit) && isset($user) && is_object($user)):?>
    <h1>Edita tus Datos:</h1>
    <?Php $url_action = base_url."usuario/saveuser&id=".$user->id;?>

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
    
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($user) && is_object($user) ? $user->nombre : ''; ?>" required/>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?=isset($user) && is_object($user) ? $user->apellidos : ''; ?>" required/>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=isset($user) && is_object($user) ? $user->email : ''; ?>" required/>

        <label for="imagen">Imágen</label>
        <?Php if(isset($user) && is_object($user) && !empty($user->imagen)): ?>
            <img src="<?=base_url?>uploads/images/<?=$user->imagen?>" class="thumb"/>
        <?Php endif; ?>
        <div class="subeimg">
            <input type="file" name="imagen"/>    
        </div>

        <input type="submit" value="Aceptar" class="button button-small">

        <div class="fila-2">
            <a href="<?=base_url?>" class="button button-small button-red regresar">
                Regresar
            </a>
        </div>

    </form>

<?Php endif;?>
