<?php
/*
session_start(); // Start the session
include("connection.php");

$uid = $_SESSION['uid']; // 
$date = $_GET['date'];


$query = "SELECT e.shift_date, s.shift_name, dh.name AS assigned_by_name, e.status 
          FROM employee_shifts e
          JOIN shift s ON e.shift_id = s.id
          JOIN department_head dh ON e.assigned_by = dh.id  
          WHERE e.employee_id = '$uid' AND e.shift_date = '$date'"; 		  
		  
		  //echo $query;

$result = mysqli_query($con, $query);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $colorClass = ($row['shift_name'] == 'Morning') ? 'morning' : (($row['shift_name'] == 'Noon') ? 'noon' : 'night');

    $events[] = [
        'title' => $row['shift_name'],
        'start' => $row['shift_date'],
        'extendedProps' => [
            'shift_name' => $row['shift_name'],
            'assigned_by' => $row['assigned_by_name'],
            'status' => $row['status']
        ],
        'classNames' => [$colorClass] // Add color class
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
*/


session_start();
include("connection.php");

$uid = $_SESSION['uid']; 
$date1 = $_REQUEST['date'];
$date = date("Y-m-d", strtotime($date1));

$query = "SELECT e.shift_date, s.shift_name, dh.name AS assigned_by_name, e.status, 'normal' AS shift_type
          FROM employee_shifts e
          JOIN shift s ON e.shift_id = s.id
          JOIN department_head dh ON e.assigned_by = dh.id  
          WHERE e.employee_id = '$uid' AND e.shift_date = '$date'
          
          UNION ALL 

          SELECT r.shift_date, s.shift_name, dh.name AS assigned_by_name, r.status, 'reassigned' AS shift_type
          FROM shift_reassign r
          JOIN shift s ON r.shift_id = s.id
          JOIN department_head dh ON r.original_employee_id = dh.id  
          WHERE r.reassigned_employee_id = '$uid' AND r.shift_date = '$date'";
		  
		 //echo $query;

$result = mysqli_query($con, $query);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Determine color class based on shift type
    $colorClass = ($row['shift_name'] == 'Morning') ? 'morning' : 
                 (($row['shift_name'] == 'Noon') ? 'noon' : 'night');

    $events[] = [
        'title' => $row['shift_name'],
        'start' => $row['shift_date'],
        'extendedProps' => [
            'shift_name' => $row['shift_name'],
            'assigned_by' => $row['assigned_by_name'],
            'status' => $row['status'],
            'shift_type' => $row['shift_type']  // Added shift type to differentiate
        ],
        'classNames' => [$colorClass] // Add color class for styling
    ];
}

header('Content-Type: application/json');
echo json_encode($events);


?>
