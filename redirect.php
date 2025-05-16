<?php
session_start();
include('connection.php');

// Connect to server and select databse.


// username and password sent from form 
$myusername=$_POST['email']; 
$mypassword=$_POST['password']; 


if(isset($_POST['login']))
{
	if($_POST['type']=='admin')
	{
		if($myusername=="admin@gmail.com" and $mypassword=="admin")
		{
				$_SESSION['user']="admin";
				$_SESSION['name']="admin";
				header("location:admin/dashboard/dashboard.php");
		}
	}
	elseif($_POST['type']=='employee')
	{
		$sel="SELECT * FROM employee WHERE email='$myusername' and password='$mypassword' and status='accepted'";
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
	elseif($_POST['type']=='head')
	{
		$sel="SELECT * FROM department_head WHERE email='$myusername' and password='$mypassword'";
		echo $sel;
		$result = mysqli_query($con,$sel) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		
		if($rows>0)
		{	
			$_SESSION['user']='head';
			$_SESSION['uid']=$row['id'];
			$_SESSION['email']=$row['email'];
			$_SESSION['name']=$row['name'];
			$_SESSION['did']=$row['department_id'];
			header("location:admin/dashboard/dashboard.php");
			
		}
		else{
			
			header("location:login.php?st=fail");
		}
	}
	elseif($_POST['type']=='company')
	{
		$sel="SELECT * FROM company WHERE email='$myusername' and password='$mypassword' and status='accepted'";
		echo $sel;
		$result = mysqli_query($con,$sel) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		
		if($rows>0)
		{	
			$_SESSION['user']='company';
			$_SESSION['uid']=$row['id'];
			$_SESSION['email']=$row['email'];
			$_SESSION['name']=$row['name'];
			header("location:admin/dashboard/dashboard.php");
			
		}
		else{
			
			header("location:login.php?st=fail");
		}
	}
	else
	{
			
			header("location:login.php?st=fail");
	}
}
else{
	header("location:login.php?st=fail");
}

?>
 
 



