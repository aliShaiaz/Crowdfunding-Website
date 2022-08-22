<?php

// . . . Require Requests . . . //

// Admin Views //
require_once('View/Admin/homeAdmin.php');
require_once('View/Admin/usersList.php');
require_once('View/Admin/profileSettings.php');
require_once('View/Admin/updateUser.php');
require_once('View/Admin/viewRequests.php');

// Login System Views //
require_once('View/registration.php');
require_once('View/login.php');
require_once('View/dummyHome.php');

// . . .  Homepages . . . //
// function displayHomeEditor()
// {
//     header("location: View/tempHomepages/editor.php");
// }
// function displayHomeOrganization()
// {
//     header("location: View/tempHomepages/organization.php");
// }
// function displayHomeIndividual()
// {
//     header("location: View/tempHomepages/individual.php");
// }
// function displayHomeInvestor()
// {
//     header("location: View/tempHomepages/investor.php");
// }


// . . . //


// . . . Admin Panel . . . //

// function VIEW_displayUsersList()
// {
//     require_once("View/Admin/usersList.php");
//     displayUsersList();
// }



function displayError($message, $redirectLocation)
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

function displayIndex()
{
    // This function will redirect to the 'index.html' file in view..
    header("location: index.html");
}


// function displayLogin()
// {
//     // This will display the login page
//     header("location: View/login.html");
// }
