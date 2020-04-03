<?php

require_once '../config.php';
//session_destroy();
////die($_SESSION);
//header("Location: http://guestbook.loc/app/php/");

if(!empty($_SESSION['user_id'])) {

    session_unset();
    session_destroy();

}

header("Location:http://guestbook.loc/app/php/auth/login.php");
?>