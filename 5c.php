<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Course</th><th>Credits</th><th>Grades</th></tr>";

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
$varlastname = mysqli_real_escape_string($conn, $_POST['Last_Name']);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT distinct c.title,c.Credit_Hours as Credits, gd.grade_recieved
FROM course as c, grade_details as gd, student as s
WHERE c.Course_ID=gd.Course_ID
AND s.Student_ID=gd.Student_ID
AND s.Last_Name= '$varlastname'
UNION
SELECT 'Total',sum(c.credit_hours), s.GPA
FROM course as c, grade_details as gd, students as s
WHERE sc.student_id=s.student_id
AND c.Course_ID=gd.Course_ID
AND s.Last_Name= '$varlastname'
AND gd.Grade_Recieved!='F'");
    $stmt->execute(array($varlastname,$varlastname));

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
