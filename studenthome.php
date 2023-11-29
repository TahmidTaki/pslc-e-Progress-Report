<?php
	
	session_start();

	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='admin'){
		header("location:login.php");
	}

	$host="localhost";
	$user="root"; 
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);

	$name=$_SESSION['username'];

	//$id=$_GET['student_id'];

	$sql="SELECT username, email, id, subscription_id from user WHERE username='$name'";
	
	$result=mysqli_query($data,$sql);
	$student_info=mysqli_fetch_assoc($result);


	$_SESSION["st_email"]=$student_info['email'];
	// echo $_SESSION["st_email"];
	$_SESSION["st_user"]=$student_info['username'];
	$_SESSION["loggedInUserID"]=$student_info['id'];
	

	//subscription check


?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		include 'student_css.php';
	?>
</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->

	<?php
		include 'student_sidebar.php';
	?>

	<div class="content text-center pt-12">
		<h1 class="font-bold text-3xl mb-4">Student/Parent Actions</h1>
		<p class="text-xl mb-4"> Choose your actions from the left side bar or view report by clicking the button below.</p>
		<?php 
		if($student_info['subscription_id']!=0){
			echo "<a class='btn btn-info' href='student_followup.php?student_username={$student_info['username']}'>View Report</a>";
		}
		else{
			echo '<p class="font-bold text-red-800">Please "Subscribe" to view e-Progress Reports</p>';
		}
						 
						
					
					?>
	</div>

	

</body>
</html>