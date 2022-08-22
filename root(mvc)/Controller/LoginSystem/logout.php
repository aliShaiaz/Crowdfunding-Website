<?php
function logout()
{
    DB_removeSession($_SESSION['userInfo']['username']);
    setcookie('session', '', time() - 100, '/');
    session_unset();
    session_destroy();

    header("location: redirect.php");
}
