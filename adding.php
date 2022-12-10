<?php
session_start();

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);


if (!empty($_GET['habit_name'])) {
    $query = "INSERT INTO habits VALUES('" . $_GET['habit_name']."','".$_SESSION['user_id']."',NULL)";
    $result = $connect->query($query);
} 
header("Location:game.php");