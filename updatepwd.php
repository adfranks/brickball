<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball update password page">
  <meta name="description" 
  content="breakout game for web browser update password page">
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
$token = $_GET['token'];
$email = $_GET['email'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to select the users expiration
    $sql = $conn->prepare("SELECT expiration FROM members WHERE token='" . 
    $token . "' AND email='" . $email . "'");
    
    $sql->execute();
    $column = $sql->fetch(PDO::FETCH_ASSOC);

    // check to see if token expired, if not show the form 
    if (time() < $column['expiration']) { 
    echo '<div class="form-response"><h2>Reset Password</h2>' .
    '<form class="tryagain" action="resetpwd.php" method="post">' .
    '<fieldset><input type="hidden" name="email" value="' . 
    $email . '" required><label><b>New Password:</b></label>' .
    '<input type="password" placeholder="Enter New Password" name=' .
    '"newpsw" maxlength="20" required>' .
    '<label><b>Confirm New Password:</b></label><input type=' .
    '"password" placeholder="Enter New Password" name=' .
    '"newpsw-confirm" maxlength="20" required><div class="clearfix">' .
    '<button type="submit">Submit</button></div></fieldset></form></div>';
    } else {echo '<div class="form-response">The time alloted to reset' .
    ' your password has passed.' .
    ' Please, try again.<br /><br /><h2>Forgot Password</h2><form class="tryagain" action="maillink.php" method="post" autocomplete="on"><fieldset><label><b>Email:</b></label><input type="email" placeholder="Enter Email Address" name="email" maxlength="255" required><div class="clearfix"><button type="submit">Next</button></div></fieldset></form></div>';}
} catch (PDOException $e) {
    echo '<p class="form-response"><span class="errormsg">' .
    'Oopsy Daisy!  Error: ' . $e->getMessage() . 
    '</span><br /><a class="error-link" href=' .
    '"brickball.php">Please, try again</a>.</p>';
}

$conn = null;
?>
</div>

</body>

</html>
