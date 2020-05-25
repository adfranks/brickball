<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball forgot password" />
  <meta name="description" content="breakout game for web browser password 
  reset instructions" />
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
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    $expiry = strtotime("+24 hour");
    $email = $_POST['email'];
    $url = "<a href='adfranks.com/brickball/updatepwd.php?token=" . $token . "&email=" . $email . "'>Reset Password</a>";
    $msg = "<html><head><title>Reset Password</title></head><body><p>If you requested to reset your password, please click on the link within the hour:  " . $url . "</p><p>Otherwise, ignore this message.<br />Brickball</p></body></html>"; 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: info@adfranks.com" . "\r\n";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to find user and put the token and expiration in the db
        $sql = $conn->prepare("UPDATE members SET token='" . $token . "', expiration='" . $expiry . "' WHERE email='" . $email . "'");

        $sql->execute();
        
        // mail a link to user with token attached to url, then give a success response with further instructions
        mail($email,"Reset Password",$msg,$headers);
        echo '<p class="form-response">A message was just sent to your email address.  Within 24 hours, open the message and click on the provided link to reset your password.</p>';
    } catch (PDOException $e) {
        echo '<span class="errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . '</span><br /><br /><a href="brickball.php">Go back to the game</a>.';
    }

    $conn = null;
    ?>
  </div>

</body>

</html>
