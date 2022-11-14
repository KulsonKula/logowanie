<?php

session_start();

if(isset($_POST['email']))
{
 $Allright=true;

 $login=$_POST['login'];
 if((3<strlen($login))|(20>strlen($login)))
 {
    $Allright=false;
    $_SESSION['e_login']="login must have between 3 and 20 characters";
 }

 if($Allright==true){

 }
}

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>...</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <form method="post">
        Login:<br /><input type="text" name="login" /><br />
        <?php
        if(isset($_SESSION['e_login'])){
            echo'<div class="error">'. $_SESSION['e_login'].'</div>';
            unset($_SESSION['e_login']);
        }
        ?>
        E-mail:<br /><input type="text" name="email" /><br />
        Password:<br /><input type="password" name="password1" /><br />
        Re-entry passowrd:<br /><input type="password" name="password2" /><br />
        <label>
            <input type="checkbox" name="statute" /> I do agree to statute.
        </label>
        <div class="g-recaptcha" data-sitekey="6LcJ9gYjAAAAAC7GQr1ke5qFvZJgRNLU5O3XuoUU"></div>
        <br></br>

        <input type="submit" value="Register" />
    </form>


</body>

</html>