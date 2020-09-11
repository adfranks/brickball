<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball log in page">
  <meta name="description" 
  content="breakout game for web browser log in page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/brickball-icon.png">
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

if (!isset($_SESSION['uname']) && !isset($_COOKIE[$cookiepass])) {
    $_SESSION['pword'] = md5($_POST['psw']);
}

// See if they want to automatically stay logged in via cookies.
if (isset($_COOKIE[$cookiename]) && isset($_COOKIE[$cookiepass])) {
    $_POST['user'] = $_COOKIE[$cookiename];
    $_SESSION['pword'] = $_COOKIE[$cookiepass];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

    // Set the PDO error mode to exception.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL to get user from db.
    $sql = $conn->prepare("SELECT username, highscore, championships" .
    " FROM members WHERE (username='" . $_POST['user'] . "' OR email='" . 
    $_POST['user'] . "') AND password='" . 
    $_SESSION['pword'] . "'");

    $sql->setFetchMode(PDO::FETCH_OBJ);
    $sql->execute();
    $row = $sql->fetch();

    // Check if anything was found in db.
    if ($row == null) {
        echo '<div class="form-response"><span class="errormsg">' .
        'Invalid username or password.  Please try again.</span>' .
        '<form class="tryagain" action="login.php" method=' .
        '"post" autocomplete="on"><fieldset><legend>Log In</legend>' .
        '<label><b>Username:</b></label><input type=' .
        '"text" placeholder="Enter Username or Email Address" name=' .
        '"user" maxlength="30" required><label><b>Password:</b></label>' .
        '<input type="password" placeholder="Enter Password" name=' .
        '"psw" maxlength="30" required><button class="cancelbtn" type=' .
        '"button" onclick="window.location.href=\'brickball.php\'">' .
        'Cancel</button><button type="submit">Submit</button>' .
        '<span class="forgot"><a href="forgotpwd.html">Forgot password?</a></span>' .
        '</fieldset></form></div>';
    } else {
        $_SESSION['uname'] = $row->username;
        
        if ($row->championships != 0) {
            $_SESSION['champs'] = $row->championships;
        } else {
            $_SESSION['hscore'] = $row->highscore;
        }

        echo '<p class="form-response">Success!  You are logged in!' .
        '<br /><br /><button type="button" onclick=' .
        '"window.location.href=\'brickball.php\'">Enter</button></p>';
    }
     
}
catch (PDOException $e) {
    session_unset();
    session_destroy();
    echo '<p class="form-response"><span class="errormsg">' .
    'Oopsy Daisy!  Error: ' . $e->getMessage() . 
    '</span><a class="error-link" href="brickball.php">Back</a>.</p>';
}

$conn = null;
?>
</div>

</body>

</html>
