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

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT distinct '1416, 1516' as Semesters, concat(s.LastName,', ',s.FirstName) as Student, s.parent_phone as Parent_Phone
FROM students as s, student_classes as sc, semesters as se
WHERE NOT EXISTS
(SELECT*
FROM semesters as se
WHERE se.semester_id=1416
AND se.semester_id=1516)
AND sc.student_id=s.student_id
AND se.semester_id=sc.semester_id
ORDER BY s.LastName");
	$stmt->execute();

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
