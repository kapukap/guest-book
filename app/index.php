<?php
include_once 'php/config.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Jomolhari|Oswald&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="wrapper">
        <h1>Гостевая книга</h1>
        <div class="h-buttons">
            <div class="h-buttons__button">
                <a href="php/auth/login.php" class="h-buttons__button--login btn">Авторизация</a>
            </div>
            <div class="h-buttons__button">
                <a href="php/auth/register.php" class="h-buttons__button--register btn">Регистрация</a>
            </div>
        </div>
    </div>

</header>
<section class="content">
    <div class="wrapper content-block">
        <div class="content-block__text">
            <?php
            $query = "SELECT comments.user_id, comments.comment, comments.comment_created_at, users.id, users.name FROM `comments` INNER  JOIN `users` ON comments.user_id = users.id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<div class='content-block__text--comment'>";
                echo "<div class='comment_info'>";
                echo "<div class='u-name'><h3>" . $result->name . "</h3></div>";
                echo "<div class='time'><span>" . $result->comment_created_at . "</span></div>";
                echo "</div>";
                echo "<p>" . $result->comment . "</p>";
                echo "</div>";
            }

            ?>

        </div>
        <form class="content-block__add" method="get" action="php/auth/login.php">
            <h2>Что вы думаете о нас?</h2>
            <label for="content-block__add--textArea"></label>
            <textarea name="nonautorized" id="content-block__add--textArea" cols="30" rows="10"
                      placeholder="Добавьте комментарий..."></textarea>
            <div class="content-block__add--btn">
                <input class="btn" type="submit" value="Отправить">
            </div>

        </form>
    </div>
</section>


</body>
</html>
