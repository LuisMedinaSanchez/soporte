<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="icon" type="image/gif" href="resources/TP.gif" />
        <title>Soporte Transpheric</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>

        <?php if (isset($_GET["view"]) && $_GET["view"] == "home"): ?>
            <link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
            <link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
            <script src='assets/fullcalendar/moment.min.js'></script>
            <script src='assets/fullcalendar/fullcalendar.min.js'></script>
        <?php endif; ?>
    </head>
    <body>
        <?php if (isset($_SESSION["user_id"])): ?>
            <div class="wrapper">

                <div class="sidebar" data-color="blue">
                    <div class="logo">
                        <a href="./" class="simple-text">
                            <img src="resources/logo_TP.png" width="150" alt="" />
                        </a>
                    </div>

                    <div class="sidebar-wrapper">
                        <ul class="nav">
                            <li class="">
                                <a href="./">
                                    <i class="fa fa-home"></i>
                                    <p>Inicio</p>
                                </a>
                            </li>
                            <li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button"  aria-expanded="true"><i class="fa fa-ticket" ></i>Tickets<span class="caret"></span></a>
                                <ul  class="dropdown-menu">
                                    <li><a href="./?view=newticket"><p><i class="fa fa-ticket" ></i>Nuevo</p></a></li>
                                    <li class=""><a href="./?view=ticketspendings"><p><i class="fa fa-clock-o" ></i>Pendientes</p></a></li>
                                    <li class=""><a href="./?view=ticketsdeveloping"><p><i class="fa fa-wrench" ></i>En desarrollo</p></a></li>
                                    <li class=""><a href="./?view=ticketsterminated"><p><i class="fa fa-check-circle" ></i>Terminados</p></a></li>
                                    <li class=""><a href="./?view=ticketscancel"><p><i class="fa fa-times-circle" ></i>Cancelados</p></a></li>
                                </ul>
                            </li>


                            </li>
                            <li>
                                <a href="./?view=projects">
                                    <i class="fa fa-flask"></i>
                                    <p>Proyectos</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button"  aria-expanded="true"><i class="fa fa-th-list" ></i>Catalogos<span class="caret"></span></a>
                                <ul  class="dropdown-menu">
                                    <li ><a href="./?view=categories"><p><i class="fa fa-cogs" ></i>Sistemas</p></a></li>
                                    <li ><a href="./?view=person"><p><i class="fa fa-users" ></i>Solicitantes</p></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="./?view=reports">
                                    <i class="fa fa-area-chart"></i>
                                    <p>Reportes</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="main-panel">
                    <nav class="navbar navbar-transparent navbar-absolute">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="./"><b>Soporte Transpheric</b></a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-user"></i>
                                            &nbsp;<?php echo Core::$user->name . " " . Core::$user->lastname; ?>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="./?view=configuration"><i class="fa fa-key"></i> Cambiar contraseña</a></li>
                                            <li class="divider"></li>
                                            <li><a href="./?view=users" ><i class="fa fa-users"></i> Usuarios</a></li>
                                            <li class="divider"></li>
                                            <li><a href="./?view=usersperfil" ><i class="fa fa-key"></i> Perfiles</a></li>
                                            <li class="divider"></li>
                                            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Salir</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <!--    DEJO UN BOTONCITO DE BUSQUEDA POR SI CRESE MUCHO EL PORTAL
                                            <form class="navbar-form navbar-right" role="search">
                                              <div class="form-group  is-empty">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <span class="material-input"></span>
                                              </div>
                                              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                                <i class="fa fa-search"></i><div class="ripple-container"></div>
                                              </button>
                                            </form>
                                -->
                            </div>
                        </div>
                    </nav>

                    <div class="content">
                        <div class="container-fluid">
                            <?php
                            // puedo cargar otras funciones iniciales
                            // dentro de la funcion donde cargo la vista actual
                            // como por ejemplo cargar el corte actual
                            View::load("login");
                            ?>
                        </div>
                    </div>

                    <footer class="footer">
                        <div class="container-fluid">
                            <nav class="pull-left">
                                <ul>
                                    <li>
                                        <a href="http://www.transpheric.com/" target="_blank">
                                            Transpheric.com
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <p class="copyright pull-right">
                                <a href="mailto:soporte@transpheric.com" target="_blank">Luis Medina</a> &copy; 2016 TC-F-BV-01, Octubre 2018, Rev. 1 
                            </p>
                        </div>
                    </footer>
                </div>
            </div>
        <?php else: ?>
            <?php
            View::load("login");
            ?>

        <?php endif; ?>
    </body>

    <!--   Core JS Files   -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/material.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Material Dashboard javascript methods -->
    <script src="assets/js/material-dashboard.js"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>

</html>
