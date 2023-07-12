<?php

function ADMIN_getUsersList()
{
    // $users = DB_getAllUsers();
    // $json = json_encode($users);
    // echo $json;

    // DB_getAllUsers() will return a 2D array of Users
    echo json_encode(DB_getAllUsers());
}
