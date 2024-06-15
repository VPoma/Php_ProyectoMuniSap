<?Php if(isset($edit) && isset($tic) && is_object($tic)):?>
    <h1>Editar Ticket: <?=$tic->asunto?></h1>
    <?Php $url_action = base_url."ticket/save&id=".$tic->id;?>
<?Php else:?>
    <h1>Ticket</h1>
    <?Php $url_action = base_url."ticket/save";?>
<?Php endif;?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

    <input type="hidden" value="<?=$_SESSION['identity']->id?>" name="usuario"/>

    <!-- Problemas Frecuentes-->
    <label for="asunto">¿Problemas Adversos?</label>
    <div style="display: flex;">
        <select name="asunto" id="caja1" class="selectprob" disabled>
            <option value="Teclado Inoperativo">Teclado Inoperativo</option>
            <option value="Mouse Inoperativo">Mouse Inoperativo</option>
        </select>
        
        <input type="hidden" id="caja2" value="Problemas Adversos" name="descripcion" disabled/>

        <input type="button" value="Activar" class="button" style="padding: 4px; margin-left: 5px;" onclick="activarcaja()">
        <input type="button" value="Desactv" class="button" style="padding: 4px; margin-left: 4px; background: rgb(243, 136, 5); border: 1px solid rgb(243, 136, 5);" onclick="desactivarcaja()">
    </div>
    <!---->

    <label for="asunto">Asunto</label>
    <input type="text" name="asunto" id="caja3" value="<?=isset($tic) && is_object($tic) ? $tic->asunto : ''; ?>" required/>

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
    <textarea id="caja4" name="descripcion" required><?=isset($tic) && is_object($tic) ? $tic->descripcion : ''; ?></textarea>

    <input type="submit" value="Aceptar" class="button button-small">

    <div class="fila-2">
        <a href="<?=base_url?>ticket/gestion" class="button button-small button-red regresar">
            Regresar
        </a>
    </div>

</form>

<script type="text/javascript">
    function activarcaja(){
        document.getElementById('caja1').disabled=false
        document.getElementById('caja2').disabled=false
        document.getElementById('caja3').disabled=true
        document.getElementById('caja4').disabled=true
    }
    function desactivarcaja(){
        document.getElementById('caja1').disabled=true
        document.getElementById('caja2').disabled=true
        document.getElementById('caja3').disabled=false
        document.getElementById('caja4').disabled=false
    }
</script>