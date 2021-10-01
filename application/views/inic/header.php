
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <!-- select2 para colocar buscador al select 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    -->
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>materialart/assets/images/favicon.png">
    <title>Sis Ventas</title>
    <link href="<?php echo base_url(); ?>materialart/dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="<?php echo base_url(); ?>materialart/dist/css/pages/data-table.css" rel="stylesheet">
    
    <!-- fuente google font-->
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Lobster&display=swap');

    .titular1{
        font-family: 'Lobster', cursive;
    }

    .parrafo{
        font-family: 'Fredoka One', cursive;
    }


    </style>

    <!-- visualizacion de mapas -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper" id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Material Admin</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <header class="topbar">
            <!-- ============================================================== -->
            <!-- Navbar scss in header.scss -->
            <!-- ============================================================== -->
            <nav>
                <div class="nav-wrapper">
                    <!-- ============================================================== -->
                    <!-- Logo you can find that scss in header.scss -->
                    <!-- ============================================================== -->
                    <a href="javascript:void(0)" class="brand-logo">
                        <span class="icon">
                            <img class="light-logo" src="<?php echo base_url(); ?>materialart/assets/images/logo-light-icon.png">
                            <img class="dark-logo" src="<?php echo base_url(); ?>materialart/assets/images/logo-icon.png">
                        </span>
                        <span class="text">
                            <!-- logo activaCELL 
                            <img class="light-logo"  src="<?php echo base_url(); ?>materialart/assets/images/logo-light-text.png">
                            -->
                            <img class="dark-logo" src="<?php echo base_url(); ?>materialart/assets/images/logo-text.png">
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo you can find that scss in header.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Left topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <ul class="left">
                        <li class="hide-on-med-and-down">
                            <a href="javascript: void(0);" class="nav-toggle">
                                <span class="bars bar1"></span>
                                <span class="bars bar2"></span>
                                <span class="bars bar3"></span>
                            </a>
                        </li>
                        <li class="hide-on-large-only">
                            <a href="javascript: void(0);" class="sidebar-toggle">
                                <span class="bars bar1"></span>
                                <span class="bars bar2"></span>
                                <span class="bars bar3"></span>
                            </a>
                        </li>
                        <li class="search-box">
                            <a href="javascript: void(0);"><i class="material-icons">search</i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Buscar &amp; entrar"> <a class="srh-btn"><i class="fas fa-times"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Left topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    
                    <ul class="right">
                    <!--
                        <li class="lang-dropdown"><a class="dropdown-trigger" href="javascript: void(0);" data-target="lang_dropdown"><i class="flag-icon flag-icon-us"></i></a>
                            <ul id="lang_dropdown" class="dropdown-content">
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-us"></i> English</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-fr"></i> French</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-es"></i> Spanish</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-de"></i> German</a>
                                </li>
                            </ul>
                        </li> del idioma esat oculto
                    -->
                        <!-- ============================================================== -->
                        <!-- Notification icon scss in header.scss -->
                        <!-- ============================================================== -->
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="noti_dropdown"><i class="material-icons">notifications</i></a>
                            <ul id="noti_dropdown" class="mailbox dropdown-content">
                                <li>
                                    <div class="drop-title">Notifications</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large red"><i class="material-icons">link</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Launch Admin</h5>
                                                    <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large blue"><i class="material-icons">date_range</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Event today</h5>
                                                    <span class="mail-desc">Just a reminder that you have event</span>
                                                    <span class="time">9:10 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large cyan"><i class="material-icons">settings</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Settings</h5>
                                                    <span class="mail-desc">You can customize this template as you want</span>
                                                    <span class="time">9:08 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large green"><i class="material-icons">face</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Lily Jordan</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:02 AM</span>
                                                </span>
                                            </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="center-align" href="javascript:void(0);"> <strong>Check all notifications</strong> </a>
                                </li>
                            </ul>
                        </li>

                        <!-- ============================================================== -->
                        <!-- Profile icon scss in header.scss -->
                        <!-- ============================================================== -->
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img src="<?php echo base_url(); ?><?php echo $this->session->userdata('imagen'); ?>" alt="user" class="circle profile-pic"></a>
                            <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="<?php echo base_url(); ?><?php echo $this->session->userdata('imagen'); ?>"></div>
                                        <div class="u-text">
                                            <h4><?php echo $this->session->userdata('login'); ?></h4>
                                            <p><?php echo $this->session->userdata('cargo'); ?></p>
                                            <p><?php echo $this->session->userdata('email'); ?></p>
