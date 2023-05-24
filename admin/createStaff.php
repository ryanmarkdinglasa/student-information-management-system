<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$othername=$_POST['othername'];
		$emailAddress=$_POST['emailAddress'];
		$password =md5('12345');
		$phoneNo=$_POST['phoneNo'];
		$facultyId=$_POST['facultyId'];
		$img='';
		$adminTypeId='2';
		$newstaffId=$_POST['staffId'];
		$dateCreated = date("Y-m-d");
		//
		$que1=mysqli_query($con,"select * from tbladmin where staffId ='".$newstaffId."'");
		$que2=mysqli_query($con,"select * from tblstaff where staffId ='".$newstaffId."'");
		$res1=mysqli_fetch_array($que1);
		$res2=mysqli_fetch_array($que2);
		if($res1 > 0 || $res2 > 0 ){
			$alertStyle ="alert alert-danger";
			$statusMsg="Administrator or Staff with the StaffID already exist!";
			header("location:viewStaff.php?statusMsg=$statusMsg");
			exit();
		}else{
			$ret=mysqli_query($con,"INSERT INTO tblstaff(firstName,lastName,otherName,emailAddress,phoneNo,staffId,facultyId,img,adminTypeId,password,isPasswordChanged,dateCreated)
			VALUES('$firstname','$lastname','$othername','$emailAddress','$phoneNo','$newstaffId','$facultyId','$img','$adminTypeId','$password','0','$dateCreated')");
			if($ret){
				$alertStyle ="alert alert-success";
				$statusMsg="Staff Added Successfully!";
				header("Location:viewStaff.php?statusMsg=".$statusMsg);
				exit();
			}
			else {
			  $alertStyle ="alert alert-danger";
			  $statusMsg="An Error Occurred!";
			  header("Location:viewStaff.php?statusMsg=".$statusMsg);
			  exit();
			}
		}
	
	}
?>
	<?php include "head.php";?>
	<?php $page="staff"; include 'includes/leftMenu.php';?>
	<!-- /#left-panel -->
    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
            <?php include 'includes/header.php';?>
        <!-- /header -->
        <!-- Header-->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="./">Dashboard</a></li>
                                    <li><a href="viewStaff.php">Staff</a></li>
                                    <li class="active">Add Staff</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">Add New Staff</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name</label>
                                                        <input id="" name="firstname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Last Name</label>
                                                        <input id="" name="lastname" type="tel" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Middle Name</label>
                                                        <input id="" name="othername" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Middle Name">
                                                    </div>
                                                </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">E-mail Address</label>
                                                    <input id="" name="emailAddress" type="email" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="E-mail Address">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Contact Number</label>
                                                        <input id="" name="phoneNo" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Contact Number">
                                                    </div>
                                                </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Staff ID No.</label>
                                                    <input id="" name="staffId" type="text" class="form-control cc-cvc" value="" data-val="true" Required data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="StaffID">
                                                </div>
                                            </div>
                                        </div>
											<div class="row">
														<div class="col-6">
															<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Department</label>
															<?php  
																$query=mysqli_query($con,"select * from tblfaculty ORDER BY facultyName ASC");                        
																$count = mysqli_num_rows($query);
																if($count > 0){                       
																	echo ' <select required name="facultyId" onchange="showValues(this.value)" class="custom-select form-control">';
																	echo'<option value="">--Select Department--</option>';
																	while ($row = mysqli_fetch_array($query)) {
																	echo'<option value="'.$row['Id'].'" >'.$row['facultyName'].'</option>';
																		}
																			echo '</select>';
																		}
															?>                                                     
															</div>
														</div>
											</div>
                                                <button type="submit" name="submit" class="btn btn-primary">Add Staff</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
				<!-- end of datatable -->
				</div>
			</div><!-- .animated -->
		</div><!-- .content -->
		<div class="clearfix"></div>
        <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include "script.php";?>