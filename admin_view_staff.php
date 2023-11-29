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

	$sql="SELECT * from staff";
	$result=mysqli_query($data,$sql);

	if($_GET['staff_id']){
		$st_id=$_GET['staff_id'];
		$sql2="DELETE FROM staff WHERE id='$st_id'";
		$result2=mysqli_query($data,$sql2);

		if($result2){
			$_SESSION['message']='Staff Data Deleted';
			header("location:admin_view_staff.php");
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin View Staff</title>
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
		<h1 class="text-3xl font-bold my-8">All Staff Data</h1>
		<?php 
			/*if($_SESSION['message']){
				echo $_SESSION['message'];
			}
			unset($_SESSION['message']);*/
			?>
		<br>
		<table class="bg-slate-300 rounded-lg shadow-2xl">
			<tr>
				<th class="table_th bg-slate-100">Staff Name</th>
				<th class="table_th bg-slate-100">Designation</th>
				<th class="table_th bg-slate-100">Image</th>
				<th class="table_th bg-slate-100">Delete</th>
				<th class="table_th bg-slate-100">Update</th>
			</tr>

			<?php 
				while($info=$result->fetch_assoc()){
			?>

			<tr>
				<td class="table_td">
					<?php 
						echo "{$info['name']}";
					?>
				</td>
				<td class="table_td">
					<?php 
						echo "{$info['designation']}";
					?>
				</td>
				<td class="table_td">
					<img height="100px" width="100px" src="<?php 
						echo "{$info['image']}";
						?>">
					
				</td>

				<td class="table_td">
					<?php 
						echo "<a class='btn btn-error'
						onClick=\"javascript:return confirm('Are you sure to delete this staff?')\"href='admin_view_staff.php?staff_id={$info['id']}'>Delete</a>";
					?>
				</td>
				<td class="table_td">
					<?php 
						 
						echo "<a class='btn btn-primary' href='admin_update_staff.php?staff_id={$info['id']}'>Update</a>";
					
					?>
				</td>
				
				
			</tr>

			<?php 
				}
			?>
		</table>
		</center>
	</div>

	

</body>
</html>