<?php
session_start();

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);

$wartosci = @$_GET['checkbox'];
$habit_id = @$_GET['habit_id'];
$date = @$_GET['date'];


if (isset($_GET['checkbox'])) {
    foreach ($wartosci as $done) {
        $query = "UPDATE info SET done=1 WHERE habit_id=$habit_id AND date='" . $date . "'";
        $result = $connect->query($query);
    }
} else {
    $query = "UPDATE info SET done=0 WHERE habit_id=$habit_id AND date='" . $date . "'";
    $result = $connect->query($query);
}

header("Location:game.php");
