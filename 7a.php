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
$varadvisor = mysqli_real_escape_string($conn, $_POST['l_name']);
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT distinct a.l_name as Advisor, concat(s.LastName,', ',s.FirstName) as Student, m.name as Major
	FROM students as s, major as m, advisors as a, student_classes as sc
	WHERE s.student_id=sc.student_id
	AND sc.major_id=m.major_id
	AND s.advisor_id=a.advisor_id
	AND a.advisor_id='$varadvisor'
	ORDER BY s.LastName");
	$stmt->execute(array($varadvisor));

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
