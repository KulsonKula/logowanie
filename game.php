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
        echo "<h1> Welcome " . $_SESSION['login'] . '! [<a href="logout.php">Log out!</a>]</h1>';
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM habits WHERE user_id=$user_id";
        $result = $connect->query($query);
        echo "<div class='wrapper'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='habit'>" . $row['name'];
            echo "<form method='GET' action='deleting.php'>";
            echo "<button name='delete' type='submit'>delete</button>";
            echo "<input name='id'value=" . $row['habit_id'] . " style='display:none;'>";
            echo "</form>";
            $habit_id = $row['habit_id'];
            $query = "SELECT * FROM info WHERE habit_id = $habit_id AND info.date='" . date('Y-m-d') . "'";
            $row2 = $connect->query($query);
            $data = $row2->fetch_assoc();
            if ($row2->num_rows == 0) {
                $query = "INSERT INTO info VALUES(" . $row['habit_id'] . ",'" . date('Y-m-d') . "',0)";
                $connect->query($query);
                $checked = "";
            } else {

                if (@$data['date'] == date("Y-m-d") && $data['done'] == 1)
                    $checked = "checked";
                else if (@$data['date'] == date("Y-m-d") && $data['done'] == 0)
                    $checked = "";
            }

            echo "<form action='changing.php' method='GET'>";
            echo "<input type='checkbox' $checked name='checkbox[]' onchange='this.form.submit()' value=$checked>";
            echo "<input type='text' style='display:none' name='habit_id' value='$habit_id'>";
            echo "<input type='text' style='display:none' name='date' value='" . date("Y-m-d") . "'>";
            echo "</form>";

            $query = "SELECT * FROM info WHERE habit_id = $habit_id AND done=1";
            $result_S = $connect->query($query);
            echo "<h3> Sum: ".  $result_S->num_rows."</h3>";

            $i=0;
            while(true){
            $query = "SELECT * FROM info WHERE habit_id = $habit_id AND date=DATE_SUB('".date('Y-m-d')."',". "INTERVAL $i DAY)";
            $result_Streak = $connect->query($query);
            $row3 = @$result_Streak->fetch_assoc();
            if(@$row3['done']==1)
            $i++;
            else
            break;
            }
            echo "<h3> Steak: ".  $i."</h3>";

            echo "</div>";
        }
        ?>
        <div class='habit add'>
            <form method='GET' action='adding.php'>
                <label for="habit_name">Habit</label>
                <input id="habit_name" name="habit_name" type="text" placeholder="Habit name">
                <input type="submit" value="Create!" />
            </form>
        </div>
        <?php
        echo "</div>";
        ?>
    </div>
</body>

</html>