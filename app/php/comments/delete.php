<?php

require_once '../config.php';


if (isset( $_GET[key($_GET)] )){
    $query = "DELETE FROM comments WHERE (comment_id = :comment and user_id= :session_id)";
    $stmt = $conn->prepare($query);
    $stmt->execute(array('comment'=> key($_GET), 'session_id'=>$_SESSION['user_id']));
}

header('Location: http://guestbook.loc/app/php/autorized.php');



