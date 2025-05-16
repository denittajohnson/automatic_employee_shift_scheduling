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
                    <h1 class="display-4 text-white animated zoomIn"></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12">
                    <!--table-->
        <html>
        <head>
		<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .approved {
            color: green;
            font-weight: bold;
        }
        .pending {
            color: orange;
            font-weight: bold;
        }
        .rejected {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        
            <tr>
                <th>Message</th>
                <th>Date</th>
            </tr>
<?php
 include("connection.php");
 $select="select * from notification where (employee_id='$_SESSION[uid]' or employee_id='0') and status='active'";
 $res=mysqli_query($con,$select);
 if(mysqli_num_rows($res)==0)
 {
    echo "<td colspan='2'>No Notifications !!!</td>";
 }else{
 while($row=mysqli_fetch_array(($res)))
 {
 
?>

<tr>
  <td> <?php echo $row["message"];?> </td>
  <td> <?php echo $row["date"];?> </td>
</tr>

<?php
 }}
?>
    </table>
</body>
</html>
<!--table ends-->
    </div>

    
    </div>
    </div>
    </div>
    <!-- About End -->
	
 
    

    <!-- Footer Start -->
<?php
include('footer.php');
?>