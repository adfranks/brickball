<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>Brick ball</title>
  <meta name="keywords" content="brick ball sign up page">
  <meta name="description" 
  content="breakout game for web browser sign up page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/brickball-icon.png">
  <link rel="stylesheet" type="text/css" href="css/brickball.css">
</head>

<body>

<div id="container">
<header>
  <h1><a class="heading" href="https://adfranks.com/brickball/brickball.php">brick ball</a></h1>
</header>
<?php
$_SESSION['uname'] = $_POST['user']; 
$_SESSION['pword'] = md5($_POST['psw']); 
$_SESSION['email'] = $_POST['email'];
$_SESSION['hscore'] = 0;
$servername = "localhost";
$username = "adpfrank_7ba6_cg";
$password = "gosun";
$dbname = "adpfrank_db1";
$msg = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

  <!--[if !mso]><!-->
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <!--<![endif]-->

  <meta name='viewport' content='width=device-width, initial-scale=1.0' />
  <title>Welcome</title>
  <link rel='icon' 
  href='https://adfranks.com/brickball/images/brickball-icon.png'>
  <style type='text/css'>
    @media screen and (max-width: 500px) {
      .two-column .column {
        max-width: 100%!important;
      }
      .two-column img {
        max-width: 100%!important;
      }
    }

    @media screen and (min-width: 501px) and (max-width: 620px) {
      .two-column .column {
        max-width: 50%!important;
      }
    }
  </style>

  <!--[if (gte mso 9)|(IE)]>
  <style type='text/css'>
    table {border-collapse: collapse !important;}
  </style>
  <![endif]-->

</head>

<body style='margin-top:0!important;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >

