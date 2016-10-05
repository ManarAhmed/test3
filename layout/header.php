<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ewest Component Store</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo substr(__DIR__, '-18', '-7') . '/vendor/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo substr(__DIR__, '-18', '-7') . '/vendor/font-awesome/css/font-awesome.min.css'; ?>" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0px;">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://localhost/EwestStore">Ewest Component Store</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://localhost/EwestStore/requests.php">Requests</a></li>
                        <li class="active"><a href="http://localhost/EwestStore/store.php">Store <span class="sr-only">(current)</span></a></li>
                        <li><a href="http://localhost/EwestStore/required.php">Required</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://localhost/EwestStore/store/new.php">Add to store</a></li>
                                <li><a href="http://localhost/EwestStore/required/new.php">Add to required</a></li>
                                <li><a href="http://localhost/EwestStore/distributor/new.php">Add to distributor</a></li>
                                <li><a href="http://localhost/EwestStore/manufacturer/new.php">Add to manufacturer</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="http://localhost/EwestStore/manufacturer.php">Manufacturer</a></li>
                                <li><a href="http://localhost/EwestStore/distributor.php">distributor</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php
                                if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                                    echo $_SESSION['username'];
                                }
                                ?> 
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://localhost/EwestStore/user/profile.php">Show Profile</a></li>
                                <li><a href="http://localhost/EwestStore/user/update_profile.php">Update profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="http://localhost/EwestStore/user/logout.php">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div style="height: 20px;"></div>
        <div class="container"><!-- closed in footer.php -->