<?php
include("../connection.php");

$emp = '1';
$start = '2025-03-24';
$end = '2025-03-24';

// Current shift of employee
$sel = "SELECT * FROM employee_shifts 
        WHERE employee_id='$emp' 
        AND shift_date BETWEEN '$start' AND '$end' 
        AND status='approved'";
		echo $sel;

$res = mysqli_query($con, $sel);

if (!$res) {
    die("Query Failed: " . mysqli_error($con));
}

// Check if shift exists
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "Shift ID: " . $row['shift_id'] . "<br>";
    }
} else {
    echo "No shift found for the given date range.";
}
?>
