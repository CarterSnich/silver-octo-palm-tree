<?php

include 'connection.php';
session_start();

if ($_POST['delete-confirm-button']) {
    $uid = $_POST['delete-confirm-button'];

    // sql query
    $q = 'DELETE FROM users WHERE Id = ?';

    // prepare and bind
    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $uid);

    if ($stmt->execute()) {
        $_SESSION['msg'] = 'User deleted successfully!';
        header('location: admin.php');
        exit();
    } else {
        $_SESSION['msg'] = $stmt->error;
        header('location: admin.php');
        exit();
    }
}
