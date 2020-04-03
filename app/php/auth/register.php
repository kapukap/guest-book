<?php
require_once '../config.php';

if (!empty($_SESSION['user_id'])) {
    header("Location: http://guestbook.loc/app/php/autorized.php");
}

$error = [];
if (!empty($_POST)) {
    if (empty($_POST['user_name'])) {
        $error[] = 'Please enter your Name';
    }
    if (empty($_POST['pass'])) {
        $error[] = 'Please enter Password';
    }
    if (empty($_POST['email'])) {
        $error[] = 'Please enter your Email';
    }
    if (strlen($_POST['user_name']) > 100) {
        $error[] = 'User name is to long. Max length is 100 chars';
    }
    if (strlen($_POST['pass']) < 6) {
        $error[] = 'Password is to short. Need more than 6 chars';
    }
//    if ($_POST['pass'] !== $_POST['confirm_pass']){
//        $error[] = 'Your confirm pass is not match password';
//    }

    if (empty($error)) {
        $query = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($query);
        $stmt->execute(array('username' => $_POST['user_name'], 'email' => $_POST['email'], 'password' => sha1($_POST['pass'] . 'SALT')));
//        $stmt->execute(array('username' => $_POST['user_name'], 'email' => $_POST['email'], 'password' => sha1($_POST['pass'])  ));

        header("Location: http://guestbook.loc/app/php/auth/login.php");

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
    <title>register</title>
    <link rel="stylesheet" href="../../css/login_register.css">
</head>
<body>
<div class="auth_wrapper">
    <div class="auth_wrapper--color_theme">
        <h1>Registration Page</h1>
        <form action="" method="post">
            <div class="errors" style="color: red;">
                <?php foreach ($error as $val) : ?>
                    <p><?php echo $val ?></p>
                <?php endforeach; ?>

            </div>
            <label for="user_name" hidden>Name</label>
            <input type="text" name="user_name" placeholder="Name" id="user_name" required
                   value="<?php echo !empty($_POST['user_name']) ? $_POST['user_name'] : ''; ?>">

            <label for="pass" hidden >Password</label>
            <input type="password" placeholder="Password" name="pass" id="pass" required>

            <label for="email" hidden>Email</label>
            <input type="email" placeholder="Email" name="email" id="email" required
                   value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ''; ?>">

            <input type="submit" value="Submit">
        </form>

        <div class="go_login">
            <div class="go_login__btn">
                <a href="login.php" class="to_login">Login Form</a>
            </div>
            <div class="go_login__btn">
                <a href="../index.php" class="to_main">To main page</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
