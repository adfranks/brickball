<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Brickball</title>
  <meta name="keywords" content="brick ball change email page" />
  <meta name="description" content="breakout game for web browser change email page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
</head>

<body>

  <div id="container">
    <header><h1>brick ball</h1></header>
    <?php
    $servername = "localhost";
    $username = "adpfrank_7ba6_cg";
    $password = "gosun";
    $dbname = "adpfrank_db1";
    $cookiename = "brickuser";
    $cookiepass = "brickpass";

    if ($_SESSION['pword'] == md5($_POST['currentpwd'])) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to update email in db.
            $sql = $conn->prepare("UPDATE members SET email=
                   '" . $_POST['newemail'] . "' WHERE username='" . $_SESSION['uname'] . "'
                   AND password='" . $_SESSION['pword'] . "'");
            $sql->execute();

            // see if they automatically stay logged in via cookies and update the cookie username
            if (isset($_COOKIE[$cookiename]) && isset($_COOKIE[$cookiepass])) {
                $_COOKIE[$cookiepass] = $_SESSION['pword'];
                setcookie($cookiepass, $cookieusr, time() + (86400 * 365), "/");
            }

            echo '<p class="form-response">Email successfully updated!<br /><br />
            <button type="button" onclick="window.location.href=\'brickball.php\'">Play a Game</button>';
        } catch (PDOException $e) {
            echo '<span class="errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . 
            '</span><br /><a href="brickball.php">Go back to the game</a>.';
        }

        $conn = null;
    } else {
        echo '<span class="errormsg">The password entered was incorrect.  Please, try again.</span>
        <form class="tryagain" action="changeemail.php" method="post" autocomplete="on">
        <fieldset>
        <legend>Change Email</legend>
        <label><b>Password:</b></label>
        <input type="text" placeholder="Enter Password" name="currentpwd" maxlength="30" required>
        <label><b>New Email:</b></label>
        <input type="text" placeholder="Enter New Email Address" name="newemail" maxlength="30" required>
        <div class="clearfix">
        <button type="button" onclick="window.location.href=\'brickball.php\'"
        class="cancelbtn">Cancel</button>
        <button type="submit">Submit</button>
        </div>
        </fieldset>
        </form>';
    }

    ?>
  </div>

</body>

</html>
