<?php
session_start();
/*if($_SESSION['user']=="")
{
header("location:../../login.php");
}*/

$title="";
?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>smartshift</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="../common/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">

<div class="sidebar" data-color="yh">

    	<div class="sidebar-wrapper">
            <div class="logo">
            <br/> <br/>
            
               <a href="../dashboard/dashboard.php"><center><h2 style="background-color:#223d44; color:white; border-radius:10px; padding:10px;">SmartShift</h2><center></a> 
                 
            </div>

            <ul class="nav">
                
                
                <li >
                    <a href="../dashboard/dashboard.php">
                        <i class="pe-7s-home"></i>
                        <p style="font-size:18px">Home</p>
                    </a>
                </li>
                
                
               

                 <li>
                    <a href="../../logout.php">
                        <i class="pe-7s-bell"></i>
                         <p style="font-size:18px">Log Out</p>
                    </a>
                </li>
               				
            </ul>
            
            <?php
            if($_SESSION['user']=='company')
            {
            ?>
            <ul>
                <li style="margin-top:270px;">
                    <a href="../dashboard/delete_company.php">
                         <p style="font-size:18px" class='btn btn-danger'>Delete Company</p>
                    </a>
                </li>
            </ul>
            <?php
            }
            ?>
    	</div>
    </div>
    <div class="main-panel" style=" background-image: url(../dashboard/flight4.jpg); background-size:cover;">

    <nav class="">
            <div class="container-fluid">
                <div class="navbar-header">
                           <div style="padding-left:50px;padding-right:50px">      
<!--  <font face="Trebuchet MS, Arial, Helvetica, sans-serif" size="+3" color="#fbb808">  <font color="#000000">Welcome </font>You <font color="#000000">To</font> Grocery Connection<font color="#000000"></font></font>
</marquee>-->
                  
                </div>
                
            </div>
        </nav>