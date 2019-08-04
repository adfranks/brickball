<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball reset password page" />
  <meta name="description" content="breakout game for web browser reset password page" />
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

    if ($_POST['newpsw'] == $_POST['newpsw-confirm']) {
      try {
          $conn = new PDO("mysql:host=$servername;dbname=adpfrank_db1", $username, $password);

          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // sql to change password in db.
          $sql = $conn->prepare("UPDATE members SET password=
                 '" . md5($_POST['newpsw']) . "' WHERE email='" . $_POST['email'] . "'");
          $sql->execute();

          echo '<p class="form-response">Password successfully reset!<br /><br />
                <button type="button" onclick="window.location.href=\'brickball.php\'">Log in & Play a Game</button>';
          } catch (PDOException $e) {
              echo '<span class="errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . 
              '</span><br /><a href="brickball.php">Go back</a>.';
      }

      $conn = null;
    } else {echo 'Passwords do not match.  Please, try again.';}
    ?>
  </div>

</body>

</html>
