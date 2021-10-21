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
	$stmt = $conn->prepare("SELECT DISTINCT m.name as Major, d.dept_name as Department, m.grad_req as Credits_Req, m.GPA_req
FROM major as m, departments as d
WHERE d.dept_id=m.dept_id");
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
