<?php

header('Access_Control_Allow_Origin: *');
require_once dirname(__FILE__) . '/config.php';

//connect to database
$link = @mysqli_connect(
                $config['server'], $config['username'], $config['password'], $config['database']
);
if (!$link) {
    die('Error: ' . mysqli_connect_error());
}
