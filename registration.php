<?php

session_start();

if (isset($_POST['email'])) {
    $Allright = true;
    //nick
    $login = $_POST['login'];
    if ((3 > strlen($login)) || (20 < strlen($login))) {
        $Allright = false;
        $_SESSION['e_login'] = "Login must have between 3 and 20 characters";
    }
    if (ctype_alnum($login) == false) {
        $Allright = false;
        $_SESSION['e_login'] = "Nickname can only consist of letters and numbers";
    }

    //Email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($email != $emailB)) {
        $Allright = false;
        $_SESSION['e_email'] = "Enter the correct e-mail address";
    }

    //password
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if ((3 > strlen($password1)) || (20 < strlen($password1))) {
        $Allright = false;
        $_SESSION['e_password'] = "Password must have between 3 and 20 characters";
    }
    if ($password1 != $password2) {
        $Allright = false;
        $_SESSION['e_password'] = "Passwords are not identical";
    }
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);

    //cheackbox
    if (!isset($_POST['statute'])) {
        $Allright = false;
        $_SESSION['e_statute'] = "You have to accept the terms of service";
    }

    //CAPTCHA
    $CAPTCHA = "6LcJ9gYjAAAAADHMNhYmoNZM0CDUKnQiXT96Zt6D";
    $check = file_get_contents('https://google.com/recaptcha/api/siteverify?secret=' . $CAPTCHA . '&response=' . $_POST['g-recaptcha-response']);
    $response = json_decode($check);
    if ($response->success == false) {
        $Allright = false;
        $_SESSION['e_captcha'] = "Confirm that you are not a bot";
    }

    //sprawdzenie w bazie maila
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connect = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connect->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //is email in base
            $result = $connect->query("SELECT user_id FROM users WHERE email='$email'");
            if (!$result) throw new Exception($connect->error);
            $how_much1 = $result->num_rows;
            if ($how_much1 > 0) {
                $Allright = false;
                $_SESSION['e_email'] = "This E-mail is already used";
            }
            $connect->close();
        }
    } catch (Exception $e) {
        echo "Serwer issue";
        echo $e;
    }

    //sprawdzenie w bazie login
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connect = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connect->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //is email in base
            $result = $connect->query("SELECT user_id FROM users WHERE login='$login'");
            if (!$result) throw new Exception($connect->error);
            $how_much2 = $result->num_rows;
            if ($how_much2 > 0) {
                $Allright = false;
                $_SESSION['e_login'] = "This login is already used";
            }
            
            //wpisanie do bazy
            if ($Allright == true) {
            }

            $connect->close();
        }
    } catch (Exception $e) {
        echo "Serwer issue";
        echo $e;
    }
}

?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style_regis.css" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <meta charset="UTF-8">
    <title>Registration</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="col span-1-of-3 box"> </div>
    <div class="col span-1-of-3 box ">

        <form class="register" method="post">
            <h1>Welcome in habit tracer!</h1>
            <p>Create your free account here</p>
            <h2>Login</h2><input class="input_B" type="text" name="login" placeholder="Enter your login" /> <br />
            <?php
            if (isset($_SESSION['e_login'])) {
                echo '<div class="error">' . $_SESSION['e_login'] . '</div>';
                unset($_SESSION['e_login']);
            }
            ?>
            <h2>E-mail</h2><input class="input_B" type="text" name="email" placeholder="Enter your E-mile" /><br />
            <?php
            if (isset($_SESSION['e_email'])) {
                echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
                unset($_SESSION['e_email']);
            }
            ?>
            <h2>Password</h2><input class="input_B" type="password" name="password1" placeholder="*********" /><br />
            <?php
            if (isset($_SESSION['e_password'])) {
                echo '<div class="error">' . $_SESSION['e_password'] . '</div>';
                unset($_SESSION['e_password']);
            }
            ?>
            <h2>Re-entry passowrd</h2><input class="input_B" type="password" name="password2" placeholder="*********" /><br />
            <label>
                <h3><input type="checkbox" name="statute" /> I do agree to <a href="https://www.w3schools.com/tags/tag_center.asp">terms of service</a>.</h3>
            </label>
            <?php
            if (isset($_SESSION['e_statute'])) {
                echo '<div class="error">' . $_SESSION['e_statute'] . '</div>';
                unset($_SESSION['e_statute']);
            }
            ?>
            <div class="g-recaptcha" data-sitekey="6LcJ9gYjAAAAAC7GQr1ke5qFvZJgRNLU5O3XuoUU"></div>
            <?php
            if (isset($_SESSION['e_captcha'])) {
                echo '<div class="error">' . $_SESSION['e_captcha'] . '</div>';
                unset($_SESSION['e_captcha']);
            }
            ?>
            <input class="log_button" type="submit" value="Register" />
        </form>
    </div>
    <div class="col span-1-of-3 box"> </div>

</body>

</html>