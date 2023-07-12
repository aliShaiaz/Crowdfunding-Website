<?php
require_once("../Model/Functions.php");

if (isSignedIn()) {
    if (isset($_GET['logout'])) {
        header("location: LoginSystem/logout.php");
    } elseif (isset($_GET['home'])) {
        header("location: HomepageRedirect.php");
    } else {
        displayError("You are already Signed In!");
    }
} elseif (!isSignedIn()) {
    if (isset($_GET['register'])) {
        header("location: loginsystem/Register/register.php");
    } elseif (isset($_GET['login'])) {
        header("location: loginsystem/login/login.php");
    } else {
        displayError("You are not Signed In!");
    }
}
