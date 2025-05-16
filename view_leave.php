<?php
include('header.php');
include('connection.php');

$sel=mysqli_query($con,"select * from employee where id='$_SESSION[uid]'");
$cc=mysqli_fetch_array($sel);

$sel1=mysqli_query($con,"select * from department where id='$cc[department]'");
$cc1=mysqli_fetch_array($sel1);

?>


	        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Leave Application</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

	    <!-- About Start -->
		<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
						<h5 class="fw-bold text-primary text-uppercase">Leave Application</h5>
						<h1 class="mb-0">View Leave Applications</h1>
                    </div>
					<p class="mb-4">Below are the details of the selected employee. You can review their information here.</p>
					<a href="apply-leave.php" class="btn btn-danger py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Apply Leave</a>
					<br><br>
					<div class="row g-0 mb-3">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Leave Type</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$leave_query = mysqli_query($con, "SELECT * FROM leave_application WHERE employee_id='$_SESSION[uid]'");
									$i=1;
									while ($leave = mysqli_fetch_assoc($leave_query)) { 
										$lt=mysqli_query($con,"select * from leave_tbl where id ='$leave[leave_type]'");
										$lt_row=mysqli_fetch_array($lt);
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $lt_row['leave_type']; ?></td>
									<td><?php echo $leave['start_date']; ?></td>
									<td><?php echo $leave['end_date']; ?></td>
									<td><?php echo $leave['status']; ?></td>
								</tr>
								<?php 
								$i++;
								} ?>
							</tbody>
						</table>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-15" style="    background-color: antiquewhite; border-radius:10px; padding:10px;">
						<?php
						$employeeId=$_SESSION['uid'];
						//$employeeId=3;

						// Get employee department
						$deptQuery = "SELECT department FROM employee WHERE id = $employeeId";
						//echo $deptQuery;
						$deptResult = $con->query($deptQuery);

						if ($deptResult->num_rows > 0) {
							$row = $deptResult->fetch_assoc();
							$department = $row['department'];
							
							// Get all leave types with their IDs and allowed count for this department
							$leaveTypesQuery = "SELECT id, leave_type, leave_count FROM leave_tbl WHERE department = '$department'";
							$leaveTypesResult = $con->query($leaveTypesQuery);
							
							echo '<table class="table" style="    font-size: 15px;">';
							echo '<thead>';
							echo '<tr>';
							echo '<th>Leave Type</th>';
							echo '<th>Total Leaves</th>';
							echo '<th>Used Leaves</th>';
							echo '<th>Remaining Leaves</th>';
							echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							
							while ($leaveType = $leaveTypesResult->fetch_assoc()) {
								$typeId = $leaveType['id'];
								$typeName = $leaveType['leave_type'];
								$total = $leaveType['leave_count'];
								
								// Calculate used leaves using the ID instead of name
								$usedQuery = "SELECT SUM(DATEDIFF(end_date, start_date) + 1) AS days_used 
											FROM leave_application 
											WHERE employee_id = $employeeId 
											AND leave_type = '$typeId' 
											AND status = 'approved'";
											//echo $usedQuery;
								
								$usedResult = $con->query($usedQuery);
								$usedRow = $usedResult->fetch_assoc();
								$used = $usedRow['days_used'] ?: 0;
								
								// Calculate remaining leaves
								$remaining = $total - $used;
								
								// Output table row
								echo '<tr>';
								echo '<td>' . ucfirst($typeName) . '</td>';
								echo '<td>' . $total . '</td>';
								echo '<td>' . $used . '</td>';
								echo '<td>' . $remaining . '</td>';
								echo '</tr>';
							}
							
							echo '</tbody>';
							echo '</table>';
						} else {
							echo "<p>Employee not found!</p>";
						}


						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- About Start -->
    <!--div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12">
					<div class="section-title position-relative pb-3 mb-5">
						<h5 class="fw-bold text-primary text-uppercase">Leave Application</h5>
						<h1 class="mb-0">View Leave Applications</h1>
					</div>
					<p class="mb-4">Below are the details of the selected employee. You can review their information here.</p>
					<a href="apply-leave.php" class="btn btn-danger py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Apply Leave</a>
					<br><br>

					

					
				</div>

            </div>
        </div>
    </div>
    <!-- About End -->


 
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>