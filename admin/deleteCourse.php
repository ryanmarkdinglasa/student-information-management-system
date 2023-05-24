<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$alertMsg="";
	$statusMsg=$_GET['statusMsg'];
	$query = mysqli_query($con,"DELETE FROM tblcourse WHERE courseCode='$delid'");
	if ($query == TRUE) {
		$statusMsg="Subject Deleted Successfully!";
		header("Location:viewCourses.php?statusMsg=".$statusMsg);
		exit();
	}
	else{
		$statusMsg="An error Occured!";
		header("Location:viewCourses.php?statusMsg=".$statusMsg);
		exit();
	}
?>

