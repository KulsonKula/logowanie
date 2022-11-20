<?php

session_start();

if (isset($_POST['email'])) {
    $Allright = true;

    $login = $_POST['login'];
    if ((3 < strlen($login)) | (20 > strlen($login))) {
        $Allright = false;
        $_SESSION['e_login'] = "Login must have between 3 and 20 characters";
    }

    if ($Allright == true) {
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
    <title>...</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="col span-1-of-3 box"> </div>
    <div class="col span-1-of-3 box ">

        <form class="register" method="post">
            <h1>Welcome in habit tracer!</h1>
            <h2>Login</h2><input class="input_B" type="text" name="login" placeholder="Enter your login" /> <br />
            <?php
            if (isset($_SESSION['e_login'])) {
                echo '<div class="error">' . $_SESSION['e_login'] . '</div>';
                unset($_SESSION['e_login']);
            }
            ?>
            <h2>E-mail</h2><input class="input_B" type="text" name="email" placeholder="Enter your E-mile" /><br />
            <h2>Password</h2><input class="input_B" type="password" name="password1" placeholder="*********" /><br />
            <h2>Re-entry passowrd</h2><input class="input_B" type="password" name="password2" placeholder="*********" /><br />
            <label>
                <h3><input type="checkbox" name="statute" /> I do agree to <a href="https://www.w3schools.com/tags/tag_center.asp">statute</a>.</h3>
            </label>
            <div class="g-recaptcha" data-sitekey="6LcJ9gYjAAAAAC7GQr1ke5qFvZJgRNLU5O3XuoUU"></div>
            <br></br>

            <input class="log_button" type="submit" value="Register" />
        </form>
    </div>
    <div class="col span-1-of-3 box"> </div>

</body>

</html>