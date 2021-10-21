<?php
//Step 2.1 - Remove this comment when done
$con=mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46", "i308u17_team46");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{ echo "Established Database Connection" ;}
	
//Step 2.2 - Uncomment the following when instructed.



$var_grade_r = $_POST['Grade_Received'];
$var_section_id = $_POST['Section_ID'];
$var_course_id = $_POST['Course_ID'];
$var_student_id = $_POST['Student_ID'];

$query ="INSERT INTO grade_details(Grade_Received, Section_ID, Course_ID, Student_ID)
VALUES ('$var_grade_r','$var_section_id', '$var_course_id', '$var_student_id')";

if (mysqli_query($con, $query))
	{echo "1 record added";}
Else
	{ die('SQL Error: ' . mysqli_error($con)); }
mysqli_close($con);
?>