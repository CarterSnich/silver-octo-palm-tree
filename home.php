<?php
include 'connection.php';
session_start();

if (isset($_SESSION['username'])) {
	$u = $_SESSION['username'];

	// sql query
	$q = 'SELECT * FROM users WHERE Username = ?';

	// prepare and bind
	$stmt = $conn->prepare($q);
	$stmt->bind_param("s", $u);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
} else {
	header('location: index.php');
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="mycss.css">
</head>

<body>
	<div style="margin-left: auto; margin-right: auto; width: fit-content;">

		<h2>Welcome, <?= $row['Username'] ?>!</h2>
		<?php if (isset($_SESSION['msg'])) : ?>
			<br>
			<br>
			<div><?= $_SESSION['msg'] ?></div>
		<?php endif ?>
		<form action="user_action.php" method="POST" style="margin-bottom: 50%;">

			<label for="lastname">Last name</label>
			<br>
			<input type="text" name="lastname" id="lastname" placeholder="Last name" value="<?= $row['Lastname'] ?>">
			<br><br>

			<label for="firstname">First name</label>
			<br>
			<input type="text" name="firstname" id="firstname" placeholder="First name" value="<?= $row['Firstname'] ?>">
			<br><br>

			<label for="middlename">Middle name</label>
			<br>
			<input type="text" name="middlename" id="middlename" placeholder="Middle name" value="<?= $row['Middlename'] ?>">
			<br><br>

			<label for="phonenumber">Phone number</label>
			<br>
			<input type="text" name="phonenumber" id="phonenumber" placeholder="####-###-####" value="<?= $row['Phonenumber'] ?>">
			<br><br>

			<label for="address">Address</label>
			<br>
			<input type="text" name="address" id="address" placeholder="Address" value="<?= $row['Address'] ?>">
			<br><br>

			<label for="vaccine">Vaccine</label>
			<br>
			<input type="text" name="vaccine" id="vaccine" placeholder="Vaccine" value="<?= $row['Vaccine'] ?>" readonly>
			<br><br>

			<label for="firstdose">First dose</label>
			<br>
			<input type="text" name="firstdose" id="firstdose" placeholder="First dose" value="<?= $row['Firstdose'] ?>" readonly>
			<br><br>

			<label for="secondose">Second dose</label>
			<br>
			<input type="text" name="=seconddose" id="seconddose" placeholder="Second dose" value="<?= $row['Seconddose'] ?>" readonly>
			<br><br>

			<center>
				<button type="submit" name="save-button" id="submit">Save</button>
				<button type="submit" name="logout-button" id="logout">Logout</button>
			</center>
			<br>
		</form>
	</div>
</body>

<?php unset($_SESSION['msg']) ?>