<?php
session_start();

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);

$Habit_name = htmlentities($_GET['habit_name'], ENT_QUOTES, "UTF-8");

// sprintf(
//     "SELECT * FROM users WHERE login='%s'",
//     mysqli_real_escape_string($connect, $login)
$Habit_name=mysqli_real_escape_string($connect, $Habit_name);

if (!empty($_GET['habit_name'])) {
    $query = "INSERT INTO habits VALUES('" . $Habit_name . "','" . $_SESSION['user_id'] . "',NULL)";
    $result = $connect->query($query);
}
header("Location:game.php");
