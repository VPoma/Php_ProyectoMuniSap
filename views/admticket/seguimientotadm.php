<?Php if(isset($follow) && isset($tic) && is_object($tic)):?>
    <h1>Vista de Seguimiento de Ticket N° <?=$tic->id?></h1>
<?Php else:?>
    <?Php require_once 'views/admticket/gestiontadm.php'; ?>
<?Php endif;?>

<label class="newc newct" for="">Fecha de Apertura : <?=$tic->fecha_ini?></label>
<label class="newc newct newcta" for="">Ultima Fecha de Modificación : <?=$tic->fecha_fin?></label>

<div class="fila-2">
    <a href="<?=base_url?>ticket/gestionadm" class="button button-small button-red derech">
        Regresar
    </a>
</div>

    <table class="tablaseg">
        <tr>
            <th class="t-i t-i-1">▀ Asunto del Ticket</th>
            <th class="t-d">▀ Usuario</th>
        </tr>
        <tr>
            <td class="t-i"> ○ <?=$tic->asunto?></td>
            <td class="t-d"> ○ <?=$tic->nombreu?> <?=$tic->apellidosu?></td>
        </tr>
        <tr>
            <th class="t-i t-i-1">▀ Descripción</th>
            <th class="t-d">▀ Categoria</th>
        </tr>
        <tr>
            <td class="t-i"> ○ <?=$tic->descripcion?></td>
            <td class="t-d"> ○ <?=$tic->categoria?></td>
        </tr>
        <tr>
            <th class="t-i t-i-1">▀ Estado</th>
            <th class="t-d">▀ Deisgnado a</th>
        </tr>
        <tr>              
            <td class="<?=$tic->estado?> t-i"> ○ <?=$tic->estado?></td>
            <td class="t-d"> ○ <?=$tic->nombree?> <?=$tic->apellidose?></td>
        </tr>
    </table>

<br>
<h2 class="comenta">Comentarios</h2>
<br>

    <table class="tablacom">
        <?Php while($com = $coment->fetch_object()): ?>
            <tr>
                <th class="t-ii"><?=$com->nombreu?> <?=$com->apellidosu?></th>
                <th class="t-dd"><?=$com->fecha?> - <?=$com->hora?></th>
            </tr>
            <tr>
                <td class="t-ii t-b" colspan="2"> ○ <?=$com->mensaje?></td>
                <!--LA PROPIEDAD "COLSPAN" UNE FILAS(horizontal)-->
                <!--LA PROPIEDAD "ROWSPAN" UNE COLUMNAS(vertical)-->
                <!--<td class="t-ii t-b">○</td>-->
            </tr>
        <?Php endwhile; ?>
    </table>
