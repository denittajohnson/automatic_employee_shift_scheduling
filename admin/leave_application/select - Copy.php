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
			
			           
         
			$result33 = mysqli_query($con,"SELECT * FROM $table  where id='$a_id' ");

			$row33= mysqli_fetch_array($result33);
			
			$date1=date_create($row33['start_date']);
			$date2=date_create($row33['end_date']);
			$diff=date_diff($date1,$date2);
			
			$df=($diff->days + 1);
			
			//echo"difff:-".($diff->days + 1)."<br>";
			echo"difff:-".$df."<br>";
			
			//echo "SELECT * FROM employee_shifts  where employee_id='$row33[employee_id]' and shift_date BETWEEN '$row33[start_date]' AND '$row33[end_date]'  "."<br>";
			$result332 = mysqli_query($con,"SELECT * FROM employee_shifts  where employee_id='$row33[employee_id]' and shift_date BETWEEN '$row33[start_date]' AND '$row33[end_date]'  ");

			while($row332= mysqli_fetch_array($result332))
			{
			
			echo "leave employee -- ".$row332['employee_id']."-".$row332['shift_id']."-".$row332['shift_date']."-".$row332['status'];
			
			//echo "SELECT * FROM employee_shifts  where employee_id!='$row33[employee_id]' and shift_date='$row332[shift_date]' and shift_id!='$row332[shift_id]' ORDER BY RAND() LIMIT $df";
			$resultN = mysqli_query($con,"SELECT * FROM employee_shifts  where employee_id!='$row33[employee_id]' and shift_date='$row332[shift_date]' and shift_id!='$row332[shift_id]' and status!='reassigned' ORDER BY RAND() LIMIT $df");
			$rowN= mysqli_fetch_array($resultN);

			echo "<br>".$rowN['employee_id']."-".$rowN['shift_id']."-".$rowN['shift_date']."-".$rowN['status'];
			
			
			$ins="insert into shift_reassign(shift_id, original_employee_id, reassigned_employee_id, shift_date,status) 
					values('$row332[shift_id]','$row332[employee_id]','$rowN[employee_id]','$rowN[shift_date]','assigned')";
					
					
			mysqli_query($con,$ins);
			
			$up=mysqli_query($con,"update employee_shifts set status='reassigned' where id='$row332[id]' ");
			
			$s=mysqli_query($con,"select * from employee where id='$rowN[employee_id]'");
			$ss=mysqli_fetch_array($s);
			
			$email=$ss['email'];
			//$title="Shift Reschedule";
			//$subject="Shift Reschedule on" . "$rowN[shift_date]";
			//$msg="test";
			
			$subject = "Welcome to Smartshift";
			$title = "Shift Reschedule";
			$msg = "Dear $ss[name],\n\n"
				 . "Greetings from Smartshift! We are pleased to inform you that an extra shift is added on $rowN[shift_date].\n\n"
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
   
            
            
         
 	$result = mysqli_query($con,"SELECT * FROM $table ");
	

		while($row = mysqli_fetch_array($result))
		{
		$id=$row['0'];
		echo "<tr>";
		for($k=0;$k<$i;$k++)
		{
	
			
			if($k==30)
			{
			  $sql2 = "select *  from customer where id='$_SESSION[userid]' ";
    $result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
$row2 =mysqli_fetch_array($result2);
		
		

			echo "<td >  $row2[contact_person]</td>";
				
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