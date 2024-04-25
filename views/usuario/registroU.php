<?Php if(isset($edit) && isset($user) && is_object($user)):?>
    <h1>Editar Usuario: <?=$user->nombre?> <?=$user->apellidos?></h1>
    <?Php $url_action = base_url."usuario/save&id=".$user->id;?>
<?Php else:?>
    <h1>Registro de Usuarios</h1>
    <?Php $url_action = base_url."usuario/save";?>
<?Php endif;?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($user) && is_object($user) ? $user->nombre : ''; ?>" required/>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" value="<?=isset($user) && is_object($user) ? $user->apellidos : ''; ?>" required/>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?=isset($user) && is_object($user) ? $user->email : ''; ?>" required/>

    <label for="password">Password</label>
    <input type="password" name="password" value="<?=isset($user) && is_object($user) ? $user->password : ''; ?>" required/>
    
    <!--LLENAR SELECTBOX BD-->
    <label for="area">Área</label>
    <?Php $areas = utils::showAreas(); ?>
    <Select name="area" id="">
        <?Php while($ar = $areas->fetch_object()): ?>
        <option value="<?=$ar->id?>" <?=isset($user) && is_object($user) && $ar->id == $user->id_area ? 'selected' : ''; ?>>
            <?=$ar->nombre?>
        </option>
        <?Php endwhile; ?>
    </Select>

    <label for="tipo">Tipo de Usuario</label>
    <Select name="tipo">
        <option value="user" <?=isset($user) && is_object($user) && $user->tipo == "user" ?  'selected' : ''; ?>>
            Usuario
        </option>
        <option value="employed" <?=isset($user) && is_object($user) && $user->tipo == "employed" ?  'selected' : ''; ?>>
            Empleado
        </option>
        <option value="admin" <?=isset($user) && is_object($user) && $user->tipo == "admin" ?  'selected' : ''; ?>>
            Administrador
        </option>
    </Select>

    <!--LLENAR SELECTBOX BD-->
    <label for="categoria">Categoria</label>
    <?Php $categorias = utils::showCategorias(); ?>
    <select name="categoria" id="">
        <?Php while($cat = $categorias->fetch_object()): ?>
            <option value="<?=$cat->id?>" <?=isset($user) && is_object($user) && $cat->id == $user->id_categoria ? 'selected' : ''; ?>>
                <?=$cat->nombre?>
            </option>
        <?Php endwhile; ?>
    </select>

    <label for="imagen">Imágen</label>
    <?Php if(isset($user) && is_object($user) && !empty($user->imagen)): ?>
        <img src="<?=base_url?>uploads/images/<?=$user->imagen?>" class="thumb"/>
    <?Php endif; ?>
    <div class="subeimg">
        <input type="file" name="imagen"/>    
    </div>

    <input type="submit" value="Aceptar" class="button button-small">

    <div class="fila-2">
        <a href="<?=base_url?>usuario/gestion" class="button button-small button-red regresar">
            Regresar
        </a>
    </div>

</form>