<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
    include('../includes/session.php');
	//check if the user is not  logged in
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'photos' :
	doupdateimage();
	break;
	}
	function doupdateimage(){
		$con=mysqli_connect("localhost", "root", "", "dbsims");
		$errofile = $_FILES['photo']['error'];
		$type = $_FILES['photo']['type'];
		$temp = $_FILES['photo']['tmp_name'];
		$myfile =$_FILES['photo']['name'];
		$location="../img/".$myfile;
		$idno=$_POST['idno'];
		$allowedTypes = array("image/jpeg", "image/png");
		$type = $_FILES['photo']['type'];
		if(in_array($type, $allowedTypes)==false) {
			$statusMsg="The image is to big!";
				header("Location:viewProfile.php?statusMsg=".$statusMsg);
		} 
		if ( $errofile === UPLOAD_ERR_NO_FILE) {
				$statusMsg="No image selected!";
				header("Location:viewProfile.php?statusMsg=".$statusMsg);
		}else{
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				$statusMsg="Uploaded file is not an image!";
				header("Location:viewProfile.php?statusMsg=".$statusMsg);
			}else{
					//uploading the file
					move_uploaded_file($temp,"../img/" . $myfile);
						$sqls="UPDATE `tblstudent` SET `img`='".$location."' WHERE `matricNo`='".$idno."'";
						$results=mysqli_query($con,$sqls);
						if($results== TRUE){
							$statusMsg="User image has been Updated.";
							header("Location:viewProfile.php?statusMsg=".$statusMsg);	
						}
						else{
							$statusMsg="An error Occurred!";
							header("location:viewProfile.php?statusMsg=".$statusMsg);
							exit();
						}
					}
			}
		}

?>