<!--
                                            <a class="waves-effect waves-light btn-small red white-text">Ver Perfil</a>
-->
                                        </div>
                                    </div>
                                </li>

                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">account_circle</i> Mi Perfil</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">settings</i> Configuración de cuenta</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>login/logout"><i class="material-icons">power_settings_new</i> Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                </div>
            </nav>
            <!-- ============================================================== -->
            <!-- Navbar scss in header.scss -->
            <!-- ============================================================== -->
        </header>
        <!-- ============================================================== -->
        <!-- Sidebar scss in sidebar.scss -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <ul id="slide-out" class="sidenav">
                <li>
                    <ul class="collapsible">
                        <li class="small-cap"><span class="hide-menu">MENU</span></li>

                        <?php 

                            if ($this->session->userdata('Escritorio')==1) { ?>
                        <li>
                            <a href="<?php echo base_url(); ?>tablero" class="collapsible-header has-arrow"><i class="material-icons">dashboard</i><span class="hide-menu"> Escritorio</span></a>
                        </li>
                            <?php } ?>
                        

                        <?php 
                            if ($this->session->userdata('Almacen')==1) {
                                ?>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">account_balance</i><span class="hide-menu">Almacen</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>articulos"><i class="material-icons">dehaze</i><span class="hide-menu">Artículos</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>capital"><i class="material-icons">dehaze</i><span class="hide-menu">Caja</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>calculadora"><i class="material-icons">dehaze</i><span class="hide-menu">Calcular Descuento</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>diapromo"><i class="material-icons">dehaze</i><span class="hide-menu">Activar dia Promo</span></a></li>
                                    
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                            
                        
                        <?php 
                            if ($this->session->userdata('Compras')==1) { ?>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">shopping_cart</i><span class="hide-menu"> Compras </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>compras"><i class="material-icons">format_align_left</i><span class="hide-menu">Compras</span></a></li>
                                </ul>
                            </div>
                        </li>
                         <?php } ?>

                        <?php 
                            if ($this->session->userdata('Ventas')==1) { ?>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">store</i><span class="hide-menu"> Ventas </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>ventas"><i class="material-icons">format_align_left</i><span class="hide-menu">Ventas</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>creditos"><i class="material-icons">format_align_left</i><span class="hide-menu">Deudas</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>

                        <?php 
                            if ($this->session->userdata('Personas')==1) { ?>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">people_alt</i><span class="hide-menu"> Personas </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>personas"><i class="material-icons">perm_identity</i><span class="hide-menu">Clientes</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>usuarios"><i class="material-icons">account_circle</i><span class="hide-menu">Usuarios</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>precios"><i class="material-icons">account_circle</i><span class="hide-menu">Precios Cliente</span></a></li>
                                    
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                         
                        <?php 
                            if ($this->session->userdata('Acceso')==1) { ?>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">vpn_key</i><span class="hide-menu"> Acceso </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>permisos"><i class="material-icons">format_align_left</i><span class="hide-menu">Permisos</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>

                        <?php 
                            if ($this->session->userdata('Reportes')==1) { ?>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">equalizer</i><span class="hide-menu"> Reportes </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>reportesc"><i class="material-icons">pie_chart</i><span class="hide-menu">Reportes Compras</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>reportes"><i class="material-icons">pie_chart</i><span class="hide-menu">Reportes Ventas</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>reportesvc"><i class="material-icons">pie_chart</i><span class="hide-menu">Reportes Ventas Clientes</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>

<!-- Respaldo porsi, se quitó codigo php, para hacer que funcione
    <ul>
                                    <li><a href="<?php echo base_url(); ?>reportes"><i class="material-icons">pie_chart</i><span class="hide-menu">Reportes</span></a></li>
                                </ul>
-->          

                        

                        
  
                       

                    
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- ============================================================== -->
        <!-- Sidebar scss in sidebar.scss -->
        <!-- ============================================================== -->