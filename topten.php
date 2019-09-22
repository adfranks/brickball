<?php 
$servername = "localhost";
$username = "adpfrank_7ba6_cg";
$password = "gosun";
$dbname = "adpfrank_db1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to order top ten highscorers 
    $sql = $conn->prepare("SELECT username, championships, highscore FROM members ORDER BY championships DESC, highscore DESC LIMIT 10");
    $sql->setFetchMode(PDO::FETCH_OBJ);
    $sql->execute();
    $row = $sql->fetchAll();
    
    echo "<table>
            <tr>
              <th>Rank</th>
              <th>Top Ten</th>
              <th>High Score</th>
            </tr>";

    for ($x = 0; $x < 10; $x++) {
        echo "<tr><td>" . ($x + 1) . "</td>
              <td>" . $row[$x]->username . "</td>
              <td>"; 

        if ($row[$x]->championships == 0) {
            echo $row[$x]->highscore;
        } else {

            for ($y = 0; $y < $row[$x]->championships; $y++) {
                echo "<i class='fa fa-trophy'></i> ";
            }

        } 
    
        echo "</td></tr>";
    }

    echo "</table>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
