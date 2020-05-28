<?php 
session_start(); 
$servername = "localhost";
$username = "adpfrank_7ba6_cg";
$password = "gosun";
$dbname = "adpfrank_db1";

// only for members
if (isset($_SESSION['uname'])) {

// Update championships after winning 
    if (!isset($_SESSION['champs'])) {$_SESSION['champs'] = 0;}

    $_SESSION['champs']++; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to select user's highscore from db 
        $sql = $conn->prepare("UPDATE members SET championships=" .
        "championships + 1, highscore=224 WHERE username='" . 
        $_SESSION['uname'] . "'");

        $sql->execute();
        echo " <b>Victory!!! Championships: " . 
        $_SESSION['champs'] . "</b>"; 
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
