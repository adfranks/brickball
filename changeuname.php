<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball change username page">
  <meta name="description" 
  content="breakout game for web browser log in page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
</head>

<body>

<div id="container">
<header>
  <h1><a class="heading" href="brickball.php">brick ball</a></h1>
</header>
<?php
$servername = "localhost";
$username = "adpfrank_7ba6_cg";
$password = "gosun";
$dbname = "adpfrank_db1";
$cookiename = "brickuser";
$cookiepass = "brickpass";

if ($_SESSION['uname'] == $_POST['currentuser']) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* sql to get user from db.  use password to ensure another 
        username is not changed. */
        $sql = $conn->prepare("UPDATE members SET username='" . 
        $_POST['newuser'] . "' WHERE username='" . $_SESSION['uname'] . 
        "' AND password='" . $_SESSION['pword'] . "'");
               
        $sql->execute();

        // update the session variable with new username
        $_SESSION['uname'] = $_POST['newuser'];

        /* see if they automatically stay logged in via cookies and 
        update the cookie username */
        if (isset($_COOKIE[$cookiename]) && isset($_COOKIE[$cookiepass])) {
            $_COOKIE[$cookiename] = $_SESSION['uname'];
            setcookie($cookiename, $cookieusr, time() + (86400 * 365), "/");
        }

        echo '<p class="form-response">Username successfully changed!' .
        '<br /><br /><button type="button" onclick=' .
        '"window.location.href=\'brickball.php\'">Play a Game</button></p>';
    } catch (PDOException $e) {
        switch($e->getCode()) {
            case 23000:
                echo '<div class="form-response"><span class=' .
                '"errormsg">Sorry, that username already exists. ' .
                ' Please, choose another one and try again.</span>' .
                '<form class="tryagain" action=' .
                '"changeuname.php" method="post" autocomplete="on">' .
                '<fieldset><legend>Change Username</legend>' .
                '<label><b>Current Username:</b></label>' .
                '<input type="text" placeholder=' .
                '"Enter Current Username" name="currentuser" maxlength=' .
                '"30" required><label><b>New Username:</b></label>' .
                '<input type="text" placeholder="Enter New Username"' .
                ' name="newuser" maxlength="30" required>' .
                '<div class="clearfix"><button type="button" onclick=' .
                '"window.location.href=\'brickball.php\'" class=' .
                '"cancelbtn">Cancel</button><button type="submit">' .
                'Submit</button></div></fieldset></form></div>';

                break;
            default:
                echo '<p class="form-response"><span class="errormsg">' .
                'Oopsy Daisy!  Error: ' . $e->getMessage() .
                '</span><br /><a class="error-link" href=' .
                '"brickball.php">Go back</a>.</p>';
        }
    }

    $conn = null;
} else {
    echo '<div class="form-response"><span class="errormsg">' .
    'The current username entered is incorrect.  Please, try again.' .
    '</span><form class="tryagain" action="changeuname.php" method=' .
    '"post" autocomplete="on"><fieldset><legend>Change Username</legend>' .
    '<label><b>Current Username:</b></label><input type=' .
    '"text" placeholder="Enter Current Username" name=' .
    '"currentuser" maxlength="30" required><label><b>New Username:</b>' .
    '</label><input type="text" placeholder="Enter New Username" name=' .
    '"newuser" maxlength="30" required><div class="clearfix">' .
    '<button type="button" onclick="window.location.href=' .
    '\'brickball.php\'" class="cancelbtn">Cancel</button><button type=' .
    '"submit">Submit</button></div></fieldset></form></div>';
}
?>
</div>

</body>

</html>
