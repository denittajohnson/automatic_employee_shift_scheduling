<?php
include('header.php');
?>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Register</h1>
                    <a href="" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="" class="h5 text-white">Register</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Register</h5>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form method="POST">
						<div class="row g-3">
							<div class="col-md-6">
								<input type="text" class="form-control border-0 bg-light px-4" name="name" placeholder="Your Name" style="height: 55px;" required>
							</div>
							<div class="col-md-6">
								<input type="email" class="form-control border-0 bg-light px-4" name="email" placeholder="Your Email" style="height: 55px;" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control border-0 bg-light px-4" name="phone" placeholder="Your Phone" style="height: 55px;" required>
							</div>
							<div class="col-md-6">
								<input type="password" class="form-control border-0 bg-light px-4" name="password" placeholder="Password" style="height: 55px;" required>
							</div>
							<div class="col-6">
								<select class="form-control border-0 bg-light px-4" name="company" id="company" style="height: 55px;" required>
									<option value="" disabled selected>Select Company</option>
									<?php 
									include('connection.php');
									$sel = mysqli_query($con, "SELECT * FROM company where status='accepted'");
									while ($row = mysqli_fetch_array($sel)) {
									?>
										<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="col-6">
								<select class="form-control border-0 bg-light px-4" name="department" id="department" style="height: 55px;" required>
									<option value="" disabled selected>Select Department</option>
								</select>
							</div>
							<div class="col-12">
								<button class="btn btn-primary w-100 py-3" name="submit" type="submit">Register</button>
							</div>
						</div>
					</form><br>
					<center>Already have an account?<a href="login.php"> Login Now</a></center>
                </div>
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                    <img class="position-absolute rounded wow zoomIn" style="width: 450px !important; border:0;" data-wow-delay="0.9s" src="img/login.jpg" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

<?php
if(isset($_POST['submit']))
{
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $department = mysqli_real_escape_string($con, $_POST['department']);

    // Inserting data into `employee` table with `department` included
    $ins = "INSERT INTO `employee`(`name`, `email`, `phone`, `password`, `department`,status) 
            VALUES('$name','$email','$phone','$password','$department','pending')";
    //echo "aaa".$ins;
    $res = mysqli_query($con, $ins);
	
    
    if($res)
    {
        $id=mysqli_insert_id($con);
		
		$myfile = fopen("userid.txt", "w") or die("Unable to open file!");
		$txt = $id;
		fwrite($myfile, $txt);
		fclose($myfile);
		
		$crt =`python create_db.py`;
		$crt1 =`python train_db.py`;
		echo '<script>alert("Successfully Registered!"); window.location="login.php";</script>';
    }
    else
    {
        echo '<script>alert("Registration Failed!");</script>';
    }
}
?>
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>



<script>
$(document).ready(function(){
    $("#company").change(function(){
        var company_id = $(this).val();
        $.ajax({
            url: "fetch_departments.php",
            method: "POST",
            data: { company_id: company_id },
            success: function(data){
                $("#department").html(data);
            }
        });
    });
});
</script>