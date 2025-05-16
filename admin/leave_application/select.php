<?php
include("tables.php");
include("../header_inner.php");

$del_id=0;
$i=0;

?>


		<link rel="stylesheet" type="text/css" href="datatables.min.css">
 
		<script type="text/javascript" src="datatables.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').DataTable();
			} );
		</script>

<style>
.hiddentd
{
display:inline-block;
    width:180px;
    white-space: nowrap;
    overflow:hidden !important;
   
}
</style>


<div class="">
<?php
	echo "<center><h1>$titles</h1></center>";
	//echo "<div class='col-sm-2' style='float:right;margin-bottom:10px;'><form action='form.php' method='post'><input type='submit' name='view' value='Add New' class='form-control btn-danger'></form></div>";
	
?>
<div class="clearfix"></div>
<table id="example" class="table table-striped table-bordered dataTable no-footer" cellspacing="0"  role="grid" aria-describedby="example_info" >

       
        
            
          <?php
	
		  include("../connection.php");
		  

		  
		  
	
			//leave Accept
			if(isset($_REQUEST['a_id']))
			{
			$a_id=$_REQUEST['a_id'];
			mysqli_query($con,"update $table set status='approved' where id='$a_id'");
			
			$leave_query = "SELECT * FROM $table WHERE id='$a_id'";
			$leave_result = mysqli_query($con, $leave_query);
			$leave_details = mysqli_fetch_assoc($leave_result);
			
			// Calculate leave duration
			$start_date = $leave_details['start_date'];
			$end_date = $leave_details['end_date'];
			$employee_id = $leave_details['employee_id'];
			
			// Fetch department of the employee
			$dept_query = "SELECT department FROM employee WHERE id='$employee_id'";
			$dept_result = mysqli_query($con, $dept_query);
			$dept_row = mysqli_fetch_assoc($dept_result);
			$department_id = $dept_row['department'];
			
			// Fetch shifts for the employee during leave period
			$shifts_query = "
				SELECT es.*, s.max_employees 
				FROM employee_shifts es
				JOIN shift s ON es.shift_id = s.id
				WHERE es.employee_id = '$employee_id' 
				AND es.shift_date BETWEEN '$start_date' AND '$end_date'
			";
			echo "shifts_query".$shifts_query."---";
			$shifts_result = mysqli_query($con, $shifts_query);
			
			// Prepare assignments for insertion
			$assignments = [];
			
			// Process each shift during leave period
			while ($shift = mysqli_fetch_assoc($shifts_result)) {
				// Find eligible replacement employees
				
				//$rr="select * from employee_shifts where employee_id!='$employee_id' and shift_date = '{$shift['shift_date']}' limit " . $shift['max_employees'];
				
				$replacement_query = "SELECT es.* 
					   FROM employee_shifts es 
					   JOIN employee e ON es.employee_id = e.id and es.status='assigned'
					   WHERE e.department = '$department_id'
					   AND es.employee_id != '$employee_id'
					   AND es.shift_date = '{$shift['shift_date']}' AND es.shift_id!='{$shift['shift_id']}'
					   LIMIT 1"; 
				
				/*SELECT es.*
				FROM employee_shifts es
				JOIN employee e ON es.employee_id = e.id
				WHERE e.department = 3;*/;
				
				
				//echo "<br>".$replacement_query."rr<br>";
				
				
				$replacements = mysqli_query($con, $replacement_query);

				// Distribute shifts
				$replacement_count = 0;
				while ($replacement = mysqli_fetch_assoc($replacements) AND $replacement_count < $shift['max_employees']) {
					// Prepare shift reassignment record
					$assignments[] = "
						('{$replacement['employee_id']}', 
						 '{$shift['shift_id']}', 
						 '{$shift['shift_date']}', 
						 '{$_SESSION['uid']}', 
						 'reassigned')
					";
					
					$emp=$replacement['employee_id'];

					// Prepare shift reassign tracking record
					$tracking_query = "
						INSERT INTO shift_reassign (
							shift_id, 
							original_employee_id, 
							reassigned_employee_id, 
							shift_date, 
							status, 
							st
						) VALUES (
							'{$shift['shift_id']}',
							'$employee_id',
							'{$replacement['employee_id']}',
							'{$shift['shift_date']}',
							'assigned',
							NOW()
						)
					";
					mysqli_query($con, $tracking_query);

					$replacement_count++;
				}

				// Mark original shifts as reassigned
				$update_original_query = "
					UPDATE employee_shifts 
					SET status = 'reassigned' 
					WHERE employee_id = '$employee_id' 
					AND shift_id = '{$shift['shift_id']}' 
					AND shift_date = '{$shift['shift_date']}'
				";
				mysqli_query($con, $update_original_query);
				
				//echo print_r($replacement);

			
				 // email reassigned schedules to employee          
				$employee_query = "
					SELECT e.name 
					FROM employee e 
					WHERE e.id = '$emp'
				";
				
				$employee_result = mysqli_query($con, $employee_query);
				$ss = mysqli_fetch_assoc($employee_result);

				// Fetch original employee details
				$original_employee_query = "
					SELECT employee_id 
					FROM shift_reassign 
					WHERE shift_id = '{$shift['shift_id']}' 
					AND shift_date = '{$shift['shift_date']}'
				";
				$original_employee_result = mysqli_query($con, $original_employee_query);
				$row332 = mysqli_fetch_assoc($original_employee_result);

				
				//echo $employee_query;
				//echo $original_employee_query;
				
				
				$subject = "Welcome to Smartshift";
				$title = "Shift Reschedule";
				$msg = "Dear $ss[name],\n\n"
					 . "Greetings from Smartshift! We are pleased to inform you that an extra shift is added on {$shift['shift_date']}.\n\n"
					 . "Here are shift details:\n"
					 . "Shift Date: {$rowN['shift_date']}\n"
					 . "Original Employee: {$row332['employee_id']}\n\n"
					 . "Best regards,\n"
					 . "The Smartshift Team";
				
				
				
				include('mail.php');
				
				
			}
			
			}
			
			if(isset($_REQUEST['r_id']))
			{
			$r_id=$_REQUEST['r_id'];
			mysqli_query($con,"update $table set status='rejected' where id='$r_id'");

			}
	
	
	
	
	
