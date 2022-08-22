<?php

function printDialogue($msg)
{
    if ($msg == "success") { ?>
        <html>

        <head>
            <title>User Updated!</title>
        </head>

        <body align="center">
            User: <?php echo $_POST['makeAdmin']; ?> is now an Admin! <br>
            <input type="button" onclick="location.href='manageAdmin.php'" value="Create another Admin">
            <input type="button" onclick="location.href='homeAdmin.php'" value="Back to Home">
        </body>

        </html>
    <?php } elseif ($msg == "alreadyAdmin") { ?>
        <html>

        <head>
            <title>Error!</title>
        </head>

        <body align="center">
            User: <?php echo $_POST['makeAdmin']; ?> is already an Admin! <br>
            <input type="button" onclick="location.href='manageAdmin.php'" value="Create another Admin">
            <input type="button" onclick="location.href='homeAdmin.php'" value="Back to Home">
        </body>

        </html>
    <?php } else { ?>
        <html>

        <head>
            <title>Error!</title>
        </head>

        <body align="center">
            <?php echo $msg; ?><br>
            <input type="button" onclick="location.href='../index.html'" value="Index">
        </body>

        </html>
    <?php }
}

function adminVerification()        // If valid admin, returns true
{

    if (isset($_COOKIE['userType']) && isset($_COOKIE['username']) && isset($_COOKIE['loginStatus'])) {
        if ($_COOKIE['userType'] == "admin") {
            $file = fopen('../../DB/user.txt', 'r');

            while (!feof($file)) {
                $data = fgets($file);
                $user = explode('|', $data);
                if ($_COOKIE['username'] == trim($user[0])) {

                    if (trim($user[8]) == "admin") {
                        return true;
                    } else {
                        setcookie('userType', trim($user[8]), time() + 3600, '/');
                        return false;
                    }
                }
            }
        }
    }
    return false;
}

function listUsers()
{
    $file = fopen('../../db/user.txt', 'r'); ?>
    <html>

    <head>
        <title>Users List</title>
    </head>

    <body>
        <form method="post" action="">
            <fieldset>
                <legend>Users</legend>
                <table border="1">
                    <tr align="center">
                        <td><b>USERNAME</b></td>
                        <td><b>Name</b></td>
                        <td><b>EMAIL</b></td>
                        <td><b>Date of Birth</b></td>
                        <td><b>Gender</b></td>
                        <td><b>Address</b></td>
                        <td><b>NID</b></td>
                        <td><b>USER TYPE</b></td>
                        <td><b>Phone</b></td>

                        <td><b>ACTION</b></td>
                    </tr>
                    <?php
                    while (!feof($file)) {
                        $user = explode('|', fgets($file));
                        if (trim($user[0]) == "") {
                            break;
                        }
                    ?>
                        <tr align="center">
                            <td><?php echo trim($user[0]) ?></td>
                            <td><?php echo trim($user[1]) ?></td>
                            <td><?php echo trim($user[3]) ?></td>
                            <td><?php echo trim($user[4]) ?></td>
                            <td><?php echo trim($user[5]) ?></td>
                            <td><?php echo trim($user[6]) ?></td>
                            <td><?php echo trim($user[7]) ?></td>
                            <td><?php echo trim($user[8]) ?></td>
                            <td><?php echo trim($user[9]) ?></td>
                            <td>
                                <button type="submit" name="makeAdmin" value=<?php echo trim($user[0]) ?>>Make Admin</button>
                                <button type="submit" name="deleteUser" value=<?php echo trim($user[0]) ?>>Delete User</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </fieldset>
        </form>
        <button type="button" onclick="location.href='manageAdmin.php'">Refresh</button>
        <input type="button" onclick="location.href='adminReg/adminRegForm.php'" value="Add Admin">
        <input type="button" onclick="location.href='homeadmin.php'" value="Back">
    </body>

    </html>
<?php }

function deleteUser($username)
{
    $file = file('../../db/user.txt');
    foreach ($file as $key => $row) {
        if (preg_match("/($username)/", $row)) {
            unset($file[$key]);
            file_put_contents("../../db/user.txt", trim(implode($file)) . "\r\n");
        }
    }
}

function appendToFile($user)
{
    $file = fopen('../../db/user.txt', 'a');
    fwrite($file, $user);
}

function makeAdmin()
{
    $username = $_POST['makeAdmin'];


    $file = fopen('../../db/user.txt', 'r');

    while (!feof($file)) {
        $data = fgets($file);
        $userInfo = explode('|', $data);
        if ($username == trim($userInfo[0])) {
            if (trim($userInfo[8] == "admin")) {
                printDialogue("alreadyAdmin");
                break;
            } else {
                $userInfo[8] = "admin";

                $updatedUserInfo = $userInfo[0];

                for ($i = 1; $i < count($userInfo); $i++) {
                    $updatedUserInfo = $updatedUserInfo . "|" . $userInfo[$i];
                }
                deleteUser($username);
                appendToFile($updatedUserInfo . "\r\n");
                break;
            }
        }
    }
    printDialogue("success");
}

if (isset($_POST['makeAdmin'])) {
    makeAdmin();
} elseif (isset($_POST['deleteUser'])) {
    deleteUser($_POST['deleteUser']);
    header("location: manageAdmin.php");
} else {
    if (adminVerification()) {
        listUsers();
    } else {
        printDialogue("Please Sign In again!");
    }
}
