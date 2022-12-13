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
	<link rel="stylesheet" type="text/css" href="css/style_login.css" />
	<meta charset="UTF-8">
	<title>...</title>
</head>

<body>
	<div class="login">
		<div class="login_box">
			<h1>Welcome back</h1>
			<h2>Please enter your details below</h2>
			<form action="login.php" method="post">
				<h3>Login</h3><input class="input_B" type="text" name="login" placeholder="Enter your login" />
				<h3>Password</h3><input class="input_B" type="password" name="password" placeholder="*********" />
				<input class="log_button" type="submit" value="Log in" />
				<?php
				if (isset($_SESSION['blad'])) {
					echo $_SESSION['blad'];
				}
				?>
			</form>

			<h4> Don't have an account? <a href="registration.php">Sign up </a></h4>
		</div>
	</div>

</body>

</html>