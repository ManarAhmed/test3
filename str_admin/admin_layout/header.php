<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
        <meta name="author" content="GeeksLabs">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Ewest Store Admin</title>

        <!-- Bootstrap CSS -->    
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/bootstrap-theme.css'; ?>" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/elegant-icons-style.css'; ?>" rel="stylesheet" />
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" />    
        <!-- full calendar css-->
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css'; ?>" rel="stylesheet" />
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/assets/fullcalendar/fullcalendar/fullcalendar.css'; ?>" rel="stylesheet" />
        <!-- easy pie chart-->
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css'; ?>" rel="stylesheet" type="text/css" media="screen"/>
        <!-- owl carousel -->
        <link rel="stylesheet" href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/owl.carousel.css'; ?>" type="text/css">
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/jquery-jvectormap-1.2.2.css'; ?>" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/fullcalendar.css'; ?>">
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/widgets.css'; ?>" rel="stylesheet">
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/style.css'; ?>" rel="stylesheet">
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/style-responsive.css'; ?>" rel="stylesheet" />
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/xcharts.min.css'; ?>" rel=" stylesheet">	
        <link href="<?php echo '/' . substr(__DIR__, '-27', '-17') . '/vendor/admin/css/jquery-ui-1.10.4.min.css'; ?>" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
          <script src="js/lte-ie7.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">
            <!--header start-->
            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
                </div>

                <!--logo start-->
                <a href="index.html" class="logo">Ewest <span class="lite">Admin</span></a>
                <!--logo end-->

                <div class="top-nav notification-row">                
                    <!-- notificatoin dropdown start-->
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="profile-ava">
                                    <img alt="" src="../vendor/admin/img/avatar1_small.jpg">
                                </span>
                                <span class="username">Manar Ahmed</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li class="eborder-top">
                                    <a href="#"><i class="icon_profile"></i> My Profile</a>
                                </li>
                                <li>
                                    <a href="login.html"><i class="icon_key_alt"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!-- notificatoin dropdown end-->
                </div>
            </header>      
            <!--header end-->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu">                
                        <li class="active">
                            <a class="" href="index.php">
                                <i class="icon_house_alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>Store</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="ma_store/index.php">show store</a></li>                          
                                <li><a class="" href="ma_store/new.php">add to store</a></li>
                            </ul>
                        </li> 
                        <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>Require</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="ma_required/index.php">show required</a></li>                          
                                <li><a class="" href="ma_required/new.php">add to required</a></li>
                            </ul>
                        </li> 
                        <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>Manufacturer</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="ma_manufacturer/index.php">show manufacturers</a></li>                          
                                <li><a class="" href="ma_manufacturer/new.php">add to manufacturers</a></li>
                            </ul>
                        </li> 
                        <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>Distributor</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="ma_distributer/index.php">show distributors</a></li>                          
                                <li><a class="" href="ma_distributer/new.php">add to distributors</a></li>
                            </ul>
                        </li> 

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->