
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
$varSection_ID = mysqli_real_escape_string($con, $_POST['Section_ID']);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("(SELECT DISTINCT se.Section_ID as Section,concat(s.Last_Name, ',' ,s.First_Name) as Name
FROM student as s, grade_details as gd, section as se
WHERE s.Student_ID=gd.Student_ID
AND se.Section_ID=gd.Section_ID
AND se.Section_ID=$varSection_ID
UNION all
SELECT 'AVG GPA',AVG(s.GPA)
FROM student as s, grade_details as gd, section as se
WHERE s.Student_ID=gd.Student_ID
AND se.Section_ID=$varSection_ID
ORDER BY Name ASC;")
    $stmt->execute(array($varSection_ID,$varSection_ID));
    
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
