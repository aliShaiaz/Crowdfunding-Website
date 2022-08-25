<?php


function F_createAccount($owner)
{
    $sql = "INSERT INTO accounts (balance, owner) VALUES (0, '$owner');";

    return mysqli_insert_id(MySQL_runSQL($sql));
}

function F_getAccountBalance($accountID)
{
    $account = MySQL_runSQL("SELECT * FROM accounts WHERE accountID = '$accountID';");

    if (count($account) != 0) {
        return $account[0]['balance'];
    } else {
        return false;
    }
}

function F_getAccountInfo($accountID)
{
    $account = MySQL_runSQL("SELECT * FROM accounts WHERE accountID = '$accountID';");
    if (count($account) != 0) {
        return $account;
    } else {
        return false;
    }
}

function F_addBalance($accountID, $amount)
{
    $newBalance = F_getAccountBalance($accountID) + $amount;
    $sql = "UPDATE accounts SET balance='$newBalance' WHERE accountID = '$accountID';";
    return MySQL_runSQL($sql);
}
function F_withdrawBalance($accountID, $amount)
{
    $newBalance = F_getAccountBalance($accountID) - $amount;
    $sql = "UPDATE accounts SET balance='$newBalance' WHERE accountID = '$accountID';";
    return MySQL_runSQL($sql);
}

function F_transfer($sender, $receiver, $amount)
{
    F_withdrawBalance($sender, $amount);
    F_addBalance($receiver, $amount);
    return TRANX_newTransaction($sender, $receiver, $amount);
}
