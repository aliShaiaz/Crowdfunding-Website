<?php

// class login
// {
//     // private function notNull($username, $password)
//     // {
//     //     if ($username == "" || $password == "") {
//     //         return false;
//     //     } else {
//     //         return true;
//     //     }
//     // }

//     private function userCheck($username, $password)
//     {

//         // if ($this->notNull($username, $password)) {

//     }

//     public function loginUser($username, $password)                 // Will Return SessionID
//     {
//     }
// }

function login($username, $password)
{
    if ($username != "" && $password != "") {
        // require_once("Controller/LoginSystem/controlLS.php");
        // $username = strtolower($username);
        $user = DB_getUserInfo($username);
        // $userType = $this->userCheck($username, $password);

        if ($user != false && $user['activeStatus'] != 0) {
            if ($user['password'] == $password) {
                return SESSION_createSession($user['userID'], $username, $password, $user['userType']);
                // setcookie('session', $sessionID, time() + 3600, '/');

            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}
