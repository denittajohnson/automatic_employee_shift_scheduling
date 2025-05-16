<?php
session_start();
include('connection.php');

$crt =`python face_recognition.py`;


$myfile = fopen("out.txt", "r") or die("Unable to open file!");
$r=fread($myfile,filesize("out.txt"));
fclose($myfile);

if($r!="invalid")
{
	

$sel="SELECT * FROM employee WHERE id='$r' and status='accepted'";
		echo $sel;
		$result = mysqli_query($con,$sel) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		
		if($rows>0)
		{	
			$_SESSION['user']='employee';
			$_SESSION['uid']=$row['id'];
			$_SESSION['name']=$row['name'];
			header("location:index1.php");
			
		}
		else{
			header("location:login.php?st=fail");
		}
}
else{
			header("location:login.php?st=fail");
		}
?>