<?php 	

	session_start();
	error_reporting(0);
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='student'){
		header("location:login.php");
	}

	#connect db
	$host="localhost";
	$user="root";
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);

	//search start
	if(isset($_POST['search']))
		{
		    $valueToSearch = $_POST['valueToSearch'];
		    $sql="SELECT * from user WHERE username LIKE '%".$valueToSearch."%'";
		    $result = mysqli_query($data,$sql);
		    
		}
		 else {
		    $sql="SELECT * from user WHERE usertype='student'";
			$result=mysqli_query($data,$sql);
		}


	//search finish

	//$sql="SELECT * from user WHERE usertype='student'";
	//$result=mysqli_query($data,$sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<style>
		body{
	
	background:url('./images/st_pages/bg.jpg') repeat scroll center top #e6e7e4;
	
	 }
	</style>
	<?php 
		include 'admin_css.php';
	?>
	<style type="text/css">
		.table_th{
			padding: 20px;
			font-size: 20px;
		}

		.table_td{
			padding: 20px;
		}
	</style>

</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->

	<?php 	
		include 'admin_sidebar.php';
	?>

	<div class="content">
		<center>
		<h1 class="mt-8 font-bold text-3xl">Student Data</h1>
		<?php 
			if($_SESSION['message']){
				echo $_SESSION['message'];
			}
			unset($_SESSION['message']);
			?>
		<br>

		<!--search-->

		<form action="view_student.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search by Name"><br><br>
            <input type="submit" class="btn btn-info" name="search" value="Filter"><br><br>
            
        <table class="bg-slate-300 rounded-lg shadow-2xl">
			<tr>
				<th class="table_th">Username</th>
				<th class="table_th">Phone</th>
				<th class="table_th">Email</th>
				<th class="table_th">Password</th>
				<th class="table_th">Delete</th>
				<th class="table_th">Update</th>
				<th class="table_th">Report</th>
				<th class="table_th">View Report</th>
			</tr>

			<?php 
				while($info=$result->fetch_assoc()){
			?>

			<tr class="bg-slate-300">
				<td class="table_td bg-slate-100">
					<?php 
						echo "{$info['username']}";
					?>
				</td>
				<td class="table_td bg-slate-100">
					<?php 
						echo "{$info['phone']}";
					?>
				</td>
				<td class="table_td bg-slate-100">
					<?php 
						echo "{$info['email']}";
					?>
				</td>
				<td class="table_td bg-slate-100">
					<?php 
						echo "{$info['password']}";
					?>
				</td>
				<td class="table_td bg-slate-100">
					<?php 
						echo "<a class='btn btn btn-error'
						onClick=\"javascript:return confirm('Are you sure to delete this student?')\"href='delete.php?student_id={$info['id']}'>Delete</a>";
					?>
				</td>
				<td class="table_td bg-slate-100">
					<?php 
						 
						echo "<a class='btn btn-success' href='update_student.php?student_id={$info['id']}'>Update</a>";
					
					?>
				</td>

				<td class="table_td bg-slate-100">
					<?php 
						 
						echo "<a class='btn btn-warning' href='insert_report.php?student_id={$info['id']}'>Insert Report</a>";
					
					?>
				</td>

				<td class="table_td bg-slate-100">
					<?php 
						 
						echo "<a class='btn btn-info' href='view_report.php?student_username={$info['username']}'>View Report</a>";
					
					?>
				</td>
			</tr>

			<?php 
				}
			?>
		</table> </form>
		</center>
	</div>

	

</body>
</html>