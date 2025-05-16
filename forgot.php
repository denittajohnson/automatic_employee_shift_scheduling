<?php
include('header.php');
?>


    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="height:700px;">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Forgot Password</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                   
					
					<form method="POST" >
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label>Enter Your Valid Email</label>
                                <input type="email" class="form-control border-0 bg-light px-4" name="email" placeholder="Email" style="height: 55px;">
                            </div>                           <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="login" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
					<br>
                </div>
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
						<img class="position-absolute rounded wow zoomIn" style="width: 450px !important; border:0;" data-wow-delay="0.9s" src="img/login.jpg" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php 
include('connection.php');
if(isset($_POST['login']))
{
	
	$email=$_POST['email'];
	$sel="select * from employee where email='$_POST[email]'";
    $rows=mysqli_num_rows($sel);
	$result = mysqli_query($con,$sel) or die(mysql_error());
	$row=mysqli_fetch_array($result);
    if($rows>0)
    {
        $subject="Password Reset";
        $title="Your Password";
        $msg="Greetings from SmartShift. \n Your Email id is: $row[email] \n Your password is: $row[password] \n Please login and reset your credentails. \n";
        include('mail.php');
    }
    else{
        $email=$_POST['email'];
        $sel1="select * from company where email='$_POST[email]'";
        $result1 = mysqli_query($con,$sel1) or die(mysql_error());
        $row1=mysqli_fetch_array($result1);


        $subject="Password Reset";
        $title="Your Password";
        $msg="Greetings from SmartShift. \n Your Email id is: $row1[email] \n Your password is: $row1[password] \n Please login and reset your credentails. \n";
        include('mail.php');
    }
	
	
}

?>
	
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>