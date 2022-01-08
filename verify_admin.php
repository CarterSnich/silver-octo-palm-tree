<?php
include "connection.php";
session_start();
unset($_SESSION['msg'], $_SESSION['admin']);

if (isset($_POST['submit-button'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = mysqli_prepare($conn, 'SELECT Username, Password FROM admins WHERE Username = ?');
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $u, $p);
	mysqli_stmt_fetch($stmt);

	if ($u == NULL) {
		$_SESSION['msg'] = 'Admin does not exist.';
		header('location: admin_login.php');
		exit();
	}
	if (password_verify($password, $p)) {
		$_SESSION['admin'] = $u;
		header('location: admin.php');
	} else {
		$_SESSION['msg'] = 'Wrong password.';
		header('location: admin_login.php');
	}
	exit();
} else {
	header('location: index.php');
	exit();
}
