<?Php if(isset($edit) && isset($user) && is_object($user)):?>
    <h1>Edita tus Datos:</h1>
    <?Php $url_action = base_url."usuario/savepass&id=".$user->id;?>

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
    
        <label for="password">Password</label>
        <input type="password" name="password" value="<?=isset($user) && is_object($user) ? $user->password : ''; ?>" required/>

        <input type="submit" value="Aceptar" class="button button-small">

        <div class="fila-2">
            <a href="<?=base_url?>" class="button button-small button-red regresar">
                Regresar
            </a>
        </div>

    </form>

<?Php endif;?>
