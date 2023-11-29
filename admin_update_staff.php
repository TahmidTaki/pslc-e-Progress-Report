<?php 	

	session_start();
	error_reporting(0);
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='student'){
		header("location:login.php");
	}

	$host="localhost";
	$user="root"; 
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);
	if($_GET['staff_id']){

		$s_id=$_GET['staff_id'];
		$sql="SELECT * from staff where id='$s_id'";


		$result=mysqli_query($data,$sql);
		$info=$result->fetch_assoc();


		}

	if(isset($_POST['update_staff'])){
		$s_id=$_POST['id'];
		$s_name=$_POST['name'];

		$s_designation=$_POST['designation'];
		$s_image=$_FILES['image']['name'];

		$dst="./staff_image/".$s_image;
		$dst_db="staff_image/".$s_image;

		move_uploaded_file($_FILES['image']['tmp_name'], $dst);
		if($s_image){
			$query="UPDATE staff SET name='$s_name', designation='$s_designation', image='$dst_db' WHERE id='$s_id'";
		}
		else{
			$query="UPDATE staff SET name='$s_name', designation='$s_designation' WHERE id='$s_id'";
		}

		
		$result2=mysqli_query($data,$query);
		if($result2){
			header("location:admin_view_staff.php");
		}

		/*$password=$_POST['password'];

		$query="UPDATE staff SET username='$name', email='$email', phone='$phone', password='$password' WHERE id='$id'";
		$result2=mysqli_query($data,$query);
		if($result2){
			header("location:view_student.php");
		}*/
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Update Staff</title>
	<style>
		body{
	
	background:url('./images/st_pages/bg.jpg') repeat scroll center top #e6e7e4;
	
	 }
	</style>
	<?php 
		include 'admin_css.php';
	?>
	<style type="text/css">
		label{
			display: inline-block;
			text-align: right;
			width: 100px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.div_deg{
			 background-color: skyblue;
			 width: 400px;
			 padding-top: 70px;
			 padding-bottom: 70px;
		} </style>
</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->

	<?php 	
		include 'admin_sidebar.php';
	?>

	<div class="content">
		<center>
		<h1 class="mt-8 text-2xl font-bold">Update Staff</h1>

		<div class="div_deg bg-slate-300 rounded-lg shadow-2xl">
			<form action="#" method="POST" enctype="multipart/form-data">
				<div>
					
					<input type="text" name="id" value="<?php echo "{$info['id']}";?>" hidden>
				</div>

				<div>
					<label>Staff Name</label>
					<input type="text" name="name" value="<?php echo "{$info['name']}";?>">
				</div>

				<br>
				<div>
					<label>Designation</label>
					<input type="text" name="designation" value="<?php echo "{$info['designation']}";?>">
				</div>
				<br>
				<div>
					<label>Old Image: </label>
					<img width="100px" height="100px" src="<?php echo "{$info['image']}";?>">
				</div>

				<div>
					<label>New Image: </label>
					<input type="file" name="image">
				</div>
				<br>
				<div>
					<input type="submit" class="btn btn-primary" name="update_staff" value="Update Staff">
				</div>
			</form>
		</div>
		</center>

	</div>

	

</body>
</html>