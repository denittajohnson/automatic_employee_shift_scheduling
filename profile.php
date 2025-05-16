<?php
include('header.php');
include('connection.php');

$sel=mysqli_query($con,"select * from employee where id='$_SESSION[uid]'");
$cc=mysqli_fetch_array($sel);

$sel1=mysqli_query($con,"select * from department where id='$cc[department]'");
$cc1=mysqli_fetch_array($sel1);

$sel2=mysqli_query($con,"select * from company where id='$cc1[cid]'");
$cc2=mysqli_fetch_array($sel2);


?>


	        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Profile</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12">
					<div class="section-title position-relative pb-3 mb-5">
						<h5 class="fw-bold text-primary text-uppercase">Employee Profile</h5>
						<h1 class="mb-0">View Employee Details</h1>
					</div>
					<p class="mb-4">Below are the details of the selected employee. You can review their information here.</p>
					<div class="row g-0 mb-3">
						<div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
							<h5 class="mb-3"><i class="fa fa-user text-primary me-3"></i><strong>Name:</strong> <?php echo $cc['name']?></h5>
							<h5 class="mb-3"><i class="fa fa-envelope text-primary me-3"></i><strong>Email:</strong> <?php echo $cc['email']?></h5>
							<h5 class="mb-3"><i class="fa fa-phone-alt text-primary me-3"></i><strong>Phone:</strong> <?php echo $cc['phone']?></h5>
						</div>
						<div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
							
							<h5 class="mb-3"><i class="fa fa-key text-primary me-3"></i><strong>Password:</strong> <?php echo $cc['password']?></h5>
							<h5 class="mb-3"><i class="fa fa-building text-primary me-3"></i><strong>Company Name:</strong> <?php echo $cc2['name']?></h5>
							<h5 class="mb-3"><i class="fa fa-building text-primary me-3"></i><strong>Department:</strong> <?php echo $cc1['department_name']?></h5>
						</div>
					</div>
					<a href="edit-profile.php" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Edit Profile</a>
				</div>

            </div>
        </div>
    </div>
    <!-- About End -->


 
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>