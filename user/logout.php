<?php
session_start() ;
session_destroy() ;
header('Location: http://localhost/EwestStore/user/login.php');
exit();