<center class='wrapper' style='width:100%!important;height:100%!important;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;' >
  <div class='webkit' style='max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;' >

    <!--[if (gte mso 9)|(IE)]>
    <table role='presentation' cellpadding='0' cellspacing='0' border='0' width='600' align='center' 
    style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
      <tr>
        <td style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
    <![endif]-->

    <table role='presentation' class='outer' align='center' 
    bgcolor='#fcfaee' style='color:#000000;border-collapse:collapse;border-spacing:0;font-family:sans-serif;Margin:0 auto;width:100%;max-width:600px;' >
      <tr>
        <td class='header' bgcolor='#fcfaee' style='border-collapse:collapse;padding-top:20px;padding-bottom:20px;padding-right:30px;padding-left:30px;' >

          <!--[if (gte mso 9)|(IE)]>
          <table role='presentation' width='600' align='left' cellpadding='0' cellspacing='0' border='0' 
          style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
            <tr>
              <td style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
              <![endif]-->

          <table role='presentation' align='left' border='0' cellpadding='0' cellspacing='0' 
          style='width:100%;max-width:600px;border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
            <tr>
              <td class='subhead' style='border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-right:0;padding-left:0;font-size:33px;font-family:Tahoma, sans-serif;line-height:45px;font-weight:bold;' >
                <img src='https://adfranks.com/brickball/images/brickball-icon.png' width='26' alt='' style='height:auto;max-width:26;border-width:0;border-style:none' />
                <b>BRICK BALL</b>
              </td>
            </tr>
          </table>

              <!--[if (gte mso 9)|(IE)]>
              </td>
            </tr>
          </table>
          <![endif]-->

        </td>
      </tr>
      <tr>
        <td class='one-column' bgcolor='#ff5050' style='border-collapse:collapse;color:#ffffff;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;' >

          <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:Calibri,Helvetica,Verdana,sans-serif;' >
            <tr>
              <td class='inner contents' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;width:100%;text-align:left;' >
                <p style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;Margin:0;font-size:26px;' >
                  <b class='h1' style='color:#ffffff;font-size:26px;' >
                    WELCOME TO BRICK BALL!                    
                  </b>
                </p>
                <p class='body-c' style='color:#ffffff;Margin:16px 0;line-height:22px;font-size:18px;' >The classic games Breakout and Super Breakout
                are back in a slightly new guise.  It has the
                look of the colorful
                Super Breakout, as well as the option for more than one
                level.  However, it is much more minimalist than
                flashy Arkanoid versions.  The angle and speed of the ball,
                as well as the size of the paddle, are dynamic and vary
                at certain times during the game.  Have fun!</p>
              </td>
            </tr>
          </table>

          <table role='presentation' class='buttonwrapper' align='left' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
            <tr>
              <td class='button' bgcolor='#0066ff' style='border-collapse:collapse;text-align:center;' >
                <a href='https://adfranks.com/brickball/brickball.php' target='_blank' style='color:#ffffff;background-color:#0066ff;font-size:18px;font-family:sans-serif;font-weight:bold;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:30px;border:1px solid #0066ff;text-decoration:none;display:inline-block;' >
                  Play a Game
                </a>
              </td>
            </tr>
          </table>

        </td>
      </tr>
      <tr>
        <td height='20'>&nbsp;</td>
      </tr>
      <tr>
        <td class='two-column' bgcolor='#fcfaee' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;text-align:left;font-size:0;' >

          <!--[if (gte mso 9)|(IE)]>
          <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
            <tr>
              <td width='50%' valign='top' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
          <![endif]-->

          <div class='column' style='width:100%;max-width:290px;display:inline-block;vertical-align:top;' >

            <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
              <tr>
                <td class='inner' style='border-collapse:collapse;padding-top:10px;padding-bottom:20px;padding-right:10px;padding-left:10px;' >

                  <table role='presentation' class='contents' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;width:100%;font-size:16px;text-align:left;' >
                    <tr>
                      <td style='border-collapse:collapse;padding-top:0;padding-bottom:10px;padding-right:0;padding-left:0;' >
                        <img src='https://adfranks.com/brickball/images/highscore.jpg' width='270' alt='' style='border-width:0;border-style:none;line-height:100%;outline-style:none;text-decoration:none;width:100%;max-width:280px;height:auto;' />
                      </td>
                    </tr>
                    <tr>
                      <td class='text' style='text-align:left;border-collapse:collapse;padding-bottom:0;padding-right:0;padding-left:0;padding-top:10px;' >
                        <p style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;Margin:0;font-size:20px;' >
                         <b style='color:#000000;font-size:20px'>
                          Keep track of your high score.
                         </b>                        
                        </p>
                        <p class='body-c' style='color:#000000;line-height:22px;font-size:16px;Margin:16px 0;'>Appreciate your accomplishments
                        and celebrate your best score!  It's hard to
                        make it back to the
                        top.  That high score is proof you made it there
                        once and you could do it again.</p>
                      </td>
                    </tr>
                  </table>

                  <table role='presentation' class='buttonwrapper' align='left' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
                    <tr>
                      <td class='button' bgcolor='#0066ff' style='border-collapse:collapse;text-align:center;' >
                        <a href='https://adfranks.com/brickball/brickball.php' target='_blank' style='color:#ffffff;background-color:#0066ff;font-size:18px;font-family:sans-serif;font-weight:bold;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:30px;border:1px solid #0066ff;text-decoration:none;display:inline-block;' >
                          Log In
                        </a>
                      </td>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>

          </div>

          <!--[if (gte mso 9)|(IE)]>
              </td>
              <td width='50%' valign='top' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
          <![endif]-->

          <div class='column' style='width:100%;max-width:290px;display:inline-block;vertical-align:top;' >

            <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
              <tr>
                <td class='inner' style='border-collapse:collapse;padding-top:10px;padding-bottom:20px;padding-right:10px;padding-left:10px;' >

                  <table role='presentation' class='contents' 
                  style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;width:100%;font-size:16px;text-align:left;' >
                    <tr>
                      <td style='border-collapse:collapse;padding-top:0;padding-bottom:10px;padding-right:0;padding-left:0;' >
                        <img src='https://adfranks.com/brickball/images/topten.jpg' width='270' alt='' style='border-width:0;border-style:none;line-height:100%;outline-style:none;text-decoration:none;width:100%;max-width:280px;height:auto;' />
                      </td>
                    </tr>
                    <tr>
                      <td class='text' style='text-align:left;border-collapse:collapse;padding-bottom:0;padding-right:0;padding-left:0;padding-top:10px;' >
                        <p style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;Margin:0;font-size:20px;' >
                         <b style='color:#000000;font-size:20px'>
                          Play your way into the top ten list.
                         </b>                        
                        </p>
                        <p class='body-c' style='color:#000000;line-height:22px;font-size:16px;Margin:16px 0;' >Brick ball is a deceptively simple game.
                        However, if you slip just once or get an angle
                        slightly wrong, you could lose a ball really
                        quickly.  Good luck getting into the top ten list!
                        </p>
                      </td>
                    </tr>
                  </table>

                  <table role='presentation' class='buttonwrapper' align='left' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
                    <tr>
                      <td class='button' bgcolor='#0066ff' style='border-collapse:collapse;text-align:center;' >
                        <a href='https://adfranks.com/brickball/brickball.php' target='_blank' style='color:#ffffff;background-color:#0066ff;font-size:18px;font-family:sans-serif;font-weight:bold;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:30px;border:1px solid #0066ff;text-decoration:none;display:inline-block;' >
                          Play to Win
                        </a>
                      </td>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>

          </div>

          <!--[if (gte mso 9)|(IE)]>
              </td>
            </tr>
          </table>
          <![endif]-->

        </td>
      </tr>
      <tr>
        <td class='two-column' bgcolor='#fcfaee' 
        style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;text-align:left;font-size:0;' >

          <!--[if (gte mso 9)|(IE)]>
          <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
            <tr>
              <td width='50%' valign='top' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
          <![endif]-->

          <div class='column' style='width:100%;max-width:290px;display:inline-block;vertical-align:top;' >

            <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
              <tr>
                <td class='inner' style='border-collapse:collapse;padding-top:10px;padding-bottom:20px;padding-right:10px;padding-left:10px;' >

                  <table role='presentation' class='contents' 
                  style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;width:100%;font-size:16px;text-align:left;' >
                    <tr>
                      <td style='border-collapse:collapse;padding-top:0;padding-bottom:10px;padding-right:0;padding-left:0;' >
                        <img src='https://adfranks.com/brickball/images/unlimited.jpg' width='270' alt='' style='border-width:0;border-style:none;line-height:100%;outline-style:none;text-decoration:none;width:100%;max-width:280px;height:auto;' />
                      </td>
                    </tr>
                    <tr>
                      <td class='text' style='text-align:left;border-collapse:collapse;padding-bottom:0;padding-right:0;padding-left:0;padding-top:10px;' >
                        <p style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;Margin:0;font-size:20px;' >
                         <b style='color:#000000;font-size:20px'>
                          Unlimited minutes.
                         </b>                        
                        </p>
                        <p class='body-c' style='color:#000000;line-height:22px;font-size:16px;Margin:16px 0;'>Play for as long as you like.  You don't
                        have to worry about the clock and how
                        much time you have.
                        This is about your skill and how long you can
                        keep that ball bouncing.</p>
                      </td>
                    </tr>
                  </table>

                  <table role='presentation' class='buttonwrapper' align='left' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
                    <tr>
                      <td class='button' bgcolor='#0066ff' style='border-collapse:collapse;text-align:center;' >
                        <a href='https://adfranks.com/brickball/brickball.php' target='_blank' style='color:#ffffff;background-color:#0066ff;font-size:18px;font-family:sans-serif;font-weight:bold;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:30px;border:1px solid #0066ff;text-decoration:none;display:inline-block;' >
                          Start Now
                        </a>
                      </td>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>

          </div>

          <!--[if (gte mso 9)|(IE)]>
              </td>
              <td width='50%' valign='top' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;' >
          <![endif]-->

          <div class='column' style='width:100%;max-width:290px;display:inline-block;vertical-align:top;' >

            <table role='presentation' width='100%' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
              <tr>
                <td class='inner' style='border-collapse:collapse;padding-top:10px;padding-bottom:20px;padding-right:10px;padding-left:10px;' >

                  <table role='presentation' class='contents' 
                  style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;width:100%;font-size:16px;text-align:left;' >
                    <tr>
                      <td style='border-collapse:collapse;padding-top:0;padding-bottom:10px;padding-right:0;padding-left:0;' >
                        <img src='https://adfranks.com/brickball/images/delete.jpg' width='270' alt='' style='border-width:0;border-style:none;line-height:100%;outline-style:none;text-decoration:none;width:100%;max-width:280px;height:auto;' />
                      </td>
                    </tr>
                    <tr>
                      <td class='text' style='text-align:left;border-collapse:collapse;padding-bottom:0;padding-right:0;padding-left:0;padding-top:10px;' >
                        <p style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;Margin:0;font-size:20px;' >
                         <b style='color:#000000;font-size:20px'>
                          Easily cancel your membership at any time.
                         </b>                        
                        </p>
                        <p class='body-c' style='color:#000000;line-height:22px;font-size:16px;Margin:16px 0;' >At any time you wish, you may quickly
                        and easily end your membership.  Simply
                        log in and select
                        the cancel membership option.  Your record will
                        be purged from our system.  You can sign up
                        again whenever you wish.</p>
                      </td>
                    </tr>
                  </table>

                  <table role='presentation' class='buttonwrapper' align='left' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
                    <tr>
                      <td class='button' bgcolor='#0066ff' style='border-collapse:collapse;text-align:center;' >
                        <a href='https://adfranks.com/brickball/brickball.php' target='_blank' style='color:#ffffff;background-color:#0066ff;font-size:18px;font-family:sans-serif;font-weight:bold;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:30px;border:1px solid #0066ff;text-decoration:none;display:inline-block;' >
                          Check It Out
                        </a>
                      </td>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>

          </div>

          <!--[if (gte mso 9)|(IE)]>
              </td>
            </tr>
          </table>
          <![endif]-->

        </td>
      </tr>
      <tr>
        <td height='10'>&nbsp;</td>
      </tr>
      <tr>
        <td class='footer' bgcolor='#ff3300' style='border-collapse:collapse;padding-top:20px;padding-bottom:95px;padding-right:30px;padding-left:30px;' >

          <table role='presentation' width='100%' border='0' cellspacing='0' cellpadding='0' 
          style='border-collapse:collapse;border-spacing:0;font-family:sans-serif;' >
            <tr>
              <td align='center' class='footercopy' style='border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:sans-serif;font-size:14px;line-height:18px;color:#ffffff;' >
                <a href='https://adfranks.com/brickball/brickball.php' target='_blank' style='color:#ffffff;text-decoration:underline;' ><font color='#ffffff'>Log in to cancel membership</font></a>
                <br />
                &reg; Brick Ball, Baltimore, MD 2020
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

