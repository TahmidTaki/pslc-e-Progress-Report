<?php 	
	
	session_start();
	#connect db
	$host="localhost";
	$user="root";
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);

	/*$sql="SELECT * from user WHERE usertype='student'";*/
	

	if($_GET['student_id']){
		$user_id=$_GET['student_id'];
		$sql="DELETE FROM user WHERE id='$user_id'";
		$result=mysqli_query($data,$sql);

		if($result){
			$_SESSION['message']='Student Data Deleted';
			header("location:view_student.php");
		}

	}

?>