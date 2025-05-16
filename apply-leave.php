<?php
include('header.php');
include('connection.php');



$s=mysqli_query($con,"select * from employee where id ='$_SESSION[uid]'");
$cc=mysqli_fetch_array($s);
$leave_type=mysqli_query($con,"select * from leave_tbl where department='$cc[department]'");

//echo "select * from leave_tbl where department='$cc[department]'";

//echo "select * from employee where id ='$_SESSION[uid]";



if (isset($_POST['apply_leave'])) {
    $employee_id = $_SESSION['uid'];
    $leave_type = mysqli_real_escape_string($con, $_POST['leave_type']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $status = 'Pending'; // Default status

    $query = "INSERT INTO leave_application (employee_id, leave_type, start_date, end_date, status) 
              VALUES ('$employee_id', '$leave_type', '$start_date', '$end_date', '$status')";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Leave application submitted successfully!'); window.location='view_leave.php';</script>";
    } else {
        echo "<script>alert('Error applying for leave.');</script>";
    }
}
?>

<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn">Apply Leave</h1>
        </div>
    </div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Leave Application</h5>
                    <h1 class="mb-0">Submit Your Leave Request</h1>
                </div>
                <p class="mb-4">Fill in the details below to apply for leave.</p>
                <form method="POST">
                        <div class="col-md-12">
                            <label>Leave Type</label>
                            <select class="form-control border-0 bg-light px-4" name="leave_type" style="height: 55px;" required>
                            <option value="">Select Leave Type</option>
                            <?php
                            
                            while($ltype=mysqli_fetch_array($leave_type))
                            {

                            ?>
                                <option value="<?php echo $ltype['id']; ?>"> <?php echo $ltype['leave_type']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Start Date</label>
							<input type="date" class="form-control border-0 bg-light px-4" name="start_date" required style="height: 55px;" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+6 days')); ?>">
                        </div>
                        <div class="col-md-12">
                            <label>End Date</label>
							<input type="date" class="form-control border-0 bg-light px-4" name="end_date" required style="height: 55px;" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+6 days')); ?>">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" name="apply_leave" type="submit">Apply Leave</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
