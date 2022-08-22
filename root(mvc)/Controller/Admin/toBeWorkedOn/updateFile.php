<?php

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

function addUser($userInfo)
{
    $name = explode(' ', $userInfo[1]);

    if ($userInfo[8] == "investor") { ?>
        <html>

        <head>
            <title>Investor's Info Update</title>
            <script>
                function empty() {
                    var x;

                    // Username Check
                    x = document.getElementById("username").value;
                    if (x == "") {
                        alert("Enter a Valid Username.");
                        return false;
                    };

                    // Firstname Check
                    x = document.getElementById("firstName").value;
                    if (x == "") {
                        alert("Enter a Valid First Name.");

                        return false;
                    };

                    // Lastname Check
                    x = document.getElementById("lastName").value;
                    if (x == "") {
                        alert("Enter a Valid Last Name.");
                        return false;
                    };

                    // Password Check
                    pass = document.getElementById('password').value;
                    cPass = document.getElementById('confirmPassword').value;
                    if (pass == "" || cPass == "") {
                        alert("Please enter your Password!");
                        return false;
                    } else if (cPass != pass) {
                        alert("Your passwords do not match!");
                        return false;
                    }

                    // Date of Birt Check (whether 18+ or not)
                    date = document.getElementById('dob').value.trim();
                    dob = Date.parse(date);
                    today = Date.parse(Date());
                    diff = today - dob;
                    if (diff < 567648000000) { // 567648000000 is 18 yrs in milisec.
                        alert("You have to be an adult to register!");
                        return false;
                    } else if (date == "") {
                        alert("Please Enter Date of Birth!");
                        return false;
                    }

                    // Gender Check
                    x = document.getElementById("gender").value;
                    if (x == "") {
                        alert("Please select your Gender.");
                        return false;
                    };

                    // Address Check
                    x = document.getElementById("address").value;
                    if (x == "") {
                        alert("Enter a valid Address.");
                        return false;
                    };

                    // NID Check
                    x = document.getElementById("nid").value;
                    if (x == "") {
                        alert("Enter a valid NID Number.");
                        return false;
                    };
                }
            </script>

        </head>

        <body>

            <form method="post" action="../loginSystem/Register/regChecker.php" enctype="">

                <fieldset style="float:inline-start">
                    <legend>Investor Registration</legend>
                    <table>
                        <tr>
                            <td>
                                Username:
                            </td>
                            <td>
                                <input id="username" type="text" name="username" value="<?php echo $userInfo[0] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                First Name:
                            </td>
                            <td>
                                <input id="firstName" type="text" name="firstName" value="<?php echo trim($name[0]); ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Last Name:
                            </td>
                            <td>
                                <input id="lastName" type="text" name="lastName" value="<?php echo trim($name[1]); ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Password:
                            </td>
                            <td>
                                <input id="password" type="password" name="password" value="<?php echo $userInfo[2] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Confirm Password:
                            </td>
                            <td>
                                <input id="confirmPassword" type="password" name="confirmPassword" value="<?php echo $userInfo[2] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email:
                            </td>
                            <td>
                                <input id="email" type="email" name="email" value="<?php echo $userInfo[3] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Date of Birth:
                            </td>
                            <td>
                                <input id="dob" type="date" name="dob" value="<?php echo $userInfo[4] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Gender:
                            </td>
                            <td>
                                <select id="gender" name="gender">
                                    <option value="<?php echo $userInfo[5] ?>">Choose Your Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Address:
                            </td>
                            <td>
                                <input id="address" type="text" name="address" value="<?php echo $userInfo[6] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NID:
                            </td>
                            <td>
                                <input id="nid" type="text" name="nid" value="<?php echo $userInfo[7] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Contact Number:
                            </td>
                            <td>
                                <input id="phone" type="tel" name="phone" pattern="[0][1][3-9][0-9]{2}-[0-9]{6}" placeholder="<?php echo $userInfo[8] ?>" value="<?php echo $userInfo[9] ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <hr>
                                <input type="submit" onclick="return empty()">
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <input type="hidden" name="userInfo[8]" value="investor">
                <input type="hidden" name="update" value="">

            </form>
        </body>

        </html>
    <?php } elseif ($userInfo[8] == "individual") { ?>
        <html>

        <head>
            <title>Individual's Info Update</title>
            <script>
                function empty() {
                    var x;

                    // Username Check
                    x = document.getElementById("username").value;
                    if (x == "") {
                        alert("Enter a Valid Username.");
                        return false;
                    };

                    // Firstname Check
                    x = document.getElementById("firstName").value;
                    if (x == "") {
                        alert("Enter a Valid First Name.");

                        return false;
                    };

                    // Lastname Check
                    x = document.getElementById("lastName").value;
                    if (x == "") {
                        alert("Enter a Valid Last Name.");
                        return false;
                    };

                    // Password Check
                    pass = document.getElementById('password').value;
                    cPass = document.getElementById('confirmPassword').value;
                    if (pass == "" || cPass == "") {
                        alert("Please enter your Password!");
                        return false;
                    } else if (cPass != pass) {
                        alert("Your passwords do not match!");
                        return false;
                    }

                    // Date of Birt Check (whether 18+ or not)
                    date = document.getElementById('dob').value.trim();
                    dob = Date.parse(date);
                    today = Date.parse(Date());
                    diff = today - dob;
                    if (diff < 567648000000) { // 567648000000 is 18 yrs in milisec.
                        alert("You have to be an adult to register!");
                        return false;
                    } else if (date == "") {
                        alert("Please Enter Date of Birth!");
                        return false;
                    }

                    // Gender Check
                    x = document.getElementById("gender").value;
                    if (x == "") {
                        alert("Please select your Gender.");
                        return false;
                    };

                    // Address Check
                    x = document.getElementById("address").value;
                    if (x == "") {
                        alert("Enter a valid Address.");
                        return false;
                    };

                    // NID Check
                    x = document.getElementById("nid").value;
                    if (x == "") {
                        alert("Enter a valid NID Number.");
                        return false;
                    };
                }
            </script>

        </head>

        <body>

            <form method="post" action="../loginSystem/Register/regChecker.php" enctype="">

                <fieldset style="float:inline-start">
                    <legend>Investor Registration</legend>
                    <table>
                        <tr>
                            <td>
                                Username:
                            </td>
                            <td>
                                <input id="username" type="text" name="username" value="<?php echo $userInfo[0] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                First Name:
                            </td>
                            <td>
                                <input id="firstName" type="text" name="firstName" value="<?php echo trim($name[0]); ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Last Name:
                            </td>
                            <td>
                                <input id="lastName" type="text" name="lastName" value="<?php echo trim($name[1]); ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Password:
                            </td>
                            <td>
                                <input id="password" type="password" name="password" value="<?php echo $userInfo[2] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Confirm Password:
                            </td>
                            <td>
                                <input id="confirmPassword" type="password" name="confirmPassword" value="<?php echo $userInfo[2] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email:
                            </td>
                            <td>
                                <input id="email" type="email" name="email" value="<?php echo $userInfo[3] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Date of Birth:
                            </td>
                            <td>
                                <input id="dob" type="date" name="dob" value="<?php echo $userInfo[4] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Gender:
                            </td>
                            <td>
                                <select id="gender" name="gender">
                                    <option value="<?php echo $userInfo[5] ?>">Choose Your Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Address:
                            </td>
                            <td>
                                <input id="address" type="text" name="address" value="<?php echo $userInfo[6] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NID:
                            </td>
                            <td>
                                <input id="nid" type="text" name="nid" value="<?php echo $userInfo[7] ?>"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Contact Number:
                            </td>
                            <td>
                                <input id="phone" type="tel" name="phone" pattern="[0][1][3-9][0-9]{2}-[0-9]{6}" placeholder="<?php echo $userInfo[8] ?>" value="<?php echo $userInfo[9] ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr>
                                <input type="submit" onclick="return empty()">
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <input type="hidden" name="userInfo[8]" value="individual">
                <input type="hidden" name="update" value="">


            </form>
        </body>

        </html>
    <?php } elseif ($userInfo[8] == "organization") { ?>

        <head>
            <title>Under Development</title>
        </head>

        <body>
            <div>
                <fieldse align="center">
                    <h1>Organization Registration Page</h1>
                    <p>(Under Development)</p>
                    </fieldset>
            </div>
        </body>
    <?php }
}

function displayErrorPage()
{ ?>
    <html>

    <head>
        <title>Unauthorized Attempt</title>
    </head>

    <body>
        <h1>You are not admin</h1>
        <p><input type="button" onclick="location.href='../loginsystem/homepage/homepage.php'" value="Go Back to My Homepage"></p>
    </body>

    </html>
<?php }

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


if (adminVerification()) {

    if (isset($_POST['update'])) {
        $file = fopen('../../db/user.txt', 'r');
        $username = $_POST['update'];

        while (!feof($file)) {
            $data = fgets($file);
            $user = explode('|', $data);
            if ($username == trim($user[0])) {
                deleteUser($username);
                addUser($user);
            }
        }
    } elseif (isset($_POST['delete'])) {
        deleteUser($_POST['delete']);
        header("Location: listUsers.php");
    }
    // elseif (isset($_POST['deleteAdmin'])) {
    //     deleteUser($_POST['deleteAdmin']);
    //     header("Location: manageAdmin.php");
    // }
} else DisplayErrorPage();
