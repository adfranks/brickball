<?php 
session_start(); 
$servername = "localhost";
$username = "adpfrank_7ba6_cg";
$password = "gosun";
$dbname = "adpfrank_db1";
$q = intval($_GET['q']);

// only for members
if (isset($_SESSION['uname'])) {

    // Update when there is a new high score
    if (!isset($_SESSION['champs']) && $q > $_SESSION['hscore']) {
        $_SESSION['hscore'] = $q;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to select user's highscore from db 
            $sql = $conn->prepare("UPDATE members SET highscore='" . 
            $q . "' WHERE username='" . $_SESSION['uname'] . "'");

            $sql->execute();
            echo "<b>Congratulations!!!  New High Score: " . 
            $_SESSION['hscore'] . "</b>"; 
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    } else if (!isset($_SESSION['champs'])) {
        echo "High Score: " . $_SESSION['hscore'];
    } else {
        echo "Yeeeaaaaahhhhh!!!  Hooray!  Great job, Champ!!!";
    }

}
?>
