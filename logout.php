<?php
session_start();

// unset all the session variables and delete cookies
if (isset($_SESSION['uname'])) {
    $_SESSION = array();
    session_destroy();

    $cookiename = "brickuser";
    $cookiepass = "brickpass";
    setcookie($cookiename, "", time() - 3600, "/");
    setcookie($cookiepass, "", time() - 3600, "/");
}

header("location: brickball.php");
exit;
?>
