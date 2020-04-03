<?php

require_once '../config.php';
if (!empty($_SESSION['user_id'])) {
    header("Location: http://guestbook.loc/app/php/autorized.php");
}

//$new_user_text = $_GET['nonautorized'];


$error = [];
if (!empty($_POST)) {
    if (empty($_POST['name'])) {
        $error[] = 'Please enter your Name';
    }
    if (empty($_POST['pass'])) {
        $error[] = 'Please enter Password';
    }


    if (empty($error)) {
        $query = "SELECT id FROM users WHERE (name = :username or email = :email) and password = :password";
        $stmt = $conn->prepare($query);
        $stmt->execute(array('username' => $_POST['name'], 'email' => $_POST['name'], 'password' => sha1($_POST['pass'] . 'SALT')));
//        $stmt->execute(array('username'=>$_POST['name'],'email'=>$_POST['name'], 'password'=>sha1($_POST['pass']) ));
        $id = $stmt->fetchColumn();

        if (!empty($id)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $_POST['name'];

            header("Location: http://guestbook.loc/app/php/autorized.php");
//            header("Location: http://guestbook.loc/app/php/autorized.php"."?$new_user_text");
        } else {
            $error[] = 'Please, try again';
        }


    }
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/login_register.css">
</head>
<body>
<div class="auth_wrapper">
    <div class="auth_wrapper--color_theme">
        <h1>Login Page</h1>
        <form action="" method="post">
            <div class="errors" style="color: red;">
                <?php foreach ($error as $val) : ?>
                    <p><?php echo $val ?></p>
                <?php endforeach; ?>

            </div>

            <label for="user_name" hidden>Login:</label>
            <input type="text" id="user_name" required placeholder="Enter username" name="name"
                   value="<?php echo !empty($_POST['name']) ? $_POST['name'] : ''; ?>">


            <label for="pass" hidden>Password:</label>
            <input type="password" id="pass" required name="pass" placeholder="Enter password">


            <input type="submit" value="Submit">


        </form>
        <div class="go_registration">
            <div class="go_registration__btn">
                <a href="register.php" class="to_registration">Registration Form</a>
            </div>
            <div class="go_registration__btn">
                <a href="../../index.php" class="to_main">To main page</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
