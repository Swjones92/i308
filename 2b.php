<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Room</th><th>Feature</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "db.soic.indiana.edu";
$username = "i308u17_team46";
$password = "my+sql=i308u17_team46";
$dbname = "i308u17_team46";
$con = mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46","i308u17_team46");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
    }
$varfeatures = mysqli_real_escape_string($conn, $_POST['Features']);

try {
    $features = $_POST['Features'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT r.Room_ID as Room, rf.Features as Feature
    FROM room_features as rf,room as r
    WHERE NOT EXISTS
    (Select *
    FROM section as se
    WHERE se.Section_time='10:55:00')
    AND rf.Room_ID=r.Room_ID
    AND rf.Features= '$varfeatures' ;");
    $stmt->execute(array($varfeatures));

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}