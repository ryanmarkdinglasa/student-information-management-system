<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = $_GET['delid'];
	$query = mysqli_query($con,"DELETE FROM tblfaculty WHERE Id='$delid'");
	if ($query === TRUE) {
    $que = mysqli_query($con,"DELETE FROM tbldepartment WHERE facultyId='$delid'");
		if($que == TRUE){
			$statusMsg="Department has been Deleted!";
			header("location:viewFaculty.php?statusMsg=$statusMsg");
			exit();
		}
		else{
			$statusMsg="An Error Occurred!";
			header("location:viewFaculty.php?statusMsg=$statusMsg");
			exit();
		}
	}
	else{
			$statusMsg="An Error Occurred!";
			header("location:viewFaculty.php?statusMsg=$statusMsg");
			exit();
	}
?>

