<?php
function LS_checkRegistrationBK()
{
    $username = strtolower(trim($_POST['username']));
    if (DB_usernameIsAvailable($username)) {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password == $confirmPassword) {

            if ($_POST['userType'] == 'indiv' || $_POST['userType'] == 'inv') {

                // Data Retrieval From $_POST //
                // $userID= 
                $userType = $_POST['userType'];
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $nid = $_POST['nid'];
                $phone = $_POST['phone'];
                // .. //

                // ... Generating ID ... //
                $currentUserCount = DB_getUserCount();
                if ($userType == 'indiv') {
                    $userID = 'IND-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                } elseif ($userType == 'inv') {
                    $userID = 'INV-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                }
                // ... //

                // ... Insertion of user data to DB ... //
                DB_addProfilePhoto($username);
                return DB_createUser_person($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone);    // This method() will return true/false
                // ... //


            } elseif ($_POST['userType'] == 'org') {
                $userType = $_POST['userType'];
                $orgName = $_POST['orgName'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tradeLicense = $_POST['tradeLicense'];

                // ... Generating ID ... //
                $currentUserCount = DB_getUserCount();
                $userID = 'ORG-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                // ... //

                // ... Insertion of user data to DB ... //
                DB_addProfilePhoto($username);
                return DB_createUser_org($userID, $username, $password, $userType, $orgName, $phone, $email, $address, $tradeLicense);    // This method() will return true/false
                // ... //



            } elseif ($_POST['userType'] == 'official') {

                // Data Retrieval From $_POST //
                // $userID= 
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $nid = $_POST['nid'];
                $phone = $_POST['phone'];
                $empID = $_POST['employeeID'];
                $empRole = $_POST['role'];
                // .. //

                // ... Generating ID ... //
                $currentUserCount = DB_getUserCount();
                if ($_POST['role'] == 'admin') {
                    $userID = 'ADM-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                    $userType = 'admin';
                } elseif ($_POST['role'] == 'editor') {
                    $userID = 'EDT-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                    $userType = 'editor';
                }
                // ... //

                // ... Insertion of user data to DB ... //
                DB_addProfilePhoto($username);
                return DB_createUser_official($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone, $empID, $empRole);    // This method() will return true/false
                // ... //
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function userValidation($type)            // ... Server-End User Info Validation
{
    if ($type == "personal") {
        // Username Check
        if ($_POST['username'] == "") {
            return false;
        }
        // * //


        // Firstname Check
        if ($_POST['firstName'] == "") {
            return false;
        }
        // * //


        // Lastname Check
        if ($_POST['lastName'] == "") {
            return false;
        };
        // * //


        // Password Check
        if ($_POST['password'] == "" || $_POST['confirmPassword'] == "" || $_POST['password'] != $_POST['confirmPassword']) {
            return false;
        }
        // * //


        // Date of Birt Check (whether 18+ or not)
        $date = strtotime($_POST['dob']);             // The age to be over, over +18
        $min = strtotime('+18 years', $date);         // Time ($date) + 18 years
        if ($_POST['dob'] == "") {
            return false;
        } else if (time() < $min) {
            return false;
        }
        // * //


        // Gender Check
        if ($_POST['gender'] == "") {
            return false;
        };
        // * // 


        // Address Check
        if ($_POST['address'] == "") {
            return false;
        };
        // * //


        // NID Check
        if ($_POST['nid'] == "") {
            return false;
        };
        // * //
        return true;
    } elseif ($type == "organization") {
    }
}

function REG_passwordValidation($password, $cPassword)
{
    if ($password == '') {
        return false;
    } elseif ($password != $cPassword) {
        return false;
    } elseif (strlen($password) < 8) {
        return false;
    } elseif (strlen($password) > 15) {
        return false;
    } else {
        return true;
    }

    // $exp = "/^[a-zA-Z.]{2,5}$/";
}

function REG_nameValidation($name)
{
    if (strlen($name) < 3 || strlen($name) > 10) {
        return false;
    } else {
        return ucfirst(strtolower($name));
    }
}
function REG_usernameValidation($username)
{
    if (!DB_usernameIsAvailable($username)) {
        return 'un not available';
    } elseif (strlen($username) < 3) {
        return 'un is short';
        // return false;
    } else {
        // return strtotime($username);
        return true;
    }
}

function LS_checkRegistration()
{
    $username = strtolower($_POST['username']);
    // return (REG_usernameValidation($username));
    // return $username;
    if (REG_usernameValidation($username)) {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if (REG_passwordValidation($password, $confirmPassword)) {
            if ($_POST['userType'] == 'indiv' || $_POST['userType'] == 'inv') {

                // Data Retrieval From $_POST //
                $userType = $_POST['userType'];
                $firstName = REG_nameValidation($_POST['firstName']);
                $lastName = REG_nameValidation($_POST['lastName']);
                if ($firstName && $lastName) {

                    $email = $_POST['email'];
                    $dob = $_POST['dob'];
                    $gender = $_POST['gender'];
                    $address = $_POST['address'];
                    $nid = $_POST['nid'];
                    $phone = $_POST['phone'];
                    // .. //

                    // ... Generating ID ... //
                    $currentUserCount = DB_getUserCount();
                    if ($userType == 'indiv') {
                        $userID = 'IND-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                    } elseif ($userType == 'inv') {
                        $userID = 'INV-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                    }
                    // ... //

                    // ... Insertion of user data to DB ... //
                    DB_addProfilePhoto($username);
                    return DB_createUser_person($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone);    // This method() will return true/false
                    // ... //
                }
            } elseif ($_POST['userType'] == 'org') {
                $userType = $_POST['userType'];
                $orgName = $_POST['orgName'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tradeLicense = $_POST['tradeLicense'];

                // ... Generating ID ... //
                $currentUserCount = DB_getUserCount();
                $userID = 'ORG-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                // ... //

                // ... Insertion of user data to DB ... //
                DB_addProfilePhoto($username);
                return DB_createUser_org($userID, $username, $password, $userType, $orgName, $phone, $email, $address, $tradeLicense);    // This method() will return true/false
                // ... //



            } elseif ($_POST['userType'] == 'official') {

                // Data Retrieval From $_POST //
                // $userID= 
                $firstName = REG_nameValidation($_POST['firstName']);
                $lastName = REG_nameValidation($_POST['lastName']);
                if ($firstName && $lastName) {

                    $email = $_POST['email'];
                    $dob = $_POST['dob'];
                    $gender = $_POST['gender'];
                    $address = $_POST['address'];
                    $nid = $_POST['nid'];
                    $phone = $_POST['phone'];
                    $empID = $_POST['employeeID'];
                    $empRole = $_POST['role'];
                    // .. //

                    // ... Generating ID ... //
                    $currentUserCount = DB_getUserCount();
                    if ($_POST['role'] == 'admin') {
                        $userID = 'ADM-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                        $userType = 'admin';
                    } elseif ($_POST['role'] == 'editor') {
                        $userID = 'EDT-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
                        $userType = 'editor';
                    }
                    // ... //

                    // ... Insertion of user data to DB ... //
                    DB_addProfilePhoto($username);
                    return DB_createUser_official($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone, $empID, $empRole);    // This method() will return true/false
                    // ... //
                }
            }
            return $password;
        } else {
            return 'false';
        }
    } else {
        return 'failed at nameVal';
    }


    // if ($_POST['userType'] == 'indiv' || $_POST['userType'] == 'inv') {

    //     // Data Retrieval From $_POST //
    //     // $userID= 
    //     $userType = $_POST['userType'];
    //     $firstName = $_POST['firstName'];
    //     $lastName = $_POST['lastName'];
    //     $email = $_POST['email'];
    //     $dob = $_POST['dob'];
    //     $gender = $_POST['gender'];
    //     $address = $_POST['address'];
    //     $nid = $_POST['nid'];
    //     $phone = $_POST['phone'];
    //     // .. //

    //     // ... Generating ID ... //
    //     $currentUserCount = DB_getUserCount();
    //     if ($userType == 'indiv') {
    //         $userID = 'IND-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
    //     } elseif ($userType == 'inv') {
    //         $userID = 'INV-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
    //     }
    //     // ... //

    //     // ... Insertion of user data to DB ... //
    //     DB_addProfilePhoto($username);
    //     return DB_createUser_person($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone);    // This method() will return true/false
    //     // ... //


    // } elseif ($_POST['userType'] == 'org') {
    //     $userType = $_POST['userType'];
    //     $orgName = $_POST['orgName'];
    //     $phone = $_POST['phone'];
    //     $email = $_POST['email'];
    //     $address = $_POST['address'];
    //     $tradeLicense = $_POST['tradeLicense'];

    //     // ... Generating ID ... //
    //     $currentUserCount = DB_getUserCount();
    //     $userID = 'ORG-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
    //     // ... //

    //     // ... Insertion of user data to DB ... //
    //     DB_addProfilePhoto($username);
    //     return DB_createUser_org($userID, $username, $password, $userType, $orgName, $phone, $email, $address, $tradeLicense);    // This method() will return true/false
    //     // ... //



    // } elseif ($_POST['userType'] == 'official') {

    //     // Data Retrieval From $_POST //
    //     // $userID= 
    //     $firstName = $_POST['firstName'];
    //     $lastName = $_POST['lastName'];
    //     $email = $_POST['email'];
    //     $dob = $_POST['dob'];
    //     $gender = $_POST['gender'];
    //     $address = $_POST['address'];
    //     $nid = $_POST['nid'];
    //     $phone = $_POST['phone'];
    //     $empID = $_POST['employeeID'];
    //     $empRole = $_POST['role'];
    //     // .. //

    //     // ... Generating ID ... //
    //     $currentUserCount = DB_getUserCount();
    //     if ($_POST['role'] == 'admin') {
    //         $userID = 'ADM-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
    //         $userType = 'admin';
    //     } elseif ($_POST['role'] == 'editor') {
    //         $userID = 'EDT-' . str_pad($currentUserCount + 1, 5, '0', STR_PAD_LEFT);
    //         $userType = 'editor';
    //     }
    //     // ... //

    //     // ... Insertion of user data to DB ... //
    //     DB_addProfilePhoto($username);
    //     return DB_createUser_official($userID, $username, $password, $userType, $firstName, $lastName, $email, $dob, $gender, $address, $nid, $phone, $empID, $empRole);    // This method() will return true/false
    //     // ... //
    // }
}
