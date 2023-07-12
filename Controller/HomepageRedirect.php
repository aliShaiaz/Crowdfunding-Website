<?php

function displayPage($msg)
{
?>
    <html>

    <head>
        <title>HomePage</title>
    </head>

    <body>
        <h1>Welcome <?php echo $msg ?>..</h1> This is your home Page!
        <br>
        <input type="button" onclick="location.href='../../index.html'" value="Go to Index">
        <input type="button" onclick="location.href='../logout/logout.php'" value="Log Out">
    </body>

    </html>
<?php
}

if (isset($_COOKIE['loginStatus']) && isset($_COOKIE['userType'])) {

    if ($_COOKIE['userType'] == "admin") {
        header('location: admin/homeadmin.php');
    } elseif ($_COOKIE['userType'] == "individual") {
        // displayPage("Individual");
        header('location: ../../../m2/indorg user/indhome.php');
    } elseif ($_COOKIE['userType'] == "investor") {
        displayPage("Investor");
    } elseif ($_COOKIE['userType'] == "organization") {
        // displayPage("Organization");
        header('location: ../../../m2/indorg user/orghome.php');
    } else {
        setcookie('loginStatus', 'false', time() - 100, '/');
        echo "<center>
                You are logged out! Please Login Again!<br>
                <input type=\"button\" onClick=\"location.href='../login/login.php'\" value=\"Login\"
            </center>";
    }
} else {
    echo "You are not Signed In.";
    sleep(3);
    header ("location: ../View/Index.html");
}
