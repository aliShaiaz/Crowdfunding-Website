<?php

// function ENCRYPT_getSessionID($len = 32)
// {
//     $sessionID = substr(md5(openssl_random_pseudo_bytes(20)), -$len);
//     if (DB_isUniqueSessionID($sessionID)) {
//         return $sessionID;
//     } else {
//         ENCRYPT_getSessionID($len);
//     }
// }