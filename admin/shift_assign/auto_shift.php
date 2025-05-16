<?php
/*

// Database connection
session_start();
include("../connection.php");

// Get current date and week end date
$today = date('Y-m-d');
$week_end = date('Y-m-d', strtotime($today . " +6 days"));

// Fetch shift details with max employees from the shift table
$shifts = [];
$result = mysqli_query($con, "
    SELECT 
        id, 
        shift_name,
        start_time,
        end_time,
        max_employees,
        department_id
    FROM 
        shift 
    WHERE 
        department_id = '$_SESSION[did]'
    ORDER BY 
        id
");

while ($row = mysqli_fetch_assoc($result)) {
    $shifts[$row['id']] = $row;  // Store shift details indexed by shift_id
}

// Fetch all employees
$employees = [];
$result = mysqli_query($con, "SELECT id FROM employee WHERE department='$_SESSION[did]' AND status='accepted'");
while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row['id'];
}

// Fetch current shift assignments
$current_assignments = [];
$result = mysqli_query($con, "
    SELECT employee_id, shift_id, shift_date 
    FROM employee_shifts 
    WHERE shift_date BETWEEN '$today' AND '$week_end'
");

while ($row = mysqli_fetch_assoc($result)) {
    $shift_id = $row['shift_id'];
    $shift_date = $row['shift_date'];
    
    if (!isset($current_assignments[$shift_date])) {
        $current_assignments[$shift_date] = [];
    }
    
    if (!isset($current_assignments[$shift_date][$shift_id])) {
        $current_assignments[$shift_date][$shift_id] = [];
    }

    $current_assignments[$shift_date][$shift_id][] = $row['employee_id'];
}

// Assign shifts dynamically while ensuring one shift per day per employee
$assignments = [];
$employee_shift_tracker = []; // Track employee shifts per day

for ($day = 0; $day < 7; $day++) { // Loop through 7 days
    $shift_date = date('Y-m-d', strtotime($today . " +$day days"));

    // Track employees already assigned on this date
    if (!isset($employee_shift_tracker[$shift_date])) {
        $employee_shift_tracker[$shift_date] = [];
    }

    // Randomize employee order for fair distribution
    $employee_cycle = $employees;
    shuffle($employee_cycle);
    
    foreach ($shifts as $shift_id => $shift) {
        $required_employees = $shift['max_employees'];
        $existing_employees = isset($current_assignments[$shift_date][$shift_id]) ? count($current_assignments[$shift_date][$shift_id]) : 0;
        
        // If already assigned employees match the required count, continue
        if ($existing_employees >= $required_employees) {
            continue;
        }

        $additional_needed = $required_employees - $existing_employees;
        $assigned_count = 0;

        foreach ($employee_cycle as $employee_id) {
            if ($assigned_count >= $additional_needed) break;

            // Check if the employee is already assigned a shift on this day
            if (in_array($employee_id, $employee_shift_tracker[$shift_date])) {
                continue; // Skip if already assigned to another shift
            }

            // Ensure the employee is not already assigned to this shift
            if (!in_array($employee_id, isset($current_assignments[$shift_date][$shift_id]) ? $current_assignments[$shift_date][$shift_id] : [])) {
                $assigned_by = $_SESSION['uid'];
                $status = 'assigned';

                $assignments[] = "('$employee_id', '$shift_id', '$shift_date', '$assigned_by', '$status')";

                // Track that the employee has been assigned a shift for this date
                $employee_shift_tracker[$shift_date][] = $employee_id;

                if (!isset($current_assignments[$shift_date][$shift_id])) {
                    $current_assignments[$shift_date][$shift_id] = [];
                }
                
                $current_assignments[$shift_date][$shift_id][] = $employee_id;
                $assigned_count++;
            }
        }
    }
}

// Insert additional shift assignments into `employee_shifts` table
if (!empty($assignments)) {
    $query = "INSERT INTO employee_shifts (employee_id, shift_id, shift_date, assigned_by, status) VALUES " . implode(", ", $assignments);

    if (mysqli_query($con, $query)) {
        echo "<script>window.location.href = 'select.php?id=1';</script>";
    } else {
        echo "Error updating assignments: " . mysqli_error($con);
    }
} else {
    echo "<script>window.location.href = 'select.php?id=2';</script>";
}

*/




