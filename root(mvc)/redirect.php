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
        echo  "working here";
        // echo json_encode(DB_getUserInfo($_REQUEST['getUserInfo']));


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

    USER_updateActiveStatus($user['username'], $activeStatus);

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
    // setSessionInfo($_COOKIE['session']);
    echo $_SESSION['userInfo']['username'];
    // echo $_COOKIE['session'];
    // echo 100;
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

function submitGetPosts()
{
    // echo 'asdf';
    echo json_encode(POSTS_getAllPosts());
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

// . . . POSTS . . . //
elseif (isset($_REQUEST['getPosts'])) {
    submitGetPosts();
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
    // submitHome();
    displayIndex();
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
    // VIEW_requests();
    ADMIN_displayRequestList();
} elseif (isset($_REQUEST['getReqList'])) {
    echo json_encode(REQ_getAllRequests());
    // echo 'here';
} elseif (isset($_REQUEST['approve'])) {
    $reqID = $_REQUEST['approve'];
    $req = REQ_getRequestInfo($reqID);

    POSTS_approve($req['postID']);
    REQ_approve($req['postID']);
    header('location: redirect.php?viewRequests');
} elseif (isset($_REQUEST['refuse'])) {
    $reqID = $_REQUEST['refuse'];
    $req = REQ_getRequestInfo($reqID);

    POSTS_refuse($req['postID']);
    REQ_refuse($req['postID']);
    header('location: redirect.php?viewRequests');
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

// . . . Transactions . . . //

elseif (isset($_REQUEST['withdraw'])) {
    // echo 'Withdraw';

    VIEW_transaction();
} elseif (isset($_REQUEST['getBalance'])) {
    echo F_getAccountBalance(DB_getUserInfo($_SESSION['userInfo']['username'])['accountID']);
} elseif (isset($_REQUEST['createAccount'])) {
    if ($_SESSION['userInfo']['username'] == null) {
        USER_addAccount($_SESSION['userInfo']['username'], F_createAccount($username));
        header('location: redirect.php?index');
    } else {
        FUNCTIONS_notifyFailedAttemt("You already have an Account!!", 'redirect.php?index');
    }
} elseif (isset($_REQUEST['submitTransferRequest'])) {
    // recipientAccountID recipientUsername senderPassword transferAmount recipientType

    $request = json_decode($_POST['data']);

    $amount = intval($request->transferAmount);


    // . . . CHECKLIST . . . //
    // @ SENDER @
    // Password check
    // Account check
    // Balance check

    // @ RECEIVER @
    // is valid username
    // has account

    // @ ACCOUNT @
    // account exits

    $clearence = true;

    $sender = [];
    $receiver = [];
    $resp = [];
    $resp['status'] = '';


    if ($amount != 0 && $amount >= 100 & $amount <= 10000) {
        // @ SENDER @
        // password, account, balance
        if ($_SESSION['userInfo']['password'] != $request->senderPassword) {
            $resp['issue'] = "Incorrect Password!";
            $clearence = false;
        } else {

            $sender['accountID'] = USER_getAccountID($_SESSION['userInfo']['username']);
            if ($sender['accountID'] == null) {
                $resp['issue'] = "Sender Doesn't have an Account!";
                $clearence = false;
            } else {
                $balance = F_getAccountBalance($sender['accountID']);
                if ($amount > $balance) {
                    $resp['issue'] = "Sender Doesn't sufficient Balance!";
                    $clearence = false;
                }
            }
        }


        if ($request->recipientType == 'user') {
            // @ RECEIVER @
            // is valid username
            // has account
            $receiver['username'] = $request->recipientUsername;
            if (!DB_getUserInfo($receiver['username'])) {
                $resp['issue'] = "Incorrect Username!";
                $clearence = false;
            } else {
                $receiver['accountID'] = USER_getAccountID($receiver['username']);
                if (!$receiver['accountID']) {
                    $resp['issue'] = "Receiver Doesn't have an Account!!";
                    $clearence = false;
                }
            }
        } elseif ($request->recipientType == 'account') {
            // @ ACCOUNT @
            // account exits
            $receiver['accountID'] = $request->recipientAccountID;
            if (!F_getAccountInfo($receiver['accountID'])) {
                $resp['issue'] = "The account doesn't exit!!";
                $clearence = false;
            }
        }
        if ($request->recipientType == 'withdraw') {
        }
    } else {
        $resp['issue'] = "Amount has to be at least 100 BDT.!";
        $clearence = false;
    }



    if ($clearence) {
        $resp['trxID'] = F_transfer($sender['accountID'], $receiver['accountID'], $amount);
        $resp['status'] = 'success';
    }











    echo json_encode($resp);
    // echo 100;

    // getAccountID
    // $resp['status'] = 'success';

}





// . . . If nothing, display Index . . . //
else {
    displayIndex();
    // if (USER_getAccountID('person1') == null) {
    //     echo 'null';
    // }

    // if (DB_getUserInfo('admin')) {
    //     echo 'true';
    // } else {
    //     echo 'false';
    // }
}