if(isset($_REQUEST['del_id']))
{
$del_id=$_REQUEST['del_id'];
mysqli_query($con,"delete from $table where id='$del_id'");
//if($del_id!="")
}
	?>
    <script>


function rem()
{
if(confirm('Are you sure you want to delete this record?')){
return true;
}
else
{
return false;
}
}


function rem2()
{
if(confirm('Are you sure you want to deactive this record?')){
return true;
}
else
{
return false;
}
}
</script>
    
	
	<?php


	
	
	

	
	
		  $result2 = mysqli_query($con,"SHOW FIELDS FROM $table");

 echo "<thead><tr>";

while ($row2 = mysqli_fetch_array($result2))
 {

  $name=$row2['Field'];

  echo "<th>".
  str_replace('_', ' ', $name)
  ."</th>";
 $i++;
 }
 echo "
<th>Action</th> 
 </tr></thead>";
   
  // $i=0;
   echo "<tbody>";
   
            
            
	if($_SESSION['user']=='company')
	{
 		$result = mysqli_query($con,"SELECT la.* FROM leave_application la JOIN employee e ON la.employee_id = e.id JOIN department d ON e.department = d.id WHERE d.cid = '$_SESSION[uid]'");
	}else{
		$result = mysqli_query($con,"SELECT * FROM $table ");	
	}
	
	

		while($row = mysqli_fetch_array($result))
		{
		$id=$row['0'];
		echo "<tr>";
		for($k=0;$k<$i;$k++)
		{
	
			
			if($k==1)
			{
			  $sql2 = "select *  from employee where id='$row[$k]' ";
    $result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
$row2 =mysqli_fetch_array($result2);
		
		

			echo "<td >  $row2[name]</td>";
				
			}
			elseif($k==2)
			{
			  $sql2 = "select *  from leave_tbl where id='$row[$k]' ";
    $result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
$row2 =mysqli_fetch_array($result2);
		
		

			echo "<td >  $row2[leave_type]</td>";
				
			}
			
				
			elseif($k==31)
			{
				

			echo "<td class='hiddentd'> $row[content] </td>";
				
			}
			
			
				elseif($k==40)
			{
			  

			echo "<td > <img src='uploads/$row[$k]' width='100'></td>";
				
			}
			
			else
			{
			echo "<td >$row[$k]</td>";
			}
		
		
		
		
		
		}
		
		
		
		
			if($row['status']=='Pending')
			{
			echo "
			
			<td>
				<a href='?a_id=$id&e=$row[employee_id]' class='btn btn-success'>Accept</a>
				<a href='?r_id=$id' class='btn btn-danger' onclick='return rem()'>Reject</a>
			</td>";
			}
			else{
				echo "<td></td>";
			}
		
			echo"</tr>";
		
		
		
		}
        
        ?>
        </tbody>
    </table>
			
		



<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>

<div class="clearfix"></div>
	
    </div> 
    <?php
	
//	include("../footer_inner.php");
	?>