// Database connection
session_start();
include("../connection.php");

// Get current date and week end date
$today = date('2025-04-09');
$week_end = date('Y-m-d', strtotime($today . " +6 days"));

// Fetch shift details (id, max_employees, department)
$shifts = [];
$result = mysqli_query($con, "
    SELECT 
        id, 
        shift_name,
        start_time,
        end_time,
        max_employees,
        department_id
    FROM 
        shift 
    WHERE 
        department_id = '$_SESSION[did]'
    ORDER BY 
        id
");

while ($row = mysqli_fetch_assoc($result)) {
    $shifts[$row['id']] = $row; // Store shift details indexed by shift_id
}

// Fetch all employees
$employees = [];
$result = mysqli_query($con, "SELECT id FROM employee WHERE department='$_SESSION[did]' AND status='accepted'");
while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row['id'];
}

// Fetch current shift assignments
$current_assignments = [];
$result = mysqli_query($con, "
    SELECT employee_id, shift_id, shift_date 
    FROM employee_shifts 
    WHERE shift_date BETWEEN '$today' AND '$week_end'
");

while ($row = mysqli_fetch_assoc($result)) {
    $shift_id = $row['shift_id'];
    $shift_date = $row['shift_date'];
    
    if (!isset($current_assignments[$shift_date])) {
        $current_assignments[$shift_date] = [];
    }
    
    if (!isset($current_assignments[$shift_date][$shift_id])) {
        $current_assignments[$shift_date][$shift_id] = [];
    }

    $current_assignments[$shift_date][$shift_id][] = $row['employee_id'];
}

// Assign shifts dynamically while ensuring only one shift per employee per day
$assignments = [];
$employee_shift_tracker = []; // Track employee shifts per day

for ($day = 0; $day < 7; $day++) { // Loop through 7 days
    $shift_date = date('Y-m-d', strtotime($today . " +$day days"));

    // Track employees already assigned on this date
    if (!isset($employee_shift_tracker[$shift_date])) {
        $employee_shift_tracker[$shift_date] = [];
    }

    // Shuffle employees for fair distribution
    shuffle($employees);
    
    foreach ($shifts as $shift_id => $shift) {
        $required_employees = $shift['max_employees'];
        $existing_employees = isset($current_assignments[$shift_date][$shift_id]) ? count($current_assignments[$shift_date][$shift_id]) : 0;

        if ($existing_employees == $required_employees) {
            continue; // Shift already has required employees
        }

        $needed_employees = $required_employees - $existing_employees;

        // **Adjustments for shift updates**
        if ($needed_employees > 0) {
            // Add new employees if shift count increased
            foreach ($employees as $employee_id) {
                if ($needed_employees == 0) break;

                // Ensure the employee has not been assigned another shift that day
                if (in_array($employee_id, $employee_shift_tracker[$shift_date])) {
                    continue;
                }

                // Insert assignment
                $assignments[] = "('$employee_id', '$shift_id', '$shift_date', '$_SESSION[uid]', 'assigned')";

                // Track employee shift assignment
                $employee_shift_tracker[$shift_date][] = $employee_id;
                $current_assignments[$shift_date][$shift_id][] = $employee_id;

                $needed_employees--;
            }
        } elseif ($needed_employees < 0) {
            // Remove excess employees if shift count decreased
            $remove_count = abs($needed_employees);
            $to_remove = array_slice($current_assignments[$shift_date][$shift_id], 0, $remove_count);

            foreach ($to_remove as $emp) {
                mysqli_query($con, "
                    DELETE FROM employee_shifts 
                    WHERE employee_id = '$emp' AND shift_id = '$shift_id' AND shift_date = '$shift_date'
                ");
            }
        }
    }
}

// Insert new shift assignments into `employee_shifts`
if (!empty($assignments)) {
    $query = "INSERT INTO employee_shifts (employee_id, shift_id, shift_date, assigned_by, status) VALUES " . implode(", ", $assignments);
    mysqli_query($con, $query);
}

// Redirect
echo "<script>window.location.href = 'select.php?id=1';</script>";
?>

