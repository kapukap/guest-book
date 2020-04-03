<?php

require_once 'config.php';
if (empty($_SESSION)) {
    header("Location: http://guestbook.loc/app/php/auth/login.php");
}

function if_comment_user($comment_username, $session_username)
{
    $result = '';
    if ($comment_username == $session_username) {
        $result = 'user_class';
    }
    return $result;
}

function add_tags($comment_username, $session_username, $comment_id)
{

    if ($comment_username == $session_username) {
        echo "<div class='user-controls'>";
        echo "<a id='del' style='margin: 0 5px' href='comments/delete.php?$comment_id'>Delete</a>";
        echo "<a id='edit' style='margin: 0 5px' href='comments/edit.php?$comment_id'>Edit</a>";
        echo "</div>";
    }
}

$query = "SELECT comments.user_id, comments.comment_id, comments.comment, comments.comment_created_at, users.id, users.name FROM `comments` INNER  JOIN `users` ON comments.user_id = users.id"; ?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
</head>
<body>
<link href="https://fonts.googleapis.com/css?family=Jomolhari|Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/authorized.css">
<header>
    <div class="wrapper">
        <h1>Гостевая книга</h1>
        <div class="user_panel">
            <div class="user_panel--username">
                <p>Hello, <span><?php echo $_SESSION['user_name']; ?></span></p>
            </div>
            <div class="btn user_panel__btn">
                <a href="auth/logout.php" class="user_panel__btn--logout">Выйти</a>
            </div>
        </div>
    </div>

</header>
<section class="content">
    <div class="wrapper comments-block">
        <div class="content-block__comments">
            <?php
            $stmt = $conn->prepare($query);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<div class='content-block__text--comment " . if_comment_user($result->name, $_SESSION['user_name']) . "' >";
                echo "<div class='comment_info'>";
                echo "<div class='u-name'><h3>" . $result->name . "</h3></div>";
                echo "<div class='time'><span>" . $result->comment_created_at . "</span></div>";
                echo "</div>";
                echo "<p>" . $result->comment . "</p>";
                add_tags($result->name, $_SESSION['user_name'], $result->comment_id);
                echo "</div>";
            }
            ?>

        </div>



        <form action="comments/create.php" class="content-block__inputs" method="post">
            <label for="txt"></label>
            <textarea name="comment" class="" id="text" cols="" rows="2"></textarea>
            <div class="button__wrapper">
                <input type="submit" class="btn button__wrapper--submit" value="Отправить">
            </div>

        </form>

    </div>
</section>


<!--<link rel="stylesheet" href="../css/authorized.css">-->
<script src="../js/controls.js"></script>
</body>
</html>