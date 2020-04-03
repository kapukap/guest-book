<?php

require_once '../config.php';


$query = "UPDATE comments SET comment=:comment WHERE comment_id=:comment_id";
$stmt= $conn->prepare($query);
$stmt->execute(array('comment'=> $_POST['user_text'], 'comment_id'=>$_POST['comment_id']));


header("Location: http://guestbook.loc/app/php/autorized.php");

