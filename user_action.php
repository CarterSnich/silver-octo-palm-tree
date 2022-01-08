<?php
include 'connection.php';
session_start();

if (isset($_POST['logout-button'])) {
	unset($_SESSION['username']);
	header('location: index.php');
	exit();
} else if (isset($_POST['save-button'])) {
    $username = $_SESSION['username'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = empty($_POST['middlename']) ? NULL : $_POST['middlename'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    
    $q = 'UPDATE users SET Lastname = ?, Firstname = ?, Middlename = ?, Phonenumber = ?, Address = ? WHERE Username = ?';
    $stmt = $conn->prepare($q);
    $stmt->bind_param(
        'ssssss',
        $lastname,
        $firstname,
        $middlename,
        $phonenumber,
        $address,
        $username
    );
    $stmt->execute();

    $_SESSION['msg'] = 'Updated succesfully!';
    header('location: home.php');

    exit();
}
