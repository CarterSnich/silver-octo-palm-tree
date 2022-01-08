<?php
include "connection.php";
session_start();
unset($_SESSION['msg'], $_SESSION['username']);

if (isset($_POST['submit-button'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = mysqli_prepare($conn, 'SELECT Username, Password FROM users WHERE Username = ?');
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $u, $p);
	mysqli_stmt_fetch($stmt);
	if ($u == NULL) {
		$_SESSION['msg'] = 'Username does not exist.';
		header('location: index.php');
		exit();
	}
	if (password_verify($password, $p)) {
		$_SESSION['username'] = $u;
		header('location: home.php');
	} else {
		$_SESSION['msg'] = 'Wrong password.';
		header('location: index.php');
	}
	exit();
} else {
	header('location: index.php');
	exit();
}
