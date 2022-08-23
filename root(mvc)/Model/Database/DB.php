<?php

function DB_getUserInfo($username)
{
    $user = MySQL_runSQL("SELECT * FROM users WHERE username = '$username';");

    if (count($user) != 0) {
        return $user[0];
    } else {
        return false;
    }


    // $file = fopen('Asset/user.txt', 'r'); // For login check

    // while (!feof($file)) {
    //     $data = fgets($file);
    //     $user = explode('|', $data);
    //     if ($username == trim($user[0])) {
    //         return $user;
    //     }
    // }

}

function DB_getUserID($username)
{
    $user = DB_getUserInfo($username);
    return $user['userID'];
}

function DB_getAllUsers()
{
    // $file = fopen('Asset/user.txt', 'r'); // For login check
    // $users = [];
    // $i = 0;
    // while (!feof($file)) {
    //     $data = fgets($file);
    //     $user = explode('|', $data);
    //     if ($user[0] != '') {
    //         $users[$i] = $user;
    //         $i++;
    //     }
    // }
    // return $users;

    $users = MySQL_runSQL('SELECT * FROM users');
    return $users;
}

function DB_usernameIsAvailable($username)
{
    $users = DB_getAllUsers();
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            return false;
        }
    }
    return true;
}

function DB_checkUser($username, $password)     // . . Return $user if $username & $password is correct . . //
{
    // $user = MySQL_runSQL("SELECT * FROM users WHERE username = '$username';");
    $user = DB_getUserInfo($username);

    if ($user != false) {
        if ($user['password'] == $password) {
            return $user;
        }
    } else {
        return false;
    }
}



// function DB_getSessions()
// {
//     $file = fopen('Asset/session.txt', 'r'); 
//     $sessions = [];
//     $i = 0;
//     while (!feof($file)) {
//         $data = fgets($file);
//         $session = explode('|', $data);
//         if ($session[0] != '') {
//             $sessions[$i] = $session;
//             $i++;
//         }
//     }
//     return $sessions;
// }


// . . .  Register User  . . . //

function DB_createUser_person($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone)
{
    $sql = "INSERT INTO users (activeStatus, userID, username, password, userType, firstName, lastName, email, dob, gender, address, nid, phone, empID, empRole, orgname, tradeLicense) VALUES (true, '$userID', '$username', '$password', '$userType', '$firstName', '$lastName', '$email', '$dob', '$gender', '$address', '$nid', '$phone', null, null, null, null);";
    // $sql = "INSERT INTO users (userID, username, password, userType, firstName, lastName, email, dob, gender, address, nid, phone) VALUES ( $userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone);";

    return MySQL_runSQL($sql);
}
function DB_createUser_org($userID, $username, $password, $userType, $orgname, $phone, $email, $address, $tradeLicense)
{
    $sql = "INSERT INTO users (activeStatus, userID, username, password, userType, orgname, phone, email, address, tradeLicense, firstName, lastName, dob, gender, nid) VALUES (true, '$userID', '$username', '$password', '$userType', '$orgname', '$phone', '$email', '$address', '$tradeLicense', null, null, null, null, null);";

    return MySQL_runSQL($sql);
}
function DB_createUser_official($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone, $empID, $empRole)
{
    $sql = "INSERT INTO users (activeStatus, userID, username, password, userType, firstName, lastName, email, dob, gender, address, nid, phone, empID, empRole, orgname, tradeLicense) VALUES (true, '$userID', '$username', '$password', '$userType', '$firstName', '$lastName', '$email', '$dob', '$gender', '$address', '$nid', '$phone', '$empID', '$empRole', null, null);";

    return MySQL_runSQL($sql);
}

function DB_updateUser($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone, $empID, $empRole, $orgName, $tradeLicense)
{
    // $sql = "UPDATE users SET userID='$userID',password='$password',userType='$userType',firstName=$firstName,lastName='$lastName',email='$email',dob='$dob',gender='$gender',address='$address',nid='$nid',phone='$phone',empID='$empID',empRole='$empRole',orgName='$orgName', tradeLicense='$tradeLicense' WHERE username = '$username';";

    if ($userType == 'inv' || $userType == 'indiv') {
        $sql = "UPDATE users SET userID='$userID',password='$password',userType='$userType',firstName='$firstName',lastName='$lastName',email='$email',dob='$dob',gender='$gender',address='$address',nid='$nid',phone='$phone' WHERE username = '$username';";
    } elseif ($userType == 'official') {
        $sql = "UPDATE users SET userID='$userID',password='$password',userType='$userType',firstName='$firstName',lastName='$lastName',email='$email',dob='$dob',gender='$gender',address='$address',nid='$nid',phone='$phone',empID='$empID',empRole='$empRole' WHERE username = '$username';";
    } elseif ($userType == 'org') {
        $sql = "UPDATE users SET userID='$userID',password='$password',userType='$userType,email='$email',address='$address',phone='$phone',orgName='$orgName', tradeLicense='$tradeLicense' WHERE username = '$username';";
    }
    return MySQL_runSQL($sql);
}

function DB_resetPassword($username, $password)
{
    $sql = "UPDATE users SET password='$password' WHERE username = '$username';";
    return MySQL_runSQL($sql);
}

function DB_updateActiveStatus($username, $activeStatus)
{
    $sql = "UPDATE users SET activeStatus='$activeStatus' WHERE username = '$username';";

    return MySQL_runSQL($sql);
}

function DB_getUserCount()
{
    return count(MySQL_runSQL("select * from users"));
}

//  . . .  //

// . . .  Session  . . . //
function DB_isUniqueSessionID($sessionID) // Checks DB whether ID available or not and returns true/false!! //
{
    $session = MySQL_runSQL("SELECT * FROM sessions WHERE sessionID = '$sessionID';");
    if (count($session) == 0) {
        return true;
    } else {
        return false;
    }
}

function DB_addSession($sessionID, $userID, $username, $password, $userType)             // Append Session to DB
{
    return MySQL_runSQL("INSERT INTO sessions (sessionID, userID, username, password, userType) VALUES ('$sessionID', '$userID', '$username', '$password', '$userType');");
}

function DB_removeSession($username)
{
    MySQL_runSQL("DELETE FROM sessions WHERE username = '$username';");
}

function DB_getSessionInfo($sessionID)
{
    $session = MySQL_runSQL("SELECT * FROM sessions WHERE sessionID = '$sessionID';");
    if (count($session) != 0) {
        return $session[0];
    } else {
        return false;
    }

    // $file = fopen('Asset/session.txt', 'r'); // For login check

    // while (!feof($file)) {
    //     $data = fgets($file);
    //     $session = explode('|', $data);
    //     if ($sessionID == trim($session[0])) {
    //         return $session;
    //     }
    // }
    // return false;
}


//  . . .  //

// Files //
function DB_addProfilePhoto($username)
{
    $src = $_FILES['profilePhoto']['tmp_name'];
    $des = "Asset/Storage/profilePhotos/" . $username . ".png";
    return move_uploaded_file($src, $des);

    // if (move_uploaded_file($src, $des)) {
    // echo "success";
    // } else {
    //     echo "Error";
    // }
}
// . . . //
