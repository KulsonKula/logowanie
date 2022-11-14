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
    <meta charset="UTF-8">
    <title>...</title>
</head>

<body>
    <?php

    echo "<p> Witaj " . $_SESSION['login'] . '![<a href="logout.php">Wyloguj sie!</a>]</p>';
    ?>
</body>

</html>