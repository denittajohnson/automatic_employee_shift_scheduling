<?php
error_reporting(0);
$status=$_REQUEST['status'];
if ($status == "logout")
{
    session_start();
    session_unset();
    session_destroy();
	header("location:../login/login.php");
}
?>
<?php
include("../common/menu.php");
	
?>


    <style>
#right
{
	
float:right;	
color:#333;
font-size:12px;
}
</style>

<style>
#right
{
	
float:right;	
color:#333;
font-size:12px;
}
.userd
{
color:#333;	
}
.red
{
background:#FFECF4;
padding:10px;	
}


#right
{
	
float:right;	
color:#333;
font-size:12px;
}
.userd
{
color:#333;	
}
.red
{
background:#F36;
padding:10px;	
}
.table
{
margin-bottom:10px;
background:#E6F4FF;	
}
.sep
{
height:30px;
background:#666;	
}

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #f8f9fa;
    }

    .welcome {
        margin: 0;
    }

    .date {
        margin: 0;
    }
	.datc{
		background-color: #225a62;
    border-radius: 5px;
    padding: 4px;
    color: #ffffff;
    font-size: 15px;
	}
</style>
       


        <div class="content" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="opacity: 0.7;">
                            <div class="header">
								<h4 class="welcome">Welcome <?php echo $_SESSION['name']; ?> !!!</h4>
								<p class="date datc" style="background-color:"><?php echo date("l, F j, Y"); ?></p>
							</div>
                            <div class="content all-icons">
                                <div class="row" style=" /*background-image: url(Bugs.jpg);*/ ">
                                           
                              <?php
							  if($_SESSION['user']=='admin')
							  {
							  ?>
                                <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../company/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>COMPANIES</h5>
										</div>
									</a>
                                </div>
								
								
								 
							 <?php
							  }
							  elseif($_SESSION['user']=='head')
							  {
							  ?>
							    <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../employee/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>EMPLOYEES</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../shift/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>SHIFT DETAILS</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../shift_assign/auto_shift.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>SHIFT ASSIGN</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../leave_application/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>LEAVE APPLICATION</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../shift_reassign/auto_shift.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>SHIFT REASSIGN</h5>
										</div>
									</a>
                                </div>
								
								
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../notification/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>NOTIFICATION</h5>
										</div>
									</a>
                                </div>


								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../leave_count/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>LEAVE COUNT</h5>
										</div>
									</a>
                                </div>
								
								
								
								
							  
							  
							  <?php
							  }elseif($_SESSION['user']=='company')
							  {
							  ?>
							  
							  <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../department/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>DEPARTMENTS</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../department_head/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>DEPARTMENT HEAD</h5>
										</div>
									</a>
                                </div>
							  
							  <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../employee/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>EMPLOYEES</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../leave_application/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>LEAVE APPLICATION</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../shift/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>SHIFT</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../shift_reassign/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>SHIFT REASSIGN</h5>
										</div>
									</a>
                                </div>
								
								<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" >
									<a href="../notification/select.php">    
										<div class="font-icon-detail" style="background-color: #223d44; color:white">
											<i class="pe-7s-user"></i>
											<h5>NOTIFICATION</h5>
										</div>
									</a>
                                </div>
							  
							  <?php
							  }
							  ?>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

	

</html>
