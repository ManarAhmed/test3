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
                        <?php
                        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                            echo '<li><a href="http://localhost/EwestStore/user/logout.php">Sign out</a></li>';
                        } else {
                            echo '<li><a href="http://localhost/EwestStore/user/login.php">Sign in</a></li>';
                        }
                        ?> 
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div style="height: 20px;"></div>
        <div class="container"><!-- closed in footer.php -->