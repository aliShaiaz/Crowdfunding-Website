<?php

// .. ..  Login System Control PHP LIST .. .. //

// . . This portion is to be checked and optimized . . //
// require_once("Controller/LoginSystem/loginCheck.php");
// require_once("Controller/LoginSystem/logout.php");
// require_once("Controller/LoginSystem/session.php");
// require_once("Model/Database/DB.php");
// require_once("Model/Encrypt.php");
// . . . //

require_once('Controller/LoginSystem/loginCheck.php');
require_once('Controller/LoginSystem/logout.php');
require_once('Controller/LoginSystem/session.php');
require_once('Controller/LoginSystem/registrationCheck.php');

// . . . //


// .. ..  Admin Control PHP LIST .. .. //

require_once('Controller/Admin/listUsers.php');
require_once('Controller/Admin/ADMIN_profileSettings.php');

// . . . //



// .. ..  Control PHP LIST .. .. //

require_once('Controller/userActions.php');

// . . . //
