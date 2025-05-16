<?php
include('header.php');
?>


    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Login to continue</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    
					<?php
						error_reporting(0);
						if($_REQUEST['st']=="fail")
						{
							echo "<center><p style='color:red'>invalid username or password !!!</p></center>";
						}
						?>
					
					<form method="POST" action="redirect.php">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <input type="email" class="form-control border-0 bg-light px-4" name="email" placeholder="Email" style="height: 55px;">
                            </div>
                            <div class="col-md-12">
                                <input type="password" class="form-control border-0 bg-light px-4" name="password" placeholder="Password" style="height: 55px;">
                            </div>
							<div class="col-12">
								<select class="form-control border-0 bg-light px-4" name="type" style="height: 55px;" required>
									<option value="" disabled selected>Select Type</option>
									<option value="admin">Admin</option>
									<option value="company">Company</option>
									<option value="head">Department Head</option>
									<option value="employee">Employee</option>
								</select>
							</div>
                            <a href="forgot.php" style="margin-left:440px">Forgot Password</a>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="login" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
					<br>
					<a href="loginface.php"class='btn btn-primary'>Login with face</a>
					<br>
					<center>Don't have an account?<a href="register.php"> Register as Employee</a></center>
                </div>
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
						<img class="position-absolute rounded wow zoomIn" style="width: 450px !important; border:0;" data-wow-delay="0.9s" src="img/login.jpg" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


	
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>