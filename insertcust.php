<?php
//Step 2.1 - Remove this comment when done
$con=mysqli_connect("db.soic.indiana.edu","i308u17_team46","my+sql=i308u17_team46", "i308u17_team46");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{ echo "Established Database Connection" ;}
	
//Step 2.2 - Uncomment the following when instructed.



$var_cname = $_POST['cname'];
$var_addr = $_POST['address'];
$var_phone = $_POST['phone'];

$query ="INSERT INTO customer(name,address,phone)
VALUES ('$var_cname','$var_address', '$var_phone')";

if (mysqli_query($con, $query))
	{echo "1 record added";}
Else
	{ die('SQL Error: ' . mysqli_error($con)); }
mysqli_close($con);
?>