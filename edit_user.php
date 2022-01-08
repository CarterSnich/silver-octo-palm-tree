<?php
include 'connection.php';
session_start();

if (isset($_POST['edit-button'])) {
    $uid = $_POST['edit-button'];

    // sql query
    $q = 'SELECT * FROM users WHERE Id = ?';

    // prepare and bind
    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else if ($_POST['update-button']) {
    $uid = $_POST['update-button'];

    $vaccine = empty($_POST['vaccine']) ? NULL : $_POST['vaccine'];
    $firstdose = empty($_POST['firstdose']) ? NULL : $_POST['firstdose'];
    $seconddose = empty($_POST['seconddose']) ? NULL : $_POST['seconddose'];

    // sql query
    $q = 'UPDATE users SET Vaccine = ?, Firstdose = ?, Seconddose = ? WHERE Id = ?';

    // prepare and bind
    $stmt = $conn->prepare($q);
    $stmt->bind_param("ssss", $vaccine, $firstdose, $seconddose, $uid);
    
    if ($stmt->execute()) {
        $_SESSION['msg'] = 'User updated successfully!';
        header('location: admin.php');
        exit();
    } else {
        $_SESSION['msg'] = $stmt->error;
        header('location: admin.php');
        exit();
    }
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
    <title>Edit User</title>
    <link rel="stylesheet" href="mycss.css">
</head>

<body>
    <div style="margin-left: auto; margin-right: auto; width: fit-content;">

        <h2>Edit user: <u><?= $row['Lastname'] . ", " . $row['Firstname'] . (empty($row['Middlename']) ? "" : " " . $row['Middlename'][0] . ".") ?></u></h2>
        <?php if (isset($_SESSION['msg'])) : ?>
            <br>
            <br>
            <div><?= $_SESSION['msg'] ?></div>
        <?php endif ?>
        <form action="edit_user.php" method="POST" style="margin-bottom: 50%;">

            <label for="vaccine">Vaccine</label>
            <br>
            <input type="text" name="vaccine" id="vaccine" placeholder="Vaccine" value="<?= $row['Vaccine'] ?>">
            <br><br>

            <label for="firstdose">First dose</label>
            <br>
            <input type="date" name="firstdose" id="firstdose" placeholder="First dose" value="<?= $row['Firstdose'] ?>">
            <br><br>

            <label for="secondose">Second dose</label>
            <br>
            <input type="date" name="seconddose" id="seconddose" placeholder="Second dose" value="<?= $row['Seconddose'] ?>">
            <br><br>

            <center>
                <button type="submit" name="update-button" value="<?= $row['Id'] ?> id=" submit">Update</button>
                <a href="admin.php" style="text-decoration: none;">
                    <button type="button">Cancel</button>
                </a>
            </center>
            <br>
        </form>
    </div>
</body>

<?php unset($_SESSION['msg']) ?>