</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@adfranks.com" . "\r\n";

if ($_POST['psw'] === $_POST['psw-confirm']) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to add new user into db 
        $sql = "INSERT INTO members (username, password, email) VALUES ('" .
        $_SESSION['uname'] . "', '" . $_SESSION['pword'] . "', '" . 
        $_SESSION['email'] . "')";
        
        // use exec() because no results are returned
        $conn->exec($sql);

        /* mail a link to user with token attached to url, then give a 
        success response with further instructions */
        mail($_SESSION['email'],"Welcome",$msg,$headers);
        echo '<p class="form-response">Successful sign up!' .
        '<br><br><button type="button" onclick="window.location.href=' .
        '\'brickball.php\'">Enter</button></p>';
    }
    catch(PDOException $e) {

        /* ensure session username is destroyed, so it will not be 
        displayed on home page, if error occurs */
        session_unset();
        session_destroy();

        switch($e->getCode()) {
            case 23000:
                echo '<div class="form-response"><span class=' .
                '"errormsg">Sorry, that username or email already' .
                ' exists.  Please choose another one and try again.' .
                '</span><form class="tryagain" action="member.php" ' .
                'method="post" autocomplete="on"><fieldset>' .
                '<legend>Sign Up</legend><label><b>Email:</b></label>' .
                '<input type="email" placeholder="Enter Email Address" ' .
                'name="email" maxlength="255" required>' .
                '<label><b>Username:</b></label><input type=' .
                '"text" placeholder="Enter Username" name=' .
                '"user" maxlength="30" required><label><b>Password:</b>' .
                '</label><input type="password" placeholder=' .
                '"Enter Password" name="psw" maxlength="30" required>' .
                '<label><b>Confirm Password:</b></label><input type=' .
                '"password" placeholder="Confirm Password" name=' .
                '"psw-confirm" maxlength="20" required><button class=' .
                '"cancelbtn" type="button" onclick=' .
                '"window.location.href=\'brickball.php\'">Cancel</button>' .
                '<button type="submit">Submit</button></fieldset></form>' .
                '</div>';
                
                break;
            default:
                echo '<p class="form-response"><span class=' .
                '"errormsg">Oopsy Daisy!  Error: ' . $e->getMessage() . 
                '</span><br /><a class="error-link" href=' .
                '"brickball.php">Go back and play the game</a>.</p>';
        }
    }

    $conn = null;
} else {
    session_unset();
    session_destroy();
    echo '<div class="form-response"><span class="errormsg">' .
    'Passwords do not match.  Please try again.</span>' .
    '<form class="tryagain" action="member.php" method=' .
    '"post" autocomplete="on"><fieldset><legend>Sign Up</legend>' .
    '<label><b>Email:</b></label><input type="email" placeholder=' .
    '"Enter Email Address" name="email" maxlength="255" required>' .
    '<label><b>Username:</b></label><input type="text" placeholder=' .
    '"Enter Username" name="user" maxlength="30" required>' .
    '<label><b>Password:</b></label><input type=' .
    '"password" placeholder="Enter Password" name="psw" maxlength=' .
    '"30" required><label><b>Confirm Password:</b></label>' .
    '<input type="password" placeholder="Confirm Password" name=' .
    '"psw-confirm" maxlength="20" required><button class=' .
    '"cancelbtn" type="button" onclick="window.location.href=' .
    '\'brickball.php\'">Cancel</button><button type="submit">' .
    'Submit</button></fieldset></form></div>';
}
?>
</div>

</body>

</html>
