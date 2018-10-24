<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Compras y Ventas | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/alertify/themes/alertify.core.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/alertify/themes/alertify.default.css">

      <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/Ionicons/css/ionicons.min.css">
     <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- DataTables Export-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables-export/css/buttons.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css">
    <!--Select 2-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/skins/_all-skins.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/sweetalert/sweetalert.css">
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/jquery/jquery-confirm.min.css">
    
    <style>
        .menu-notificaciones li{
            padding: 7px;
        }
        .menu-notificaciones li span a{
            text-decoration: : none;
            color: #BDBBBA;
        }
        .menu-notificaciones li span a:hover{
            color: #848484;
        }
        .navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a, .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a, .navbar-nav>.tasks-menu>.dropdown-menu>li .menu>li>a{
            white-space: normal;
        }
       
        .contenido{
            width: 280px;
        }
        .contenido label{
            margin-bottom: 0px;
        }
        .contenido p{
            margin: 0px;
        }
        .impresion{
            padding: 10px;
        }
        @page { size: auto;  margin: 0mm;}
        @media (max-width: 480px) {
            .input-cantidad {
                width: 60px !important;
            }
        }
    </style>
    <!-- jQuery 3 -->
    <script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/sweetalert/sweetalert.min.js"></script>
</head>
<body class="hold-transition skin-black sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>G</b>C</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Compras y Ventas</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <?php echo $this->backend_lib->notificaciones();?>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url()?>assets/template/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata("nombre")?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url()?>assets/template/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" text-align="center">
                <p>
                 <span text-align="center" class="hidden-xs"><?php echo $this->session->userdata("nombre")?></span>  
                </p>
                 <p><small>Sistema de Compras y Ventas con Control de Inventario</small></p>
                <br>
                 <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>auth/logout" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
                    </li>
                                   
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>