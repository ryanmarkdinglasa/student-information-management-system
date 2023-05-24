<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$query = mysqli_query($con,"DELETE FROM `tblclass` WHERE `Id`='$delid'");
	if ($query === TRUE) {
		$statusMsg="Class Deleted Successfully!";
		header("location:viewClass.php?statusMsg=".$statusMsg);
		exit();
	}
	else{
		$statusMsg="An error Occurred!";
		header("location:viewClass.php?statusMsg=".$statusMsg);
		exit();
	}
?>

