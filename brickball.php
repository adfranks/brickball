<?php 
session_start(); 

// Check if they wanted to stay logged in via cookies
if (!isset($_SESSION['uname'])) {
    $cookiename = "brickuser";
    $cookiepass = "brickpass";

    if (isset($_COOKIE[$cookiename]) && isset($_COOKIE[$cookiepass])) {
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>Brick Ball</title>
  <meta name="keywords" 
  content="breakout, vintage, retro, online video game, web application">
  <meta name="description" 
  content="A fun version of the vintage Breakout video game.>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="pragma" content="no-cache">
  <link rel="icon" href="images/brickball-icon.png">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onload="brickBall.init(); mobile();">

<div id="container">
  <header>
    <h1>brick ball</h1> 
    <?php 
    if (!isset($_SESSION['uname'])) {
        echo '<button onclick=' .
        '"document.getElementById(\'sign\').style.display=\'block\'">' .
        'Sign Up</button><button onclick=' .
        '"document.getElementById(\'login\').style.display=\'block\'">' .
        'Log In</button>';
    } else {
        echo '<button onclick="location.href=\'logout.php\'">' .
        'Log Out</button>';
    }
    ?>
  </header>

  <!-- Primary content of the page:  game, directions, and top ten list. -->
  <main>
    <canvas id="breakoutCanvas">
      <p>Your browser does not support this feature.  Try upgrading your 
      browser.</p>
    </canvas>

    <div id="greeting"> 
      <p id="greet">
        <?php 
        if (!isset($_SESSION['uname'])) {
            echo 'Hello, creature! Brick Ball is a version of the' .
            ' classic Breakout game. <button onclick=' .
            '"document.getElementById(\'sign\').style.display=' .
            '\'block\'">Sign up</button> or <button onclick=' .
            '"document.getElementById(\'login\').style.display=' .
            '\'block\'">log in</button> to keep track of your best ' .
            'games.  See if you have what it takes to join the top ten' .
            ' list.  Good luck! <span id="new-game">Press <button id=' .
            '"new-button" onclick="brickBall.restart()">start</button>' .
            ' for a new game.</span>';
        } else {
            echo '<em>Welcome, ' . $_SESSION["uname"] . '!</em> | '; 

            if (isset($_SESSION['champs'])) {
                echo 'Championships: ' . $_SESSION["champs"] . 
                '!!! | <span id="new-game"> Press <button id=' .
                '"new-button" onclick="brickBall.restart()">' .
                'start</button> for a new game.</span>';
            } else if (isset($_SESSION['hscore'])) {
                echo '<span id="high-score">High Score: ' . 
                $_SESSION["hscore"] . '</span> | <span id="new-game">' .
                ' Press <button id="new-button" onclick=' .
                '"brickBall.restart()">start</button> for a new game.' .
                '</span>';
            }
        }
        ?>
      </p>
    </div>

    <div id="col-1">
      <div id="directions">
        <h2>How to Play</h2>
        <p id="objective">
          <span>Clear all the bricks by bouncing the ball into them.</span>
        </p>
        <ul>
          <li>Press the "s" key to serve the ball.</li>
          <li>Left and right arrows move the paddle.</li>  
          <li>Use the paddle to hit the ball into the bricks.</li> 
          <li>If you miss the ball, you lose the ball.</li>
          <li>You get 5 balls to clear all the bricks.</li>
          <li>If you succeed, it's on to the second and final level!</li>
          <li>To keep you on your toes, the ball speeds up after 
          encountering a new color.</li>
          <li>Be aware that bouncing the ball off the top of the screen 
          shrinks the paddle.</li>
          <li>Have fun!</li>
        </ul>
      </div>
    </div>

    <div id="col-2"> 
      <div id="topten">
        <h2>The Top Ten</h2>
        <p id="top">
          <?php include 'topten.php'; ?>
        </p>
      </div>
    </div>

    <div class="clearfix"></div>

  </main>

  <!-- Membership features that open in a modal. Sign Up Modal -->
  <div id="sign" class="modal">
    <span onclick="document.getElementById('sign').style.display='none'" 
    class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="member.php" method="post">
      <fieldset>
        <legend>Sign Up</legend>
          <label><b>Email:</b></label>
          <input type="email" placeholder="Enter Email Address" name="email"
          maxlength="255" required>
          <label><b>Username:</b></label>
          <input type="text" placeholder="Enter Username" name="user" 
          maxlength="20" required>
          <label><b>Password:</b></label>
          <input type="password" placeholder="Enter Password" name="psw" 
          maxlength="20" required>
          <label><b>Confirm Password:</b></label>
          <input type="password" placeholder="Enter Password" 
          name="psw-confirm" maxlength="20" required>
          <div class="clearfix">
            <button type="button" 
            onclick="document.getElementById('sign').style.display='none'"
            class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
          </div>
      </fieldset>
    </form>
  </div>

  <!-- Log In Modal -->
  <div id="login" class="modal">
    <span onclick="document.getElementById('login').style.display='none'" 
    class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="login.php" method="post" 
    autocomplete="on">
      <fieldset>
        <legend>Log In</legend>
          <label><b>Username:</b></label>
          <input type="text" placeholder="Enter Username or Email Address" 
          name="user" maxlength="30" required>
          <label><b>Password:</b></label>
          <input type="password" placeholder="Enter Password" name="psw" 
          maxlength="30" required>
          <div class="clearfix">
            <button type="button" 
            onclick="document.getElementById('login').style.display='none'"
            class="cancelbtn">Cancel</button>
            <button type="submit">Submit</button>
            <span class="forgot"><a href="forgotpwd.html">
            Forgot password?</a></span>
          </div>
      </fieldset>
    </form>
  </div>

  <!-- Change Username Modal -->
  <div id="usname" class="modal">
    <span onclick="document.getElementById('usname').style.display='none'" 
    class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="changeuname.php" method="post" 
    autocomplete="on">
      <fieldset>
        <legend>Change Username</legend>
          <label><b>Current Username:</b></label>
          <input type="text" placeholder="Enter Current Username" 
          name="currentuser" maxlength="30" required>
          <label><b>New Username:</b></label>
          <input type="text" placeholder="Enter New Username" name="newuser"
          maxlength="30" required>
          <div class="clearfix">
            <button type="button" 
            onclick="document.getElementById('usname').style.display='none'"
            class="cancelbtn">Cancel</button>
            <button type="submit">Submit</button>
          </div>
      </fieldset>
    </form>
  </div>

  <!-- Change Password Modal -->
  <div id="newpword" class="modal">
    <span onclick="document.getElementById('newpword').style.display='none'"
    class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="changepword.php" method="post" 
    autocomplete="on">
      <fieldset>
        <legend>Change Password</legend>
        <label><b>Old Password:</b></label>
        <input type="password" placeholder="Enter Old Password" 
        name="currentpsw" maxlength="30" required>
        <label><b>New Password:</b></label>
        <input type="password" placeholder="Enter New Password" 
        name="newpsw" maxlength="30" required>
        <div class="clearfix">
          <button type="button" 
          onclick="document.getElementById('newpword').style.display='none'"
          class="cancelbtn">Cancel</button>
          <button type="submit">Submit</button>
        </div>
      </fieldset>
    </form>
  </div>

  <!-- Update Email Modal -->
  <div id="newemail" class="modal">
    <span onclick="document.getElementById('newemail').style.display='none'"
    class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="changeemail.php" method="post" 
    autocomplete="on">
      <fieldset>
        <legend>Update Email</legend>
        <label><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" 
        name="currentpwd" maxlength="255" required>
        <label><b>New Email:</b></label>
        <input type="email" placeholder="Enter New Email Address" 
        name="newemail" maxlength="255" required>
        <div class="clearfix">
          <button type="button" 
          onclick="document.getElementById('newemail').style.display='none'"
          class="cancelbtn">Cancel</button>
          <button type="submit">Submit</button>
        </div>
      </fieldset>
    </form>
  </div>

  <!-- Cancel Membership Modal -->
  <div id="delmember" class="modal">
    <span onclick=
    "document.getElementById('delmember').style.display='none'" 
    class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="deletemember.php" method="post" 
    autocomplete="on">
      <fieldset>
        <legend>Cancel Membership</legend>
        <label><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="psw" 
        maxlength="30" required>
        <div class="clearfix">
          <button type="button" onclick=
          "document.getElementById('delmember').style.display='none'"
          class="cancelbtn">Back</button>
          <button type="submit">Submit</button>
        </div>
      </fieldset>
    </form>
  </div>

  <footer>
    <h1>brick ball</h1>
    <?php 
    if (isset($_SESSION['uname'])) {
        echo '<button onclick=' .
        '"document.getElementById(\'usname\').style.display=' .
        '\'block\'">Change Username</button><button onclick=' .
        '"document.getElementById(\'newpword\').style.display=' .
        '\'block\'">Change Password</button><button onclick=' . 
        '"document.getElementById(\'newemail\').style.display=' .
        '\'block\'">Update Email</button><button onclick=' . 
        '"document.getElementById(\'delmember\').style.display=' .
        '\'block\'">Cancel Membership</button>'; 
    } else {
        echo '<button onclick=' .
        '"document.getElementById(\'sign\').style.display=' .
        '\'block\'">Sign Up</button><button onclick=' .
        '"document.getElementById(\'login\').style.display=' .
        '\'block\'">Log In</button>';
    }
    ?>
  </footer>
</div>

<script src="js/mobile.js"></script>
<script src="js/sound.js"></script>
<script src="js/game-obj.js"></script>
<script src="js/brickball.js"></script>
<script src="js/membership.js"></script>

</body>

</html>
