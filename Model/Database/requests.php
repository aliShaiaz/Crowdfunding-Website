<?php


function REQ_getRequestInfo($requestID)
{
    $request = MySQL_runSQL("SELECT * FROM requests WHERE requestID = '$requestID';");

    if (count($request) != 0) {
        return $request[0];
    } else {
        return false;
    }
}

function REQ_getAllRequests()
{
    $requests = MySQL_runSQL('SELECT * FROM requests;');
    return $requests;
}

function REQ_approve($postID)
{
    $sql = "UPDATE requests SET approveStatus='1' WHERE postID = '$postID';";

    return MySQL_runSQL($sql);
}
function REQ_refuse($postID)
{
    $sql = "UPDATE requests SET approveStatus='0' WHERE postID = '$postID';";

    return MySQL_runSQL($sql);
}
