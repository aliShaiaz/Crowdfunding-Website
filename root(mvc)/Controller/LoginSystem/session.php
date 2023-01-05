<?php

function getSessionIDHash($len = 32)
{
    $sessionID = substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    if (DB_isUniqueSessionID($sessionID)) {
        return $sessionID;
    } else {
        getSessionIDHash($len);
    }
}



function SESSION_createSession($userID, $username, $password, $userType)
{
    DB_removeSession($username);
    $sessionID = getSessionIDHash(20);
    DB_addSession($sessionID, $userID, $username, $password, $userType);
    // setcookie('session', $sessionID, time() + 3600, '/');
    return $sessionID;
}

// function SESSION_getUsername()
// {
//     $_SESSION['userInfo']['username'];
// }


// function SESSION_removeUserSession($username)
// {
//     DB_removeSession($username);
// }
