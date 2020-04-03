<?php

require_once '../config.php';


$error=[];
if (empty($_POST['comment'])){
    $error = 'Text is empty';
}

if (empty($error)){
    $query = "INSERT INTO comments (user_id, comment) VALUES (:user_id, :comment)";

    $stmt = $conn->prepare($query);
    $stmt->execute(array('user_id' => $_SESSION['user_id'], 'comment' => htmlspecialchars($_POST['comment']) ));
}

header("Location: http://guestbook.loc/app/php/autorized.php");

?>