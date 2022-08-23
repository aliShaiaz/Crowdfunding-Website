<?php
session_start();

require_once("Controller/LoginSystem/controlLS.php");
require_once("View/controlView.php");
require_once('Model/Functions.php');
require_once('Controller/Admin/controlAdmin.php');
require_once('Model/controlModel.php');


function setSessionInfo($sessionID)
{
    $session = DB_getSessionInfo($sessionID);

    if ($session != false) {
        $_SESSION['userInfo'] = $session;
    } else {
        unset($_COOKIE['session']);
    }
}

function submitLogin()
{
    if (isset($_POST["username"]) && isset($_POST["password"])) {

        // echo "here";
        // require_once("Controller/LoginSystem/controlLS.php");


        $sessionID = login(trim($_POST["username"]), trim($_POST["password"]));     // $login will store the SessionID returned from loginUser();

        if ($sessionID != false) {
            setSessionInfo($sessionID);
            setcookie('session', $sessionID, time() + 3600, '/');
            header('location: redirect.php?home');
            // echo "<script> alert(\"Login Successfull!\"); </script>;
            // <meta http-equiv=\"refresh\" content=\"0; url = index.html\"/>";
        } else {
            echo "<meta http-equiv=\"refresh\" content=\"0; url = redirect.php?login\" />
            <script>
                alert(\"Login Unsuccessful! Try Again!\");
            </script>";
        }
    } else {
        // require_once("View/controlView.php");
        displayError("Malicious Attempt to Submit Login Info!!", "/index.html");
    }
}

function submitLogout()
{
    logout();
    // SESSION_removeUserSession($_SESSION['userInfo'][0]);
}

function submitNewReg()
{
    if (!isset($_COOKIE['session'])) {
        if (LS_checkRegistration()) {         // This will return either 'true' or 'false'
            header('location: redirect.php?login');
        }
    } else {
        header('location: redirect.php?home');
    }
}

function submitRegister()
{
    if (!isset($_COOKIE['session'])) {
        VIEW_Registration();
    } else {
        header('location: redirect.php');
    }
}

function submitCheckUsername()
{

    // $json = $_POST['username'];
    // $user = json_decode($json);
    // print_r($user->username);
    // if (DB_usernameIsAvailable($username)) {
    //     echo true;
    // } else {
    //     echo false;
    // }
    echo DB_usernameIsAvailable(strtolower($_POST['username']));
    // if (isset($_POST['username'])) {
    //     echo 100;
    // } else {
    //     echo -1;
    // }
}

function submitHome()
{
    if (isset($_COOKIE['session']) && $_COOKIE['session'] == trim($_SESSION['userInfo']['sessionID'])) {
        if (trim($_SESSION['userInfo']['userType']) == "admin") {
            if (FUNCTIONS_checkAdmin()) {
                VIEW_homeAdmin();
            } else {
                header('location: redirect.php');
            }
        } elseif (trim($_SESSION['userInfo']['userType']) == "editor") {
            VIEW_dummyHome();
        } elseif (trim($_SESSION['userInfo']['userType']) == "org") {
            VIEW_dummyHome();
        } elseif (trim($_SESSION['userInfo']['userType']) == "indiv") {
            VIEW_dummyHome();
        } elseif (trim($_SESSION['userInfo']['userType']) == "inv") {
            VIEW_dummyHome();
        }
    } else {
        logout();
    }
}


// . . . Admin Submits . . . //

function submitListUsers()
{
    if (FUNCTIONS_checkAdmin()) {
        // If FUNCTIONS_checkAdmin() is true, meaning signed in user is an Admin, then execute //
        ADMIN_displayUsersList();
    }
}

function submitGetUsersList()
{
    if (FUNCTIONS_checkAdmin()) {
        // If FUNCTIONS_checkAdmin() is true, meaning signed in user is an Admin, then execute //
        ADMIN_getUsersList();
    }
}

function submitUpdateUser()
{
    if (FUNCTIONS_checkAdmin()) {
        // echo $_REQUEST['edit'];
        VIEW_updateUser($_REQUEST['edit']);
    }
}

function submitGetUserInfo()
{
    if (FUNCTIONS_checkAdmin()) {
        // working here
        echo json_encode(DB_getUserInfo($_REQUEST['getUserInfo']));
        // echo $_REQUEST['getUserInfo'];
        // echo json_encode(DB_getUserInfo($_REQUEST['username']));
        // if ($_REQUEST['getUserInfo'] == "") {
        //     echo 'blank';
        // } else {
        //     echo $_REQUEST['getUserInfo'];
        // }
        // echo json_encode();
    }
}

function submitprofileSettings()
{
    if ($_SESSION['userInfo']['userType'] == 'admin') {
        VIEW_profileSettings();
    }
}

function submitInfoUpdate()
{
    // $activeStatus = true;
    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if ($userType == 'admin') {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $nid = $_POST['nid'];
        $empID = $_POST['empID'];
        $empRole = $_POST['empRole'];

        $orgName = "NULL";
        $tradeLicense = "NULL";
    } elseif ($userType == 'inv' || $userType == 'indiv') {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $nid = $_POST['nid'];

        $empID = "NULL";
        $empRole = "NULL";
        $orgName = "NULL";
        $tradeLicense = "NULL";
    } elseif ($userType == 'org') {

        $orgName = $_POST['orgName'];
        $tradeLicense = $_POST['tradeLicense'];

        $firstName = "NULL";
        $lastName = "NULL";
        $dob = "NULL";
        $gender = "NULL";
        $nid = "NULL";
        $empID = "NULL";
        $empRole = "NULL";
    }
    DB_addProfilePhoto($username);
    DB_updateUser($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone, $empID, $empRole, $orgName, $tradeLicense);

    if ($_POST['username'] == $_SESSION['userInfo']['username']) {
        header('location: redirect.php?profileSettings');
    } else {
        header('location: redirect.php?listUsers');
    }
}
function submitToggleActiveStatus()
{
    if (isset($_REQUEST['toggleActiveStatus'])) {
        $user = DB_getUserInfo($_REQUEST['toggleActiveStatus']);
    } else {
        $user = DB_getUserInfo($_POST['username']);
    }
    if ($user['activeStatus'] == 0) {
        $activeStatus = 1;
    } else {
        $activeStatus = 0;
    }
    // echo $activeStatus;

    DB_updateActiveStatus($user['username'], $activeStatus);

    if ($user['username'] == $_SESSION['userInfo']['username']) {
        logout();
        header('location: redirect.php');
    } else {
        header('location: redirect.php?listUsers');
    }
}

function submitGetProfileInfo()
{
    ADMIN_getProfileInfo();
}

function submitGetUsername()
{
    echo $_SESSION['userInfo']['username'];
}

function submitRecoverID()
{
    VIEW_recoverID();
    // echo 'hole';
}

function submitRecoverRequest()
{
    $json = json_decode($_POST['data']);
    $user = DB_getUserInfo($json->username);
    if ($user) {
        // echo 'app';
        if ($user['lastName'] == $json->lastName && $user['dob'] == $json->dob) {
            // echo 'true';
            echo VIEW_createNewPassword($user['username']);
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}

function submitNewPassword()
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];
    if (REG_passwordValidation($password, $cPassword)) {
        DB_resetPassword($username, $password);
        header('location: redirect.php?login');
    } else {
        header('location: redirect.php?login');
    }
    // echo $username . "<br>";
    // echo $password;
}








//  .. ..  Driver Code  ..  ..  //

if (isset($_COOKIE['session'])) {
    setSessionInfo($_COOKIE['session']);
}

// . . .  Requests . . . //
if (isset($_GET['login'])) {
    // If get request is for Login
    VIEW_login();
}
// ID Recovery //
elseif (isset($_REQUEST['recover'])) {
    // echo 'recovering ID';
    submitRecoverID();
} elseif (isset($_REQUEST['submitRecoverRequest'])) {
    submitRecoverRequest();
} elseif (isset($_REQUEST['submitNewPassword'])) {
    submitNewPassword();
}
// . . . //

elseif (isset($_GET['loginSubmit'])) {
    submitLogin();
} elseif (isset($_REQUEST['getUsername'])) {
    submitGetUsername();
    // echo false;
}

// . . . EDIT/DELETE REQUESTS . . . //
elseif (isset($_REQUEST['edit'])) {
    // echo 'Edit: ' . $_REQUEST['edit'];
    submitUpdateUser();
} elseif (isset($_REQUEST['delete'])) {
    echo 'Delete: ' . $_REQUEST['delete'];
}



// Registration //
elseif (isset($_GET['register'])) {
    // If get request is for Register
    // echo "register pressed";
    submitRegister();
} elseif (isset($_GET['regSubmit'])) {
    submitNewReg();
    // echo $_POST['userType'];
}
// Registration //

elseif (isset($_REQUEST['home'])) {
    // If get request is for User Home Page
    // echo "home pressed";
    // echo $_SESSION['userInfo']['userType'];
    submitHome();
    // echo 'home';
} elseif (isset($_GET['logout'])) {
    // If get request is for Logout
    // echo "logout pressed";
    submitLogout();
} elseif (isset($_GET['index'])) {
    displayIndex();
} elseif (isset($_GET['checkUsername'])) {
    submitCheckUsername();
}

// Admin Requests //

elseif (isset($_REQUEST['listUsers'])) {
    submitListUsers();
} elseif (isset($_REQUEST['getUsersList'])) {
    submitGetUsersList();
    // echo json_encode("getting users list");
} elseif (isset($_GET['getUserInfo'])) {
    submitGetUserInfo();
}
// . . . View Requests . . . //
elseif (isset($_REQUEST['viewRequests'])) {
    VIEW_requests();
}


// Profile Edit //
elseif (isset($_GET['profileSettings'])) {
    submitprofileSettings();
} elseif (isset($_GET['getProfileInfo'])) {
    submitGetProfileInfo();
} elseif (isset($_POST['infoUpdate'])) {
    submitInfoUpdate();
} elseif (isset($_POST['disableAccount']) || isset($_REQUEST['toggleActiveStatus'])) {
    submitToggleActiveStatus();
}





// . . . If nothing, display Index . . . //
else {
    displayIndex();
}
