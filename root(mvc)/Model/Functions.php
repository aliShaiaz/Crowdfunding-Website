<?php

// function displayError($msg)
// {
//     echo "<center>" . $msg . "<br><input type=\"button\" onclick=\"location.href='index.html'\" value=\"Back to Index\"></center>";
// }

function FUNCTIONS_checkAdmin()
{
    // This function will check whether the logged in user is an Admin or not //
    $username = $_SESSION['userInfo']['username'];
    if ($username != false) {
        $user = DB_getUserInfo($username);
        if ($user != false) {
            if ($user['userType'] == 'admin') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function FUNCTIONS_getUserType($username)
{
    $user = DB_getUserInfo($username);

    if ($user != false) {
        if ($user != '') {
            return $user['userType'];
        } else {
            return false;
        }
    } else {
        return false;
    }
}


function printError($message, $redirectLocation)
{
    echo "
    <meta http-equiv = \"refresh\" content = \"0; url = " . $redirectLocation . "\" />
        <h1 align=\"center\">
            <b>Redirecting you!</b>
        </h1>
    <script>
        alert(\"" . $message . "\");
    </script>";
}

function isSignedIn()
{
    if (isset($_COOKIE['loginStatus'])) {
        return true;
    } else {
        return false;
    }
}





// function notSignedIn()
// {
//     if (!isset($_COOKIE['loginStatus'])) {
//         return true;
//     } else {
//         echo "
//         <meta http-equiv = \"refresh\" content = \"2; url = ../homepage/homepage.php\" />
//             <h1 align=\"center\">
//                 <b>Redirecting you to your Homepage!</b>
//             </h1>
//         <script>
//             alert(\"You are already signed in! You will be redirected to homepage shortly!\");
//         </script>";
//     }
// }
