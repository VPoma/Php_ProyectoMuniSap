<h1>Generar Reporte</h1>

<form action="<?=base_url?>views/reporte.php" method="GET">

    <input type="hidden" value="<?=$_SESSION['identity']->nombre?>" name="nombre"/>

    <input type="hidden" value="<?=$_SESSION['identity']->apellidos?>" name="apellidos"/>

    <?Php if(!isset($_SESSION['admin']) && isset($_SESSION['employed'])): ?>
    <input type="hidden" value="<?=$_SESSION['identity']->id?>" name="i"/>
    <?Php elseif(!isset($_SESSION['admin']) && !isset($_SESSION['employed'])): ?>
    <input type="hidden" value="<?=$_SESSION['identity']->id?>" name="d"/>
    <?Php endif; ?>

    <label class="intrep" style="font-weight:bold; margin-bottom: 10px; font-size: 16px;" for="">
    Intervalo de Fechas:
    </label>

    <div class="fila-3" style="margin-left: 100px;">
        <input type="date" name="fech1" class="fildt" style="margin-top: 17px;">
        <input type="date" name="fech2" class="fildt" style="margin-top: 17px;">
        <input type="submit" value="Crear Reporte" name="crear"/>
    </div>

</form>

<?Php if(isset($_SESSION['admin'])): ?>
<br>
<br>

<h2>Generar Informe</h2>

<form action="<?=base_url?>views/informe.php" method="GET">

    <label for="">Número de Informe</label>
    <input type="text" placeholder="N°" name="a" />

    <label for="">Dirigido a:</label>
    <input type="text" placeholder="A quien ira dirigido" name="b" />

    <label for="">Cargo</label>
    <Select name="cmb">
        <option value="ALCALDE">
            ALCALDE
        </option>
        <option value="GERENTE MUNICIPAL">
            GERENTE MUNICIPAL
        </option>
        <option value="GERENTE DE LOGISTICA">
            GERENTE DE LOGISTICA
        </option>
    </Select>

    <input type="hidden" value="DANIEL ISSAC CONTRERAS PÉREZ" name="c"/>
    <!--<input type="hidden" value=" <?//=$_SESSION['identity']->nombre?> <?//=$_SESSION['identity']->apellidos?>" name="c"/>-->

    <label for="">Asunto:</label>
    <input type="text" placeholder="Asunto a tratar en el Informe" name="d" />
    <!--<textarea name="d" placeholder="Asunto"></textarea>-->

    <label for="">Inicio del Informe: Tengo el honor de dirigirme a Ud con respecto ...</label>
    <input type="text" placeholder="Motivo por el que se realiza el informe" name="e" />

    <label for="">Cuerpo: Parrafo de contenido del Informe</label>
    <textarea name="f" placeholder="Descripción del informe"></textarea>

    <!--
    <label for="">Parrafo Final:</label>
    <textarea name="g" placeholder="Ultimos detalles o conclusiones del informe"></textarea>
    -->

    <input type="submit" value="Crear Informe" name="crear" />

</form>
<?Php endif; ?>
