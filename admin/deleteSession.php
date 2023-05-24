<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$query = mysqli_query($con,"DELETE FROM tblsession WHERE Id='$delid'");
	if ($query === TRUE) {
		$statusMsg="School Year Deleted Successfully!";
		header("location:viewSession.php?statusMsg=$statusMsg");
		exit(); 
	}
	else{
		$statusMsg="An error Occurred!";
		header("location:viewSession.php?statusMsg=$statusMsg");
		exit();
	}

?>

