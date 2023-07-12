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
