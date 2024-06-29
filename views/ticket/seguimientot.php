<?Php if(isset($follow) && isset($tic) && is_object($tic)):?>
    <h1>Seguimiento de Ticket N° <?=$tic->id?></h1>
<?Php else:?>
    <?Php require_once 'views/ticket/gestiont.php'; ?>
<?Php endif;?>

<label class="newc newct" for="">Fecha de Apertura : <?=$tic->fecha_ini?></label>
<label class="newc newct newcta" for="">Ultima Fecha de Modificación : <?=$tic->fecha_fin?></label>

<div class="fila-2">
    <a href="<?=base_url?>ticket/gestion" class="button button-small button-red derech">
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
            <?Php if(isset($_SESSION['admin']) || isset($_SESSION['employed'])): ?>
            <td class="t-ses">
                <form action="<?=base_url?>ticket/savee" method="POST" enctype="multipart/form-data">

                    <input type="hidden" value="<?=$tic->id?>" name="id_ticket"/>

                    <div class="fila-3">
                        <Select class="est <?=$tic->estado?>" name="estado">
                            <option class="PENDIENTE" value="PENDIENTE" <?=isset($tic) && is_object($tic) && $tic->estado == "PENDIENTE" ?  'selected' : ''; ?>>
                                PENDIENTE
                            </option>
                            <option class="PROCESO" value="PROCESO" <?=isset($tic) && is_object($tic) && $tic->estado == "PROCESO" ?  'selected' : ''; ?>>
                                PROCESO
                            </option>
                            <option class="ATENDIDO" value="ATENDIDO" <?=isset($tic) && is_object($tic) && $tic->estado == "ATENDIDO" ?  'selected' : ''; ?>>
                                ATENDIDO
                            </option>
                            <option class="CERRADO" value="CERRADO" <?=isset($tic) && is_object($tic) && $tic->estado == "CERRADO" ?  'selected' : ''; ?>>
                                CERRADO
                            </option>
                        </Select>

                        <input type="submit" value="Aceptar" class="button button-small btn-coment">
                    </div>
                </form>
            </td>
            <?Php endif; ?>

            <?Php if(!isset($_SESSION['admin']) && !isset($_SESSION['employed'])): ?>
            <td class="<?=$tic->estado?> t-i"> ○ <?=$tic->estado?></td>
            <?Php endif; ?>
            <td class="t-d"> ○ <?=$tic->nombree?> <?=$tic->apellidose?></td>
        </tr>
    </table>

<br>
<h2 class="comenta">Comentarios</h2>

    <form action="<?=base_url?>ticket/savec" method="POST" enctype="multipart/form-data">

        <input type="hidden" value="<?=$tic->id?>" name="ticket"/>

        <input type="hidden" value="<?=$_SESSION['identity']->id?>" name="usuario"/>

        <label class="newc" for="">Nuevo Comentario: </label>

        <div class="fila-3">
            <textarea class="com" name="mensaje"></textarea>
            <input type="submit" value="Aceptar" class="button button-small btn-coment">
        </div>
    </form>

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
