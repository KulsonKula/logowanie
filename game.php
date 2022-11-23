<?php
session_start();

if (!isset($_SESSION['loged'])) {
    header('Location:index.php');
    exit();
}
?>

<!doctype html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style_game.css" />
    <meta charset="UTF-8">
    <title>...</title>
</head>

<body>
    <div class=container>
        <?php

        echo "<h1> Welcome " . $_SESSION['login'] . '! [<a href="logout.php">Log out!</a>]</h1>';
        ?>
    </div>
</body>

</html>