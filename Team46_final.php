<!doctype html>
<html>
<body>
<h1>Team 46 Final Project</h1>
<p> Info I308: Summer 2017</p>
<p>Stephen Jones, Elliott Burkett, Keegan McFatridge, Zachary Wood</p>
<h3>Query 1b</h3>
<p> Produce a class roster for a *specified section*</p> 
<p>Sort by student’s last name, first name. At the end, include the average grade (GPA for the class.)</p>
<form action="1b.php" method="POST">
Section: <select name="sectionID">
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46","i308u17_team46");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct Section_ID, Section_Name FROM section");
while ($row = mysqli_fetch_assoc($result)) {
	unset($section_id,$section_name);
	$section_id = $row['Section_ID'];
	$section_name=$row['Section_Name'];
	echo '<option value="'.$section_id.'">'.$section_name.'</option>';
}
?>
</select>
<br>
<input type="submit" value="Go to Table">
</form>


<h3>Query 2b</h3>
<p> Produce a list of rooms that are equipped with *some feature*—e.g., “wired instructor station”—that are available at a particular time.</p> 
<form action="2b.php" method="POST">
Feature:<select name='features'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46","i308u17_team46");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct features FROM rooms");
while ($row = mysqli_fetch_assoc($result)) {
	unset($features);
	$features = $row['features'];
	echo '<option value="'.$features.'">'.$features.'</option>';
}
?>
</select><br>
<input type="submit" value="Go to Table">
</form>




<h3>Query 5c</h3>
<p> Produce a chronological list of all courses taken by a *specified student*. Show grades earned.</p>
<p>Include overall hours earned and GPA at the end. (Hint: An F does not earn hours.)</p> 
<form action="5c.php" method="POST">
Student: <select name='LastName'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46","i308u17_team46");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct LastName FROM students");
while ($row = mysqli_fetch_assoc($result)) {
	unset($student_id,$LastName);
	$student_id = $row['student_id'];
	$LastName=$row['LastName'];
	echo '<option value=\"'.$student_id.'">'.$LastName.'</option>';
}
?>
</select><br></br>
<input type="submit" value="Go to Table">
</form>











<h3>Query 7a</h3>
<p> 7a Produce an alphabetical list of students with their majors who are advised by a *specified advisor*</p>
<form action="7a.php" method="POST">
Advisor: <select name='l_name'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46","i308u17_team46");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct l_name FROM advisors");
while ($row = mysqli_fetch_assoc($result)) {
	unset($advisor_id,$l_name);
	$advisor_id = $row['advisor_id'];
	$l_name=$row['l_name'];
	echo '<option value=\"'.$advisor_id.'">'.$l_name.'</option>';
}
?>
</select><br></br>
<input type="submit" value="Go to Table">
</form>




<h3>Query 8b</h3>
<p>8b Produce an alphabetical list of students who have not attended during the two most recent semesters along with their parents’ phone number</p>
<form action="8b.php" method="POST">
<input type="submit" value="Go to Table">
</form>



</body>
</html>