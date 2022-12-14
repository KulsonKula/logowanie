<?php
session_start();

if (!isset($_POST['login']) || !isset($_POST['password'])) {
    header('Location:index.php');
    exit();
}

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect->connect_errno != 0) {
    echo "Error: " . $connect->connect_errno . "Opis: " . $connect->connect_error;
} else {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if ($result = $connect->query(
        sprintf(
            "SELECT * FROM users WHERE login='%s'",
            mysqli_real_escape_string($connect, $login)
        )
    )) {

        $quantity = $result->num_rows;
        if ($quantity > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['loged'] = true;
                $_SESSION['login'] = $row['login'];
                $_SESSION['user_id'] = $row['user_id'];

                unset($_SESSION['blad']);
                $result->close();
                header('Location:game.php');
            } else {
                $_SESSION['blad'] = '<span style="color:red;   background-color: white;">Incorrent login or password!</span>';
                header('Location:index.php');
            }
        } else {
            $_SESSION['blad'] = '<span style="color:red;   background-color: white;">Incorrent login or password!</span>';
            header('Location:index.php');
        }
    }
    $connect->close();
}
