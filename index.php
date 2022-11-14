<?php
session_start();
if (isset($_SESSION['loged']) && ($_SESSION['loged'] == true)) {
	header('Location:game.php');
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
	<form action="login.php" method="post">
		Login:<br /> <input type="text" name="login" /> <br />
		Password:<br /> <input type="password" name="password" /> <br />
		<input type="submit" calue="log in" />
	</form>

	<a href="registration.php"> Registration</a> <br />
	<?php
	if (isset($_SESSION['blad'])) {
		echo $_SESSION['blad'];
	}
	?>
</body>

</html>