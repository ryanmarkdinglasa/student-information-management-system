<?php
	error_reporting(0);
	include('../includes/dbconnection.php');
    include('../includes/session.php');
	//check if the user is not  logged in
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){
 

		if ($_POST['U_NAME'] == "" OR $_POST['U_USERNAME'] == "" OR $_POST['U_PASS'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$conn = mysqli_connect("localhost", "root", "", "dbattendance");
			$sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='" .$_POST['U_USERNAME']."'";
			$res = mysqli_query($conn, $sql) or die(mysqli_error());
			$userresult = mysqli_fetch_assoc($res);

			if ($userresult) {
				# code...
				message("Username is already taken.", "error");
				redirect('index.php?view=add');
			}else{

			$user = New User();
			// $user->USERID 		= $_POST['user_id'];
			$user->ACCOUNT_NAME 		= $_POST['U_NAME'];
			$user->ACCOUNT_USERNAME		= $_POST['U_USERNAME'];
			$user->ACCOUNT_PASSWORD		=sha1($_POST['U_PASS']);
			$user->ACCOUNT_TYPE			=  $_POST['U_ROLE'];
			$user->create();

						// $autonum = New Autonumber(); 
						// $autonum->auto_update(2);

			message("New [". $_POST['U_NAME'] ."] created successfully!", "success");
			redirect("index.php");

			} 
		}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){
		// $sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='" .$_POST['U_USERNAME']."'";
		// 	$res = mysql_query($sql) or die(mysql_error());
		// 	$userresult = mysql_fetch_assoc($res);

		// 	if ($userresult) {
		// 		# code...
		// 		message("Username is already taken.", "error");
		// 		redirect('index.php?view=add');
		// 	}else{
		   $user = New User(); 
			$user->ACCOUNT_NAME 		= $_POST['U_NAME'];
			$user->ACCOUNT_USERNAME		= $_POST['U_USERNAME'];
			$user->ACCOUNT_PASSWORD		=sha1($_POST['U_PASS']);
			$user->ACCOUNT_TYPE			= $_POST['U_ROLE'];
			$user->update($_POST['USERID']);

			message("[". $_POST['U_NAME'] ."] has been updated!", "success");
			redirect("index.php");
			// }
 
			
		}
	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doupdateimage(){
		$errofile = $_FILES['photo']['error'];
		$type = $_FILES['photo']['type'];
		$temp = $_FILES['photo']['tmp_name'];
		$myfile =$_FILES['photo']['name'];
		$location="../img/".$myfile;
		$idno=$_POST['idno'];
		$con=mysqli_connect("localhost", "root", "", "dbsims");
		if ( $errofile > 0) {
				$statusMsg="No image selected!";
				header("Location:viewStudent.php?statusMsg=".$statusMsg);
		}else{
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				$statusMsg="Uploaded file is not an image!";
				header("Location:viewStudent.php?statusMsg=".$statusMsg);
			}else{
					//uploading the file
					move_uploaded_file($temp,"../img/" . $myfile);
						$sqls="UPDATE `tblstudent_info` SET `studentsignature`='".$location."' WHERE `matricNo`='".$idno."'";
						$results=mysqli_query($con,$sqls);
						if($results== TRUE){
							$statusMsg="User image has been Updated.";
							header("Location:viewStudentProfile.php?viewStudentId=".$idno);	
						}
						else{
							$statusMsg="An error Occurred!";
							header("location:viewStudent.php?statusMsg=".$statusMsg);
							exit();
						}
					}
			}
			 
		}
 
?>