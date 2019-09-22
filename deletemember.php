<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball delete membership page" />
  <meta name="description" content="breakout game for web browser log in page" />
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
    $psw = md5($_POST['psw']);

    if (isset($_SESSION['uname'])) {

				try {
						$conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

						// set the PDO error mode to exception
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						// delete the member
						$sql = "DELETE FROM members WHERE username='" . $_SESSION['uname'] . "' AND password=
						'" . $psw . "'";
						$row = $conn->exec($sql);

						if ($row == null) {
								echo '<span class="errormsg">Invalid password.  Please try again.</span>
								<form class="tryagain" action="deletemember.php" method="post" autocomplete="on">
								<fieldset>
								<legend>Delete Membership</legend>
								<label><b>Password:</b></label>
								<input type="password" placeholder="Enter Password" name="psw" maxlength="30" required>
								<div class="clearfix">
								<button type="button" onclick="window.location.href=\'brickball.php\'"
								class="cancelbtn">Cancel</button>
								<button type="submit">Submit</button>
								<span class="forgot"><a href="#">Forgot username or password?</a></span>
								</div></fieldset></form>';
						} else {
								echo '<p class="form-response">Membership deleted successfully.<br /><br />
								<button type="button" onclick="window.location.href=\'logout.php\'">
								Play a Game</button></p>';
						}

				}
				catch (PDOException $e) {
						echo '<span class="errorsmg">Oopsy Daisy!  Error: ' . $e->getMessage() . 
						'</span><a href="brickball.php">Go back and play the game</a>.';
				}

				$conn = null;
    }
    ?>
  </div>

</body>

</html>
