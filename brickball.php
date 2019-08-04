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
  <meta charset="UTF-8" />
  <title>Brick Ball</title>
  <meta name="keywords" content="brick ball, vintage, retro, video game, breakout, arkanoid, online game, web application" />
  <meta name="description" content="A fun version of the vintage Breakout video game to be played in a web browser.  Use your keyboard to move the paddle and knock the ball into the bricks!" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="pragma" content="no-cache">
  <link rel="icon" href="images/brickball-icon.png">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onload="initialize()">

  <div id="container">
    <header>
      <h1>brick ball</h1> 
      <?php 
      if (!isset($_SESSION['uname'])) {
          echo '<button onclick="document.getElementById(\'sign\').style.display=\'block\'">Sign Up</button>
          <button onclick="document.getElementById(\'login\').style.display=\'block\'">Log In</button>'; 
      } else {
          echo '<button onclick="location.href=\'logout.php\'">Log Out</button>';
      }
      ?>
    </header>

    <!-- Sign Up Modal -->
    <div id="sign" class="modal">
      <span onclick="document.getElementById('sign').style.display='none'" class="close"
      title="Close Modal">&times;</span>
      <form class="modal-content" action="member.php" method="post">
        <fieldset>
          <legend>Sign Up</legend>
            <label><b>Email:</b></label>
            <input type="email" placeholder="Enter Email Address" name="email" maxlength="255" required>
            <label><b>Username:</b></label>
            <input type="text" placeholder="Enter Username" name="user" maxlength="20" required>
            <label><b>Password:</b></label>
            <input type="password" placeholder="Enter Password" name="psw" maxlength="20" required>
            <label><b>Confirm Password:</b></label>
            <input type="password" placeholder="Enter Password" name="psw-confirm" maxlength="20" required>
            <div class="clearfix">
              <button type="button" onclick="document.getElementById('sign').style.display='none'"
              class="cancelbtn">Cancel</button>
              <button type="submit" class="signupbtn">Sign Up</button>
            </div>
        </fieldset>
      </form>
    </div>

    <!-- Log In Modal -->
    <div id="login" class="modal">
      <span onclick="document.getElementById('login').style.display='none'" class="close"
      title="Close Modal">&times;</span>
      <form class="modal-content" action="login.php" method="post" autocomplete="on">
        <fieldset>
          <legend>Log In</legend>
            <label><b>Username:</b></label>
            <input type="text" placeholder="Enter Username or Email Address" name="user" maxlength="30" required>
            <label><b>Password:</b></label>
            <input type="password" placeholder="Enter Password" name="psw" maxlength="30" required>
            <div class="clearfix">
              <button type="button" onclick="document.getElementById('login').style.display='none'"
              class="cancelbtn">Cancel</button>
              <button type="submit">Submit</button>
              <span class="forgot"><a href="forgotpwd.html">Forgot password?</a></span>
            </div>
        </fieldset>
      </form>
    </div>

    <!-- Change Username Modal -->
    <div id="usname" class="modal">
      <span onclick="document.getElementById('usname').style.display='none'" class="close"
      title="Close Modal">&times;</span>
      <form class="modal-content" action="changeuname.php" method="post" autocomplete="on">
        <fieldset>
          <legend>Change Username</legend>
            <label><b>Current Username:</b></label>
            <input type="text" placeholder="Enter Current Username" name="currentuser" maxlength="30" required>
            <label><b>New Username:</b></label>
            <input type="text" placeholder="Enter New Username" name="newuser" maxlength="30" required>
            <div class="clearfix">
              <button type="button" onclick="document.getElementById('usname').style.display='none'"
              class="cancelbtn">Cancel</button>
              <button type="submit">Submit</button>
            </div>
        </fieldset>
      </form>
    </div>

    <!-- Change Password Modal -->
    <div id="newpword" class="modal">
      <span onclick="document.getElementById('newpword').style.display='none'" class="close"
      title="Close Modal">&times;</span>
      <form class="modal-content" action="changepword.php" method="post" autocomplete="on">
        <fieldset>
          <legend>Change Password</legend>
          <label><b>Old Password:</b></label>
          <input type="password" placeholder="Enter Old Password" name="currentpsw" maxlength="30" required>
          <label><b>New Password:</b></label>
          <input type="password" placeholder="Enter New Password" name="newpsw" maxlength="30" required>
          <div class="clearfix">
            <button type="button" onclick="document.getElementById('newpword').style.display='none'"
            class="cancelbtn">Cancel</button>
            <button type="submit">Submit</button>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- Update Email Modal -->
    <div id="newemail" class="modal">
      <span onclick="document.getElementById('newemail').style.display='none'" class="close"
      title="Close Modal">&times;</span>
      <form class="modal-content" action="changeemail.php" method="post" autocomplete="on">
        <fieldset>
          <legend>Update Email</legend>
          <label><b>Password:</b></label>
          <input type="password" placeholder="Enter Password" name="currentpwd" maxlength="255" required>
          <label><b>New Email:</b></label>
          <input type="email" placeholder="Enter New Email Address" name="newemail" maxlength="255" required>
          <div class="clearfix">
            <button type="button" onclick="document.getElementById('newemail').style.display='none'"
            class="cancelbtn">Cancel</button>
            <button type="submit">Submit</button>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- Delete Membership Modal -->
    <div id="delmember" class="modal">
      <span onclick="document.getElementById('delmember').style.display='none'" class="close"
      title="Close Modal">&times;</span>
      <form class="modal-content" action="deletemember.php" method="post" autocomplete="on">
        <fieldset>
          <legend>Delete Membership</legend>
          <label><b>Password:</b></label>
          <input type="password" placeholder="Enter Password" name="psw" maxlength="30" required>
          <div class="clearfix">
            <button type="button" onclick="document.getElementById('delmember').style.display='none'"
            class="cancelbtn">Cancel</button>
            <button type="submit">Submit</button>
          </div>
        </fieldset>
      </form>
    </div>

    <main>
      <canvas id="breakoutCanvas">
        <p>Your browser does not support this feature.  Try upgrading your browser.</p>
      </canvas>

      <div id="directions">
        <p id="new-game">Press <button id="new-button" onclick="restart()">Start</button> for a
        new game.</p>
        <p><b>How to Play:</b>  Clear all the bricks by bouncing the ball 
        into them.</p>
        <ul>
          <li>Click the game screen to serve the ball.</li>
          <li>Left and right arrows move the paddle.</li>  
          <li>Use the paddle to hit the ball into the bricks.</li> 
          <li>If you miss the ball, you lose the ball.</li>
          <li>You get 5 balls to clear all the bricks.</li>
          <li>If you succeed, it's on to the second and final level!</li>
          <li>To keep you on your toes, the ball speeds up after encountering a new color.</li>
          <li>Be aware that bouncing the ball off the top of the screen shrinks the paddle.</li>
          <li>Have fun!</li>
        </ul>
        <p style="color:white;"><span style="font-size:2em;">GamesDeal</span> <a style="color:white;" href="http://www.gamesdeal.com/?a-aid=brickball&amp;a_aid=brickball&amp;a_bid=ae830298" target="_top"><strong>3% Off Code</strong><br/>3% off code & free shipping  No minimum Purchase Requirement Code:gd3%off</a><img style="border:0" src="http://affiliate.gamesdeal.com/scripts/imp.php?a_aid=brickball&amp;a_bid=ae830298" width="1" height="1" alt="" /><strong style="font-size:2em;"> Visit GamesDeal</strong></p>
      </div>

      <div id="greeting"> 
        <p id="greet">
          <?php 
          if (!isset($_SESSION['uname'])) {
              echo 'Hello, creature! <button class="open-modal"
              onclick="document.getElementById(\'sign\').style.display=\'block\'">sign up</button> or <button class="open-modal" 
              onclick="document.getElementById(\'login\').style.display=\'block\'">log in</button> 
              to keep track of your best games. See if you have what it takes to join
              the top ten list.  Good luck!';
          } else {
              echo '<em>Welcome, ' . $_SESSION["uname"] . '!</em> | '; 

              if (isset($_SESSION['champs'])) {
                  echo 'Championships: ' . $_SESSION["champs"];
              } else if (isset($_SESSION['hscore'])) {
                  echo '<span id="high-score">High Score: ' . $_SESSION["hscore"] . '</span>';
              }
          }
          ?>
        </p>
        <p id="top">
          <?php include 'topten.php'; ?>
        </p>
      </div>

      <div class="clearfix"></div>

    </main>

    <footer>
      <h1>brick ball</h1>
      <?php 
      if (isset($_SESSION['uname'])) {
          echo '<button onclick="document.getElementById(\'usname\').style.display=\'block\'">Change Username</button>
          <button onclick="document.getElementById(\'newpword\').style.display=\'block\'">Change Password</button> 
          <button onclick="document.getElementById(\'newemail\').style.display=\'block\'">Update Email</button> 
          <button onclick="document.getElementById(\'delmember\').style.display=\'block\'">Delete Membership</button>'; 
      } else {
          echo '<button onclick="document.getElementById(\'sign\').style.display=\'block\'">Sign Up</button> 
          <button onclick="document.getElementById(\'login\').style.display=\'block\'">Log In</button>';
      }
      ?>
    </footer>
  </div>

  <script src="js/brickball.js"></script>

</body>

</html>
