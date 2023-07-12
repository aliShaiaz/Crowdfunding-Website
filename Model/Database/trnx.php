<?php

function TRANX_newTransaction($sender, $receiver, $amount)
{
    $sql = "INSERT INTO transactions(sender, receiver, amount) VALUES ('$sender','$receiver','$amount')";

    return mysqli_insert_id(MySQL_runSQL($sql));
}
