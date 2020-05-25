<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball sign up page" />
  <meta name="description" content="breakout game for web browser sign up page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
</head>

<body>

  <div id="container">
    <header><h1><a class="heading" href="brickball.php">brick ball</a></h1></header>
    <?php
    $_SESSION['uname'] = $_POST['user']; 
    $_SESSION['pword'] = md5($_POST['psw']); 
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['hscore'] = 0;
    $servername = "localhost";
    $username = "adpfrank_7ba6_cg";
    $password = "gosun";
    $dbname = "adpfrank_db1";

    if ($_POST['psw'] === $_POST['psw-confirm']) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to add new user into db 
            $sql = "INSERT INTO members (username, password, email)
            VALUES ('" . $_SESSION['uname'] . "', '" . $_SESSION['pword'] . "', '" . $_SESSION['email'] . "')";
            
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "<p class='form-response'>Successful sign up!<br /><br />
            <button type='button' onclick='window.location.href=\"brickball.php\"'>Enter</button></p>";
        }
        catch(PDOException $e) {

            // ensure session username is destroyed, so it will not be displayed on home page, if error occurs
            session_unset();
            session_destroy();

            switch($e->getCode()) {
                case 23000:
                    echo '<div class="form-response"><span class="errormsg">Sorry, that username or email already exists.  Please choose another one and try again.</span>
                    <form class="tryagain" action="member.php" method="post" autocomplete="on">
                    <fieldset>
                    <legend>Sign Up</legend>
                    <label><b>Email:</b></label>
                    <input type="email" placeholder="Enter Email Address" name="email" maxlength="255" required>
                    <label><b>Username:</b></label>
                    <input type="text" placeholder="Enter Username" name="user" maxlength="30" required>
                    <label><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" maxlength="30" required>
                    <label><b>Confirm Password:</b></label>
                    <input type="password" placeholder="Confirm Password" name="psw-confirm" maxlength="20" required>
                    <button class="cancelbtn" type="button" onclick="window.location.href=\'brickball.php\'">Cancel</button>
                    <button type="submit">Submit</button>
                    </fieldset></form></div>';
                    break;
                default:
                    echo '<p class="form-response"><span class="errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . 
                    '</span><br /><a class="error-link" href="brickball.php">Go back and play the game</a>.</p>';
            }
        }

        $conn = null;
    } else {
        session_unset();
        session_destroy();
        echo '<div class="form-response"><span class="errormsg">Passwords do not match.  Please try again.</span>
        <form class="tryagain" action="member.php" method="post" autocomplete="on">
        <fieldset>
        <legend>Sign Up</legend>
        <label><b>Email:</b></label>
        <input type="email" placeholder="Enter Email Address" name="email" maxlength="255" required>
        <label><b>Username:</b></label>
        <input type="text" placeholder="Enter Username" name="user" maxlength="30" required>
        <label><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="psw" maxlength="30" required>
        <label><b>Confirm Password:</b></label>
        <input type="password" placeholder="Confirm Password" name="psw-confirm" maxlength="20" required>
        <button class="cancelbtn" type="button" onclick="window.location.href=\'brickball.php\'">Cancel</button>
        <button type="submit">Submit</button>
        </fieldset></form></div>';
    }
    ?>
  </div>

</body>

</html>
