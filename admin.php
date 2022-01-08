<?php
include 'connection.php';
session_start();

if (isset($_SESSION['admin'])) {
    $a = $_SESSION['admin'];

    if (isset($_GET['search']) && $_GET['search']) {
        $search = "%$_GET[search]%";
        // sql query
        $q = 'SELECT * FROM users WHERE CONCAT(Lastname, Firstname, COALESCE(Middlename, ""), Address, COALESCE(Vaccine, "")) LIKE ?';
        // prepare and bind
        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // sql query
        $q = 'SELECT * FROM users';
        // prepare and bind
        $stmt = $conn->prepare($q);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Administrator</title>
    <link rel="stylesheet" href="mycss.css">
    <style>
        div.top-bar {
            height: 5rem;
            display: flex;
            width: 100%;
        }

        div.top-bar>h2 {
            margin: auto;
        }

        a.logout-button {
            position: relative;
            margin-top: auto;
            margin-bottom: auto;
            top: unset;
            right: 2.25rem;
            padding: .25rem 1.25rem;
            text-align: center;
        }

        table,
        tr,
        td {
            border: 1px solid black;
        }

        table {
            width: 100%;
        }

        button.action-button {
            position: unset;
        }

        div.modal {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #00000080;
            position: fixed;
            top: 0;
            left: 0;
            margin: 0;
            width: 100vw;
            height: 100vh;
            z-index: 900;
        }

        div.modal-dialog {
            margin: auto;
            position: fixed;
            padding: 1.25rem;
            background: white;
            border: 1px solid black;
            border-radius: 1.25rem;
            width: fit-content;
        }

        div.modal-foot>button {
            position: unset;
        }

        .hide {
            display: none !important;
        }

        div.search-bar {
            height: 3.25rem;
        }

        div.search-bar>form {
            position: unset;
            top: unset;
            display: flex;
            align-items: center;
        }

        div.search-bar>form>button,
        div.search-bar>form>input {
            position: unset;
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <h2>Admin page</h2>
        <a class="logout-button" href="admin_login.php">Logout</a>
    </div>

    <div class="search-bar">
        <form action="admin.php" method="GET">
            <input value="<?= $_GET['search'] ?? ''?>" id="search-field" style="margin-right: .25rem; padding: unset .25rem; height: 2.25rem;" type="search" placeholder="Search..." name="search">
            <button type="submit">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Last name</td>
                <td>First name</td>
                <td>Middle name</td>
                <td>Address</td>
                <td>Phone</td>
                <td>Action</td>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $r) : ?>
                <tr>
                    <td><?= $r['Id'] ?></td>
                    <td><?= $r['Username'] ?></td>
                    <td><?= $r['Lastname'] ?></td>
                    <td><?= $r['Firstname'] ?></td>
                    <td><?= $r['Middlename'] ?></td>
                    <td><?= $r['Address'] ?></td>
                    <td><?= $r['Phonenumber'] ?></td>
                    <td style="display: flex; justify-content: space-around;">
                        <button style="display: flexbox; justify-self: center;" type="submit" class="action-button" form="edit-form" name="edit-button" value="<?= $r['Id'] ?>">Edit</button>
                        <button style="display: flexbox; justify-self: center;" class="action-button delete-action" value="<?= $r['Id'] ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>


    <?php foreach ($row as $r) : ?>
        <div id="delete-modal-<?= $r['Id'] ?>" class="modal hide">
            <div class="modal-dialog">
                <div class="modal-body">
                    <p>Delete user <u><?= $r['Lastname'] . ", " . $r['Firstname'] . (empty($r['Middlename']) ? "" : " " . $r['Middlename'][0] . ".") ?></u>?</p>
                </div>
                <div class="modal-foot">
                    <button type="submit" form="delete-form" name="delete-confirm-button" value="<?= $r['Id'] ?>">Confirm</button>
                    <button class="modal-cancel-button" value="<?= $r['Id'] ?>">Cancel</button>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <form id="edit-form" method="POST" action="edit_user.php"></form>
    <form id="delete-form" method="POST" action="delete_user.php"></form>

    <script>
        document.querySelectorAll('.delete-action').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById(`delete-modal-${this.value}`).classList.remove('hide');
            })
        })

        document.querySelectorAll('.modal-cancel-button').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById(`delete-modal-${this.value}`).classList.add('hide');
            })
        })
    </script>

    <?php if (isset($_SESSION['msg'])) : ?>
        <script defer>
            alert("<?= $_SESSION['msg'] ?>");
        </script>
    <?php endif ?>

    <script>
        document.getElementById('search-field').addEventListener('search', function() {
            if (this.value == '') window.location.href = 'admin.php';
        })
    </script>
</body>

</html>

<?php unset($_SESSION['msg']); ?>