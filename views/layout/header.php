<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Soporte Informático MDS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/owl.carousel.min.css">
    <!-- fevicon -->
    <link rel="icon" href="<?=base_url?>assets/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <!--
    <div class="loader_bg">
        <div class="loader"><img src="assets/images/loading.gif" alt="#" /></div>
    </div>
    -->
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="header_to d_none">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <ul class="lan">
                        <li><i class="" aria-hidden="true"></i><img src="<?=base_url?>assets/images/EscudoM.jpg" alt="#" /> Municipalidad Distrital de Sapallanga</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6 ">
                        <ul class="social_icon1">
                            <li> Nuestras Redes Sociales</li>
                            <li> <a href="https://web.facebook.com/municipiosapallanga" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                            <li> <a href="https://www.youtube.com/@Munisapallanga" target="_blank"> <i class="fa fa-youtube"></i></a></li>
                            <li> <a href="https://www.instagram.com/explore/locations/614150092388434/municipalidad-distrital-de-sapallanga/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li> <a href="https://www.tiktok.com/@munisapallanga" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                            </svg></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>

            <div class="header_midil">
            <div class="container">
            <div class="row d_flex">
                <div class="col-md-2 col-sm-2 d_none">
                    <ul class="conta_icon">
                    <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a> </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <!--<a class="logo" href="#"><img src="assets/images/logo.png" alt="#" /></a>-->
                    <ul class="conta_icon">
                    <li><h1 class="h1_titulo">Soporte Informático - Help Desk</h1></li>
                    </ul>
                    <!--
                    <ul class="conta_icon">
                        <li><h1 class="h1_titulo">Soporte Informático - Help Desk</h1></li>
                    </ul>
                    -->
                </div>

            </div>
            </div>
        </div>
        
            <div class="header_bo">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-7">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>"> Inicio </a>
                                </li>

                                <?Php if(isset($_SESSION['identity'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>ticket/registro"> Ticket </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>ticket/gestion"> Seguimiento </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>ticket/reporte"> Reportes </a>
                                </li>
                                <?Php endif; ?>

                                <?Php if(isset($_SESSION['employed'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>ticket/gestionemp"> Resumen </a>
                                </li>
                                <?Php endif; ?>

                                <?Php if(isset($_SESSION['admin'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>ticket/gestionadm"> Adm_Ticket </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>usuario/gestion"> Usuarios </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>area/gestion"> Areas </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url?>categoria/gestion"> Categorias </a>
                                </li>
                                <?Php endif; ?>
                            </ul>
                        </div>
                        </nav>
                    </div>
                    <!--
                    <div class="col-md-3 col-sm-5 d_none">
                        <ul class="sign">
                        <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                        <li><a class="sign_btn" href="#">Login</a></li>
                        </ul>
                    </div>
                    -->
                </div>
            </div>
            </div>
        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->