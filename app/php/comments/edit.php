<?php

require_once "../config.php";


if (isset( $_GET[key($_GET)] )){
    $user_text = [];

    $query = "SELECT comment FROM comments WHERE (comment_id = :comment and user_id= :session_id)";
    $stmt = $conn->prepare($query);
    $stmt->execute(array('comment'=> key($_GET), 'session_id'=>$_SESSION['user_id']));
    while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
        $user_text['comment'] = "$result->comment";
        $user_text['comment_id'] = key($_GET);
    }

    echo "<form method='post' action='update.php'>";
    echo "<input type=\"hidden\" name=\"comment_id\" value=".$user_text['comment_id'].">";
    echo "<textarea name='user_text'>".$user_text['comment']."</textarea>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
}
else{
    header("Location: http://guestbook.loc/app/php/autorized.php");
}