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

    echo "<p> Welcome " . $_SESSION['login'] . '! [<a href="logout.php">Log out!</a>]</p>';
    ?>
</body>

</html>