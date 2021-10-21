<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Section</th><th>Name</th></tr>";

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
$varbuilding = mysqli_real_escape_string($conn, $_POST['building']);
$vartime = mysqli_real_escape_string($conn, $_POST['time']);
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT distinct 'Student', concat(s.LastName, ', ',s.FirstName) as Name
FROM students as s, sections as se, student_classes as sc, rooms as r, buildings as b
WHERE sc.student_id=s.student_id
AND se.section_id=sc.section_id
AND r.room_id=se.room_id
AND r.building_id=b.building_id
AND b.name= '$varbuilding'
AND se.time= '$vartime'
UNION all
SELECT distinct 'Faculty', f.name as Name
FROM faculty as f,sections as se, rooms as r, buildings as b
WHERE f.faculty_id=se.faculty_id
AND r.room_id=se.room_id
AND r.building_id=b.building_id
AND b.name= '$varbuilding'
AND se.time= '$vartime' ");
	$stmt->execute(array($varbuilding,$vartime,$varbuilding,$vartime));

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		echo $v;
	}
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
