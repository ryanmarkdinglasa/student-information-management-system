<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$query = mysqli_query($con,"DELETE FROM tbldepartment WHERE Id='$delid'");
	if ($query === TRUE) {
		$statusMsg="Course Deleted Successfully!";
		header("location:viewDepartment.php?statusMsg=".$statusMsg);
		exit();
	}
	else{
		$statusMsg="An error Occurred!";
		header("location:viewDepartment.php?statusMsg=".$statusMsg);
		exit();
	}
?>

