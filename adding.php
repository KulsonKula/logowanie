<?php
session_start();

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);


if (array_key_exists('habit_name', $_GET)) {
    $query = "INSERT INTO habits VALUES('" . $_GET['habit_name']."','".$_SESSION['user_id']."',NULL)";
    $result = $connect->query($query);
} 
header("Location:game.php");