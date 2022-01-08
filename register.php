<?php
include 'connection.php';
session_start();
unset($_SESSION['username']);

if (isset($_POST['register-button'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = empty($_POST['middlename']) ? NULL : $_POST['middlename'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];

    $q = 'INSERT INTO users VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL)';
    $stmt = $conn->prepare($q);
    $stmt->bind_param(
        'sssssss', 
        $username,
        $password,
        $lastname,
        $firstname,
        $middlename,
        $phonenumber,
        $address
    );
    $stmt->execute();

    $_SESSION['msg'] = 'Registered successfully!';
    header('location: index.php');
    exit();
}

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.83">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="mycss.css">
</head>

<body>
    <center>
        <div class="main-wrap" style="margin-bottom: 20%; height: unset;">
            <span class='header'>Register</span>
            <br>

            <form action="register.php" method="POST">
                <label for="username">Username</label>
                <br>
                <input type="username" name="username" id="username" placeholder="Username">
                <br><br>

                <label for="password">Password</label>
                <br>
                <input type="password" name="password" id="password" placeholder="•••••••••••">
                <br><br>

                <label for="lastname">Last name</label>
                <br>
                <input type="text" name="lastname" id="lastname" placeholder="Last name">
                <br><br>

                <label for="firstname">First name</label>
                <br>
                <input type="text" name="firstname" id="firstname" placeholder="First name">
                <br><br>

                <label for="middlename">Middle name</label>
                <br>
                <input type="text" name="middlename" id="middlename" placeholder="Middle name">
                <br><br>

                <label for="phonenumber">Phone number</label>
                <br>
                <input type="text" name="phonenumber" id="phonenumber" placeholder="####-###-####">
                <br><br>

                <label for="address">Address</label>
                <br>
                <input type="text" name="address" id="address" placeholder="Address">
                <br><br>

                <button type="submit" name="register-button" id="submit">Register</button>
            </form>

        </div>
    </center>
</body>
