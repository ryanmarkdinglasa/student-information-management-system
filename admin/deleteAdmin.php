<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$query = mysqli_query($con,"DELETE FROM tbladmin WHERE staffId='$delid'");
	if ($query === TRUE) {
			$alertStyle ="alert alert-success";
			$statusMsg="Deleted successfully!";
			header("location:viewAdmin.php?statusMsg=$statusMsg");
			exit(); 
	}else{
			$alertStyle ="alert alert-success";
			$statusMsg="An error Occured!";
			header("location:viewAdmin.php?statusMsg=$statusMsg");
			exit();
	}

?>

