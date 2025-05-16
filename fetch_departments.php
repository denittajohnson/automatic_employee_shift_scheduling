<?php
include('connection.php');

if (isset($_POST['company_id'])) {
    $company_id = $_POST['company_id'];
    $query = "SELECT * FROM department WHERE cid = '$company_id'";
    $result = mysqli_query($con, $query);

    echo '<option value="" disabled selected>Select Department</option>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value="'.$row['id'].'">'.$row['department_name'].'</option>';
    }
}
?>
