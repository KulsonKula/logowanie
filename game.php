<?php
session_start();

if (!isset($_SESSION['loged'])) {
    header('Location:index.php');
    exit();
}

require_once "connect.php";
$connect = @new mysqli($host, $db_user, $db_password, $db_name);
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
        if(array_key_exists('delete',$_POST)){
            $query = "DELETE FROM habits WHERE habit_id=".$_POST['id'];
            $result=$connect->query($query);
        }
        echo "<h1> Welcome " . $_SESSION['login'] . '! [<a href="logout.php">Log out!</a>]</h1>';
        $user_id=$_SESSION['user_id'];
        $query="SELECT * FROM habits WHERE user_id=$user_id";
        $result=$connect->query($query);
        echo "<div class='wrapper'>";
        while($row = $result -> fetch_assoc()){
        echo "<div class='habit'>". $row['name'];
        echo "<form method='post' action='game.php'>";
        echo "<button name='delete' type='submit'>delete</button>";
        echo "<input name='id'value=".$row['habit_id']." style='display:none;'>" ;
        echo "</form>";
        echo "</div>";
        }
        
        ?>
    </div>
</body>

</html>