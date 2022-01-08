<?php
include 'connection.php';

session_start();
unset($_SESSION['username']);
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=0.83">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="mycss.css">
</head>

<body>
	<center>
		<div class="main-wrap">
			<span class='header'> User login</span>
			<br>

			<form action="verify_user.php" method="POST">
				<label for="username">Username</label>
				<br>
				<input type="username" name="username" id="username" placeholder="username">
				<br><br>
				<label for="password">Password</label>
				<br>
				<input type="password" name="password" id="password" placeholder="•••••••••••">
				<br>
				<button type="submit" name="submit-button" id="submit">
					Login<i class='bx bx-log-in' style="position: relative; top: 3px; font-size: 24px;"></i>
				</button>
				<br>
				<a class="register" href="register.php">Register</a>
			</form>

			<a class="register" href="admin_login.php">Admin login</a>

			<?php if (isset($_SESSION['msg'])) : ?>
				<br><br><br>
				<div><?= $_SESSION['msg'] ?></div>
			<?php endif ?>
		</div>
	</center>
</body>

<?php
unset($_SESSION['msg']);
?>