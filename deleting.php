<?php
session_start();

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);

if (array_key_exists('delete', $_GET)) {
    $query = "DELETE FROM habits WHERE habit_id=" . $_GET['id'];
    $result = $connect->query($query);
    $query = "DELETE FROM info WHERE habit_id=" . $_GET['id'];
    $result = $connect->query($query);
}
header("Location:game.php");