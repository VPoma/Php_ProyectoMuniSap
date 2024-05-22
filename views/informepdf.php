<?Php
    $a = $_GET['a'];
    $b = $_GET['b'];
    $cmb = $_GET['cmb'];
    $c = $_GET['c'];
    $d = $_GET['d'];
    date_default_timezone_set("America/Lima");
    $fecha = date('d-m-Y');
    $e = $_GET['e'];
    $f = $_GET['f'];
    $g = $_GET['g'];
    //$DateAndTime = date('m-d-Y h:i:s a', time());  
    //echo "The current date and time are $DateAndTime.";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Generar PDF</title>
        <style type="text/css">
            .im{
                margin-left: 0px;
                padding-left: 0px;
                background-image: url(http://localhost/proyectomunisap/assets/images/infm.jpg); 
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                font-size: 13px;
            }
            
            h3{
                text-align: center;
            }

            .just{
                font-size: 13px;
                text-align: justify;

            }
            .izq{
                font-size: 13px;
            }

            .cup{
                margin-top: 20px;
                margin-left: 50px;
                margin-right: 40px;
                margin-bottom: 20px;
            }
            /*
            ul{
                background: green;
                color:white;
            }*/
            
            .firma{
                margin-left: 190px;
                border-top: 1px;
                text-align: center;
                font-size: 13px;
            }

            .e{
                width: 791px;
                height: 90px;
                margin-left: -17.5px;
                margin-top: -17.5px;
            }

            .p{
                width: 791px;
                height: 90px;
                margin-left: -17.5px;
                margin-top: 300px;
            }

            .td{
                font-size: 11px;
            }

            .t1{
                width:80px;
                padding-left: 20px;
            }

            .t2{
                width:500px;
            }

            .t3{
                width:600px;
                padding-left: 20px;
                padding-bottom: 0px;
            }

            .t3_5{
                width:600px;
                padding-left: 20px;
                padding-bottom: 0px;
            }

        </style>
    </head>
    <body class="bo">
        <img class="e" src="../assets/images/infe.jpeg">
        <div class="cup im">
            <h3>INFORME N°<?= $a?>-2024-TIC/DICP/MDS</h3>
                <table class="td">
                    <tr>
                        <td class="t1"><b>A</b></td>
                        <td class="t2">:<b>&nbsp;<?=$b?></b></td>
                    </tr>
                    <tr>
                        <td class="t1"></td>
                        <td class="t2">&nbsp;<?=$cmb?></td>
                    </tr>
                    <tr>
                        <td class="t1"><b>DE</b></td>
                        <td class="t2">:<b>&nbsp;<?=$c?></b></td>
                    </tr>
                    <tr>
                        <td class="t1"></td>
                        <td class="t2">&nbsp; ENCARGADO DE LA U. DE TECNOLOGÍAS DE INFORMACIÓN Y COMUNICACIONES - MDS.</td>
                    </tr>
                    <tr>
                        <td class="t1"><b>ASUNTO</b></td>
                        <td class="t2">:<b>&nbsp;<?=$d?></b></td>
                    </tr>
                    <tr>
                        <td class="t1"><b>REF.</b></td>
                        <td class="t2">:<b>&nbsp;</b></td>
                    </tr>
                    <tr>
                        <td class="t1"><b>FECHA</b></td>
                        <td class="t2">:<b>&nbsp;Sapallanga, <?=$fecha?></b></td>
                    </tr>
                </table>
            
            <hr>

                <table>
                    <tr>
                        <td class="t3_5">
                            <p class="izq">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Tengo el honor de dirigirme a su digna persona y aprovechar la oportunidad para saludarle, 
                                al mismo tiempo informarle con respecto <?=$e?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="t3">
                            <p class="just">
                                <?=$f?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="t3">
                            <p class="just">
                                <?=$g?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="t3">
                            <p class="izq">
                                Es todo en cuanto informo a usted para los fines pertinentes <br><br>
                                Atentamente:
                            </p>
                        </td>
                    </tr>
                </table>

            <br><br><br><br><br>
            <br><br><br><br><br>
            <br><br><br><br><br>
            <br><br><br><br><br>

            <table class="firma">
                <tr>
                    <td><?=$c?></td>
                </tr>
                <tr>
                    <td>(e) Oficina de Tecnología de Información y Comunicación</td>
                </tr>
            </table>
        </div>
        <br>
    </body>
    <footer>
        <div>
            <img class="p" src="../assets/images/infp.jpeg">
        </div>
    </footer>
</html>

