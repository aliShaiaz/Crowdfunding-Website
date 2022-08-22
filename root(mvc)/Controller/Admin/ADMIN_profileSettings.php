<?php

function ADMIN_getProfileInfo()
{
    echo json_encode(DB_getUserInfo($_SESSION['userInfo']['username']));
    // echo json_encode($_SESSION['userInfo']);
}
