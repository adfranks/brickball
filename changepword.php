<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball change password page" />
  <meta name="description" content="breakout game for web browser log in page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
</head>

<body>

  <div id="container">
    <header><h1><a class="heading" href="brickball.php">brick ball</a></h1></header>
    <?php
    $servername = "localhost";
    $username = "adpfrank_7ba6_cg";
    $password = "gosun";
    $dbname = "adpfrank_db1";
    $cookiename = "brickuser";
    $cookiepass = "brickpass";

    if ($_SESSION['pword'] == md5($_POST['currentpsw'])) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to change password in db.
            $sql = $conn->prepare("UPDATE members SET password=
                   '" . md5($_POST['newpsw']) . "' WHERE username='" . $_SESSION['uname'] . "'
                   AND password='" . $_SESSION['pword'] . "'");
            $sql->execute();

            // update the session variable with new password
            $_SESSION['pword'] = md5($_POST['newpsw']);

            // see if they automatically stay logged in via cookies and update the cookie password
            if (isset($_COOKIE[$cookiename]) && isset($_COOKIE[$cookiepass])) {
                $_COOKIE[$cookiepass] = $_SESSION['pword'];
                setcookie($cookiepass, $cookieusr, time() + (86400 * 365), "/");
            }

            echo '<div class="form-response">Password successfully changed!<br /><br />
            <button type="button" onclick="window.location.href=\'brickball.php\'">Play a Game</button></div>';
        } catch (PDOException $e) {
            echo '<p class="form-response"><span class="errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . 
            '</span><br /><a class="error-link" href="brickball.php">Go back and play the game</a>.</p>';
        }

        $conn = null;
    } else {
        echo '<div class="form-response"><span class="errormsg">The current password entered is incorrect.  Please, try again.</span>
        <form class="tryagain" action="changepword.php" method="post" autocomplete="on">
        <fieldset>
        <legend>Change Password</legend>
        <label><b>Current Password:</b></label>
        <input type="text" placeholder="Enter Current Password" name="currentpsw" maxlength="30" required>
        <label><b>New Password:</b></label>
        <input type="text" placeholder="Enter New Password" name="newpsw" maxlength="30" required>
        <div class="clearfix">
        <button type="button" onclick="window.location.href=\'brickball.php\'"
        class="cancelbtn">Cancel</button>
        <button type="submit">Submit</button>
        </div>
        </fieldset>
        </form></div>';
    }

    ?>
  </div>

</body>

</html>
