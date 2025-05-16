<?php
// Database connection
session_start();
include("../connection.php");

// Get upcoming week's Monday date
$today = date('Y-m-d');
$next_monday = date('Y-m-d', strtotime('next monday'));
$next_sunday = date('Y-m-d', strtotime($next_monday . " +6 days"));

// Check if shifts are already assigned for the upcoming week
$check_query = "SELECT COUNT(*) as count FROM employee_shifts WHERE shift_date BETWEEN '$next_monday' AND '$next_sunday'";
$result = mysqli_query($con, $check_query);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    echo "<script>
		//alert('Shifts for the upcoming week ($next_monday to $next_sunday) are already assigned.'); 
		window.location.href = 'select.php';</script>";
    exit;
}

// Fetch all employees
$employees = [];
$result = mysqli_query($con, "SELECT id FROM employee where department='$_SESSION[did]' and status='accepted'");
while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row['id'];
}

// Check if there are employees
if (empty($employees)) {
    die("No employees found.");
}

// Fetch shift details
$shifts = [];
$result = mysqli_query($con, "SELECT id, max_employees FROM shift ORDER BY id");
while ($row = mysqli_fetch_assoc($result)) {
    $shifts[] = $row;
}

// Check if there are shifts
if (empty($shifts)) {
    die("No shifts found.");
}

// Assign shifts from Monday to Sunday
$assignments = [];
$employee_index = 0;
$total_employees = count($employees);

for ($day = 0; $day < 7; $day++) { // Loop through Monday to Sunday
    $shift_date = date('Y-m-d', strtotime($next_monday . " +$day days"));

    foreach ($shifts as $shift) {
        $shift_id = $shift['id'];
        $max_employees = $shift['max_employees'];

        for ($i = 0; $i < $max_employees; $i++) {
            if ($employee_index >= $total_employees) $employee_index = 0; // Reset round-robin

            $employee_id = $employees[$employee_index];
            $assigned_by = $_SESSION['uid']; // Assuming session stores the department head ID
            $status = 'assigned'; // Allow department head to review

            $assignments[] = "('$employee_id', '$shift_id', '$shift_date', '$assigned_by', '$status')";
            $employee_index++;
        }
    }
}

// Insert shift assignments into database
if (!empty($assignments)) {
    $query = "INSERT INTO employee_shifts (employee_id, shift_id, shift_date, assigned_by, status) VALUES " . implode(", ", $assignments);
    
    if (mysqli_query($con, $query)) {
        //echo "Shift scheduling completed for the upcoming week.";
		echo "<script>
		//alert('Shift scheduling completed for the upcoming week.'); 
		window.location.href = 'select.php';</script>";
    exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "No shifts assigned.";
}

// Close connection
mysqli_close($con);
?>
