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
<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta charset="UTF-8">
	<title>...</title>
</head>

<body>
	<div class="login">
		<h1>Welcome back</h1>
		<h2>Welcome back! Please enter your details.</h2>
		<form action="login.php" method="post">
			Login:<br /> <input type="text" name="login" placeholder="Enter your login" /> <br />
			Password:<br /> <input type="password" name="password" placeholder="****" /> <br />
			<input type="submit" value="Log in" />
			<br /br>
			<?php
		if (isset($_SESSION['blad'])) {
			echo $_SESSION['blad'];
		}
		?>
		</form>

		<h4> Dont have an account? <a href="registration.php">Sign up </a> <br /br></h4>

	</div>

</body>

</html>