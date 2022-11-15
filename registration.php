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
            Login:<br /><input class="input_B" type="text" name="login" /><br />
            <?php
            if (isset($_SESSION['e_login'])) {
                echo '<div class="error">' . $_SESSION['e_login'] . '</div>';
                unset($_SESSION['e_login']);
            }
            ?>
            E-mail:<br /><input class="input_B" type="text" name="email" /><br />
            Password:<br /><input class="input_B" type="password" name="password1" /><br />
            Re-entry passowrd:<br /><input class="input_B" type="password" name="password2" /><br />
            <label>
                <input type="checkbox" name="statute" /> I do agree to statute.
            </label>
            <div class="g-recaptcha" data-sitekey="6LcJ9gYjAAAAAC7GQr1ke5qFvZJgRNLU5O3XuoUU"></div>
            <br></br>

            <input class="log_button" type="submit" value="Register" />
        </form>
    </div>
    <div class="col span-1-of-3 box"> </div>

</body>

</html>