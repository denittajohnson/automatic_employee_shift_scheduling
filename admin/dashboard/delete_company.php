<?php
  session_start();
  include("../connection.php");

  $company_id = mysqli_real_escape_string($con, $_SESSION['uid']);

  //delete employees
  mysqli_query($con, "DELETE FROM employee WHERE department IN (SELECT id FROM department WHERE cid = '$company_id')");

  //delete department heads
  mysqli_query($con, "DELETE FROM department_head WHERE department_id IN (SELECT id FROM department WHERE cid = '$company_id')");

  //delete shift
  mysqli_query($con, "DELETE FROM shift WHERE department_id IN (SELECT id FROM department WHERE cid = '$company_id')");

  //delte shift_reassign
  mysqli_query($con, "DELETE FROM shift_reassign WHERE shift_id IN (SELECT id FROM shift WHERE department_id IN (SELECT id FROM department WHERE cid = '$company_id'))");

  //delete departments
  mysqli_query($con, "DELETE FROM department WHERE cid = '$company_id'");

  //company
  $delete_company = mysqli_query($con, "DELETE FROM company WHERE id = '$company_id'");

  if($delete_company)
  {
    session_destroy();
    header('location:../../logout.php');
  }
  else{
    header('location:dashboard.php?d=1');
  }



  ?>