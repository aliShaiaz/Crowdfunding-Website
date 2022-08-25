<?php

function USER_addAccount($username, $accountID)
{
    $sql = "UPDATE users SET accountID='$accountID' WHERE username = '$username';";

    return MySQL_runSQL($sql);
}

function USER_getAccountID($username)
{
    $sql = "SELECT accountID FROM `users` WHERE username = '$username';";

    return MySQL_runSQL($sql)[0]['accountID'];
}



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

function USER_updateActiveStatus($username, $activeStatus)
{
    $sql = "UPDATE users SET activeStatus='$activeStatus' WHERE username = '$username';";

    return MySQL_runSQL($sql);
}

function USER_getUserCount()
{
    return count(MySQL_runSQL("select * from users"));
}
