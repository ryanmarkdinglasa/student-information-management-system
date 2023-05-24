<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$fid = $_GET['fid'];
	$query = mysqli_query($con,"DELETE FROM tblstaff WHERE staffId='$delid'");
	if ($query === TRUE) {
		$statusMsg="Staff Deleted Successfully!";
		header("Location:viewStaff.php?statusMsg=".$statusMsg);
		exit();
	}else{
		$statusMsg="An error Occured!";
		header("Location:viewStaff.php?statusMsg=".$statusMsg);
		exit();
	}
?>

