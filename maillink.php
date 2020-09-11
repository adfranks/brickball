<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball forgot password">
  <meta name="description" 
  content="breakout game for web browser password reset instructions">
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
$token = bin2hex(openssl_random_pseudo_bytes(16));
$expiry = strtotime("+24 hours");
$email = $_POST['email'];
$url = "<a href='adfranks.com/brickball/updatepwd.php?token=" . $token . "&email=" . $email . "'>Reset Password</a>";
$msg = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <!--[if !mso]><!-->
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <!--<![endif]-->
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />
  <title>Password reset</title>

  <!--[if (gte mso 9)|(IE)]>
  <style type='text/css'>
    table {border-collapse: collapse !important;}
  </style>
  <![endif]-->

</head>

<body bgcolor='#1c1c1c' style='margin-top:0!important;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >

<center class='wrapper' style='color:#000000;width:100%!important;height:100%!important;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;' >
  <div class='webkit' style='max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;' >

    <!--[if (gte mso 9)|(IE)]>
    <table role='presentation' cellpadding='0' cellspacing='0' border='0' width='600' align='center' 
    style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
      <tr>
        <td style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
    <![endif]-->

    <table role='presentation' class='outer' align='center' bgcolor='#f5f5f5' 
    style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;Margin:0 auto;width:100%;max-width:600px;' >
      <tr>
        <td class='header' bgcolor='#f5f5f5' 
        style='border-collapse:collapse;border-bottom:thick solid #000000;padding-top:40px;padding-bottom:20px;padding-right:30px;padding-left:30px;' >

          <table role='presentation' width='70' align='left' cellpadding='0' cellspacing='0' 
          style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
            <tr>
              <td height='70' style='padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:0;border-collapse:collapse;' >
                <img src='https://adfranks.com/brickball/images/brickball-icon.png' width='70' height='70' border='0' alt='' 
                style='border-width:0;border-style:none;height:auto;line-height:100%;outline-style:none;text-decoration:none;' />
              </td>
            </tr>
          </table>

          <!--[if (gte mso 9)|(IE)]>
          <table role='presentation' width='425' align='left' cellpadding='0' cellspacing='0' border='0' 
          style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
            <tr>
              <td style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
              <![endif]-->

          <table role='presentation' class='col425' align='left' border='0' cellpadding='0' cellspacing='0' 
          style='width:100%;max-width:425px;border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
            <tr>
              <td height='70' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >

                <table role='presentation' width='100%' border='0' cellspacing='0' cellpadding='0' 
                style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
                  <tr>
                    <td class='subhead' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:53px;font-family:Helvetica,sans-serif;line-height:58px;font-weight:bold;' >
                      Brick Ball  
                    </td>
                  </tr>
                  <tr>
                    <td class='titlehead' 
                    style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:3px;border-collapse:collapse;font-size:15px;font-family:sans-serif;' >
                      New Version of Vintage Game  
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
          </table>

              <!--[if (gte mso 9)|(IE)}>
              </td>
            </tr>
          </table>
          <![endif]-->

        </td>
      </tr>
      <tr>
        <td class='one-column' style='border-collapse:collapse;padding-top:25px;padding-bottom:25px;padding-right:25px;padding-left:25px;' >

          <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
            <tr>
              <td class='inner contents' 
              style='border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px;width:100%;text-align:left;' >
                <p style='padding-top:0;padding-bottom:10px;padding-right:0;padding-left:0;Margin:0;font-size:44px;' >
                  <b class='h1' style='font-size:44px;' >
                    PASSWORD RESET 
                  </b>
                </p>
                <p class='body-c' 
                style='Margin:0;line-height:34px;font-size:24px;' >If you 
                requested to reset your password, please click on 
                the link: " . $url . "<br /><br />Otherwise, feel free to 
                ignore this message. 
                </p> 
              </td>
            </tr>
          </table>

        </td>
      </tr>
      <tr>
        <td class='footer' bgcolor='#000000' style='border-collapse:collapse;padding-top:20px;padding-bottom:80px;padding-right:30px;padding-left:30px;' >

          <table role='presentation' width='100%' border='0' cellspacing='0' cellpadding='0' 
          style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
            <tr>
              <td align='center' class='footercopy' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Calibri,Helvetica,Verdana,sans-serif;font-size:24px;line-height:34px;color:#ffffff;' >
                <a href='https://adfranks.com/brickball/brickball.php' style='color:#ffffff;text-decoration:underline;' ><font color='#ffffff'>Brick Ball</font></a>
              </td>
            </tr>
            <tr>
              <td align='center' style='padding-top:16px;padding-bottom:0;padding-right:0;padding-left:0;border-collapse:collapse;' >

                <table role='presentation' border='0' cellspacing='0' cellpadding='0' 
                style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
                  <tr>
                    <td width='37' style='text-align:center;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;border-collapse:collapse;' >
                      <img src='https://adfranks.com/brickball/images/brickball-icon.png' width='70' height='70' border='0' alt='' 
                      style='border-width:0;border-style:none;height:auto;line-height:100%;outline-style:none;text-decoration:none;' />
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
          </table>

        </td>
      </tr>
    </table>

    <!--[if (gte mso 9)|(IE)]>
        </td>
      </tr>
    </table>
    <![endif]-->

  </div>
</center>

</body>

</html>";
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
    
    /* mail a link to user with token attached to url, then give a 
    success response with further instructions */
    mail($email,"Reset Password",$msg,$headers);
    echo '<div class="form-response" style="line-height:1.5em;">A message will be sent to your email address.  Within 24 hours, open the message and click on the provided link to reset your password.<br /><br /><button type="button" onclick="window.location.href=\'brickball.php\'">Back</button></div>';

} catch (PDOException $e) {
    echo '<span class="errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . '</span><br /><br /><button type="button" onclick="window.location.href=\'brickball.php\'">Back</button>';
}

$conn = null;
?>
</div>

</body>

</html>
