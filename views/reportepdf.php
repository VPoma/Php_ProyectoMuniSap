<?Php
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $i = $_GET['i'];
    $d = $_GET['d'];
    $f1 = $_GET['fech1'];
    $f2 = $_GET['fech2'];

    $db = new mysqli('localhost', 'root', '', 'muni_ticket');
    mysqli_query($db,"SET NAMES 'utf8'");

    if(isset($i)){//Personal
        $resum = mysqli_query($db, "SELECT c.nombre as 'categoria', t.estado as 'estado', COUNT(t.id) as 'cantidad' FROM tickets t "
                                        . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_upersonal = '$i' AND fecha_ini BETWEEN '$f1' AND '$f2' GROUP BY t.estado DESC");
        $total = mysqli_query($db, "SELECT COUNT(id_categoria) AS 'total' FROM tickets WHERE id_upersonal = '$i' AND fecha_ini BETWEEN '$f1' AND '$f2'");
        //$report = mysqli_query($db, "SELECT * FROM tickets WHERE id_upersonal = '$i' AND fecha_ini BETWEEN '$f1' AND '$f2' ORDER BY id DESC");
        $report = mysqli_query($db, "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose', " 
                                        . "c.nombre as 'categoria' FROM tickets t INNER JOIN usuarios u ON u.id = t.id_usuario "
                                        . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal INNER JOIN categorias c ON c.id = t.id_categoria "
                                        . "WHERE id_upersonal = '$i' AND fecha_ini BETWEEN '$f1' AND '$f2' ORDER BY id DESC");
    }elseif(isset($d)){//Usuario
        $resum = mysqli_query($db, "SELECT c.nombre as 'categoria', t.estado as 'estado', COUNT(t.id) as 'cantidad' FROM tickets t "
                                        . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE t.id_usuario = '$d' AND fecha_ini BETWEEN '$f1' AND '$f2' GROUP BY t.estado DESC");

        $total = mysqli_query($db, "SELECT COUNT(id_categoria) AS 'total' FROM tickets WHERE id_usuario = '$d' AND fecha_ini BETWEEN '$f1' AND '$f2'");
        //$report = mysqli_query($db, "SELECT * FROM tickets WHERE id_usuario = '$d' AND fecha_ini BETWEEN '$f1' AND '$f2' ORDER BY id DESC");
        $report = mysqli_query($db, "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose', " 
                                        . "c.nombre as 'categoria' FROM tickets t INNER JOIN usuarios u ON u.id = t.id_usuario "
                                        . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal INNER JOIN categorias c ON c.id = t.id_categoria "
                                        . "WHERE id_usuario = '$d' AND fecha_ini BETWEEN '$f1' AND '$f2' ORDER BY id DESC");
    }else{//Admin
        $resum = mysqli_query($db, "SELECT c.nombre as 'categoria', t.estado as 'estado', COUNT(t.id) as 'cantidad' FROM tickets t "
                                        . "INNER JOIN categorias c ON c.id = t.id_categoria WHERE fecha_ini BETWEEN '$f1' AND '$f2' GROUP BY t.estado DESC");

        $total = mysqli_query($db, "SELECT COUNT(id_categoria) AS 'total' FROM tickets WHERE fecha_ini BETWEEN '$f1' AND '$f2'");                                
        //$report = mysqli_query($db, "SELECT * FROM tickets WHERE fecha_ini BETWEEN '$f1' AND '$f2' ORDER BY id DESC");
        $report = mysqli_query($db, "SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose', " 
                                        . "c.nombre as 'categoria' FROM tickets t INNER JOIN usuarios u ON u.id = t.id_usuario "
                                        . "INNER JOIN usuarios ue ON ue.id = t.id_upersonal INNER JOIN categorias c ON c.id = t.id_categoria "
                                        . "WHERE fecha_ini BETWEEN '$f1' AND '$f2' ORDER BY id DESC");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte</title>
        <style type="text/css">
            .b{
                margin-top: 5px;
                margin-left: 8px;
                margin-right: 8px;
                margin-bottom: 5px;
            }
            .cabe{
                color: white;
                font-size: 30px;
                font-weight:bold;
                background-color: #26286b;
                font-family: Helvetica;
                padding-bottom: 10px;
                padding-top: 10px;
                padding-left: 10px;
            }
            
            h1{
                font-weight:bold;
                color: #26286b;
                text-align: center;
            }

            h2{
                margin-top: -5px;
                text-align: center;
                font-family: courier;
                color: #777be8;
            }

            .total{
                margin-left: 225px;
                margin-top: 5px;
                font-size: 18px;
                font-weight:bold;
                font-family: courier;
                color: #26286b;
            }
            
            p{
                font-size: 18px;
                font-family: courier;
                color: #26286b;
            }

            /*Tabla Resumen*/
            .tablersm{
                margin-left: 225px;
                text-align: center;
                /*border-bottom: 1px solid #b8b9e3;*/
            }

            .tablersm th{
                color: white;
                background-color: #333691;
            }

            .tablersm td{
                color: #26286b;
            }

            /*Tabla Reporte*/
            .tablerep{
                text-align: center;
                font-size: 12px;
                /*border-bottom: 1px solid #b8b9e3;*/
            }

            .tablerep th{
                color: white;
                font-weight:bold;
                background-color: #333691;
                padding-top: 10px;
                padding-bottom: -5px;
            }

            .tablerep td{
                color: #26286b;
            }
            
        </style>
    </head>
    <body>
        <div class="b">
            <div class="cabe">
                <img src="../assets/images/EscudoM.jpg"> MUNICIPALIDAD DISTRITAL DE SAPALLANGA 
            </div>
            <h1>Reporte de Tickets de Soporte Informático</h1>
            <h2>Del <?=$f1?> al <?=$f2?></h2>
            <h2>Usuario: <?=$nombre?> <?=$apellidos?></h2>
            <p>
                &nbsp;Cantidad de Tickets por Estado y Categoria :
            </p>
            <table class="tablersm">
                    <tr>
                        <th style="width:120px;">Estado</th>
                        <th style="width:100px;">Categoria</th>
                        <th style="width:80px;">Tickets</th>
                    </tr>
                <?Php while($rsm = mysqli_fetch_assoc($resum)): ?>
                    <tr>
                        <td style="width:120px;"><?=$rsm['estado']?></td>
                        <td style="width:100px;"><?=$rsm['categoria']?></td>
                        <td style="width:80px;"><?=$rsm['cantidad']?></td>
                    </tr>
                <?Php endwhile; ?>
            </table>
            <?Php $tot = mysqli_fetch_assoc($total) ?>
            <label class="total">&nbsp;&nbsp; TOTAL DE TICKETS: &nbsp;&nbsp;&nbsp;&nbsp;<?=$tot['total']?></label>
            <br><br>        
            <p>
                &nbsp;Reporte de Tickets de Atención de Soporte Informatico:
            </p>
            <table class="tablerep">
                    <tr>
                        <th style="width:13px; height:25px;">N°</th>
                        <th style="width:62px; height:25px;">Apertura</th>
                        <th style="width:90px; height:25px;">Asunto</th>
                        <th style="width:175px; height:25px;">Descripción</th>
                        <th style="width:60px; height:25px;">Usuario</th>
                        <th style="width:60px; height:25px;">Categoria</th>
                        <th style="width:60px; height:25px;">Personal</th>
                        <th style="width:80px; height:25px;">Modificación</th>
                        <th style="width:73px; height:25px;">Estado</th>
                    </tr>
                <?Php while($rpt = mysqli_fetch_assoc($report)): ?>
                    <tr>
                        <td style="width:13px; height:55px;"><?=$rpt['id']?></td>
                        <td style="width:62px; height:55px;"><?=$rpt['fecha_ini']?></td>
                        <td style="width:90px; height:55px;"><?=$rpt['asunto']?></td>
                        <td style="width:175px; height:55px;"><?=$rpt['descripcion']?></td>
                        <td style="width:60px; height:55px;"><?=$rpt['nombreu']?> <?=$rpt['apellidosu']?></td>
                        <td style="width:60px; height:55px;"><?=$rpt['categoria']?></td>
                        <td style="width:60px; height:55px;"><?=$rpt['nombree']?> <?=$rpt['apellidose']?></td>
                        <td style="width:80px; height:55px;"><?=$rpt['fecha_fin']?></td>
                        <td style="width:73px; height:55px;"><?=$rpt['estado']?></td>
                    </tr>
                <?Php endwhile; ?>
            </table>
        </div>
    </body>
</html>