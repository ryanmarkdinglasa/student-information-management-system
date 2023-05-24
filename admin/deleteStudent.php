<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
	include('../includes/session.php');
	$delid = trim($_GET['delid']);
	$query = mysqli_query($con, "DELETE tblstudent_info, tblstudent
                             FROM tblstudent_info
                             JOIN tblstudent ON tblstudent.matricNo = tblstudent_info.matricNo
                             WHERE tblstudent.matricNo = '$delid'");
	
	if ($query==TRUE) {
		$statusMsg="Student Deleted Successfully!";
		header("Location:viewStudent.php?statusMsg=".$statusMsg);
		exit();  
	}
	else{
		$statusMsg="An error Occured!";
		header("Location:viewStudent.php?statusMsg=".$statusMsg);
		exit();
	}


?>

