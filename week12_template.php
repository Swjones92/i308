<?php
//Step 2.1 - Remove this comment when done
$con=mysqli_connect("[1]","[2]","[3]", "[4]");
// Check connection
if (![5])
	{die("Failed to connect to MySQL: " . [6]); }
else 
	{ echo "Established Database Connection" ;}
	
//Step 2.2 - Uncomment the following when instructed.
/*
$varcname = mysqli_real_escape_string($con,$_POST['cname']);
[1]
[2]

$sql="INSERT INTO customer [3]
if (mysqli_query[4])
	{echo "1 record added";}
Else
	{ die('SQL Error: ' . [5] ); }
mysqli_close($con);
*/
?>