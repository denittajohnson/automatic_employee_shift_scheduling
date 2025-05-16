<?php
include('header.php');
include('connection.php');

$sel=mysqli_query($con,"select * from employee where id='$_SESSION[uid]'");
$cc=mysqli_fetch_array($sel);

$departments = mysqli_query($con, "SELECT * FROM department");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $department_id = mysqli_real_escape_string($con, $_POST['department']);

    // Update employee details in the database
    $update_query = "UPDATE employee 
                     SET name='$name', email='$email', phone='$phone', password='$password', department='$department_id' 
                     WHERE id='$_SESSION[uid]'";
	
	echo $update_query;

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Profile updated successfully!');</script>";
        echo "<script>window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile. Please try again.');</script>";
    }
}
?>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Profile Edit</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->



    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $cc['name']?>" class="form-control border-0 bg-light px-4" name="email" placeholder="Name" style="height: 55px;">
                            </div>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $cc['email']?>" class="form-control border-0 bg-light px-4" name="email" placeholder="Password" style="height: 55px;">
                            </div>
							<div class="col-md-12">
                                <input type="text" value="<?php echo $cc['phone']?>" class="form-control border-0 bg-light px-4" name="phone" placeholder="Phone" style="height: 55px;">
                            </div>
							<div class="col-md-12">
                                <input type="text" value="<?php echo $cc['password']?>" class="form-control border-0 bg-light px-4" name="password" placeholder="Password" style="height: 55px;">
                            </div>
							<!-- Department Dropdown -->
							<div class="col-md-12">
								<select class="form-control border-0 bg-light px-4" 
										name="department" style="height: 55px;" required>
									<option value="">Select Department</option>
									<?php
									while ($dept = mysqli_fetch_assoc($departments)) {
										$selected = $cc['department'] == $dept['id'] ? 'selected' : '';
										echo "<option value='{$dept['id']}' $selected>{$dept['department_name']}</option>";
									}
									?>
								</select>
							</div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="update" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


	
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>