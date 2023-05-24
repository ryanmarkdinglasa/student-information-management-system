<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$firstname=trim($_POST['firstname']);
		$lastname=trim($_POST['lastname']);
		$othername=trim($_POST['othername']);
		$matricNo=trim($_POST['matricNo']);
		$password =md5('12345');
		$levelId=trim($_POST['levelId']);
		$sessionId=trim($_POST['sessionId']);
		$departmentId=trim($_POST['departmentId']);
		$facultyId=trim($_POST['facultyId']);
		$dateCreated = date("Y-m-d");
		$query=mysqli_query($con,"select * from tblstudent where matricno ='$matricNo'");
		$ret=mysqli_fetch_array($query);
		
		$email=trim($_POST['email']);
		$contactNo=trim($_POST['contactNo']);
		$birthdate=trim($_POST['birthdate']);
		$birthplace=trim($_POST['birthplace']);
		$address=trim($_POST['address']);
		$zipcode=trim($_POST['zipcode']);
		$status=trim($_POST['status']);
		$citizenship=trim($_POST['citizenship']);
		$fathername=trim($_POST['fathername']);
		$foccupation=trim($_POST['foccupation']);
		$mothername=trim($_POST['mothername']);
		$moccupation=trim($_POST['moccupation']);
	
		if($ret > 0){
			$alertStyle ="alert alert-danger";
			$statusMsg="Student with the ID Number already exist!";
			header("Location:createStudent.php?statusMsg=".$statusMsg);
			exit();
		}
		else{
			//check student's photo and signature there is no file selected
			//move the student photo and signature to the designated folder
			//after checking the student's photo and signature then insert the ff
			$query=mysqli_query($con,"insert into tblstudent(firstName,lastName,otherName,matricNo,password,levelId,facultyId,departmentId,sessionId,dateCreated) value('$firstname','$lastname','$othername','$matricNo','$password','$levelId','$facultyId','$departmentId','$sessionId','$dateCreated')");
			$query2=mysqli_query($con,"insert into tblstudent_info(matricNo,email,contactNo,birthdate,birthplace,address,zipcode,status,citizenship,fathername,foccupation,mothername,moccupation,studentphoto,studentsignature) value('".$matricNo."','".$email."','".$contactNo."','".$birthdate."','".$birthplace."','".$address."','".$zipcode."','".$status."','".$citizenship."','".$fathername."','".$foccupation."','".$mothername."','".$moccupation."','','')");
			//$query = mysqli_query($con,"insert into tblstudent(firstName,lastName,otherName,matricNo,password,levelId,facultyId,departmentId,sessionId,dateCreated) value('$firstname','$lastname','$othername','$matricNo','$password','$levelId','$facultyId','$departmentId','$sessionId','$dateCreated');insert into tblstudent_info(matricNo,email,contactNo,birthdate,birthplace,address,zipcode,status,citizenship,fathername,foccupation,mothername,moccupation,studentphoto,studentsignature) value('".$matricNo."','".$email."','".$contactNo."','".$birthdate."','".$birthplace."','".$address."','".$zipcode."','".$status."','".$citizenship."','".$fathername."','".$foccupation."','".$mothername."','".$moccupation."','','')");
			if ($query || $query2) {
				$alertStyle ="alert alert-success";
				$statusMsg="Student Added Successfully!";
				header("Location:viewStudent.php?statusMsg=".$statusMsg);
				exit();
			}
			else{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("Location:createStudent.php?statusMsg=".$statusMsg);
				exit();
			}
		}
	}
?>
	<?php include 'head.php';?>
	<?php $page="student"; include 'includes/leftMenu.php';?>
	<script>
		function showValues(str) {
			if (str == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","ajaxCall2.php?fid="+str,true);
				xmlhttp.send();
			}
		}
	</script>
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
                                    <li><a href="viewStudent.php">Student</a></li>
                                    <li class="active">Add Student</li>
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
                                <strong class="card-title"><h2 align="center">Add New Student</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
										<?php 
											if($statusMsg!='' &&$statusMsg!='An error Occurred!'){
												echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
											}
											else{
												if($statusMsg=='An error Occurred!' ||$statusMsg=='Student with the ID Number already exist!'){
													echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
												}
											}
											
										?>
										<form method="Post" action="">
										 <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name</label>
                                                        <input id="" name="firstname" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="First Name">
                                                    </div>
                                                </div>
												<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Middle Name</label>
															<input id="" name="othername" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Middle Name">
														</div>
												</div>
                                            </div>
											<div>
												<div class="row">
													<div class="col-6">
														<label for="x_card_code" class="control-label mb-1">Last Name</label>
														<input id="" name="lastname" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Last Name">
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Year Level</label>
															<?php 
																$query=mysqli_query($con,"select * from tbllevel");                        
																$count = mysqli_num_rows($query);
																if($count > 0){                       
																	echo ' <select required name="levelId" class="custom-select form-control">';
																	echo'<option value="">--Select Level--</option>';
																	while ($row = mysqli_fetch_array($query)) {
																	echo'<option value="'.$row['Id'].'" >'.$row['levelName'].'</option>';
																	}
																	echo '</select>';
																}
														?>   
														</div>
													</div>
												</div>
												<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">ID Number</label>
																<input id="" name="matricNo" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="ID Number">
															</div>
														</div>
													<div class="col-6">
														<div class="form-group">
															 <label for="x_card_code" class="control-label mb-1">School year</label>
															<?php 
															$query=mysqli_query($con,"select * from tblsession where isActive = 1");                        
															$count = mysqli_num_rows($query);
															if($count > 0){                       
																echo ' <select required name="sessionId" class="custom-select form-control">';
																echo'<option value="">--Select S.Y.--</option>';
																while ($row = mysqli_fetch_array($query)) {
																echo'<option value="'.$row['Id'].'" >'.$row['sessionName'].'</option>';
																	}
																		echo '</select>';
																	}
														?>   
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
													<div class="col-6">
														<div class="form-group">
															<?php
																echo"<div id='txtHint'></div>";
															?>                                    
														</div>
													</div>
												</div>
												<p><span>*Other Informations</span></p>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">E-mail Address</label>
															<input id="" name="email" type="email" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="E-mail Address">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Contact Number:</label>
																<input id="" name="contactNo" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Contact Number">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Date of Birth</label>
															<input id="" name="birthdate" type="date" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Date of Birth">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Place of Birth</label>
																<input id="" name="birthplace" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Place of Birth">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Permanent Address</label>
															<input id="" name="address" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Permanent Address">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">ZIP Code</label>
																<input id="" name="zipcode" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="ZIP Code">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Status</label>
															<select required name="status" class="custom-select form-control">
																<option>--Select Status--</option>
																<option value="single">Single</option>
																<option value="married">Married</option>
																<option value="widowed">Widowed</option>
																<option value="divorced">Divorced</option>
																<option value="separated">Separated</option>
															</select>

														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Citizenship</label>
																<input id="" name="citizenship" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Citizenship">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Father's Name</label>
															<input id="" name="fathername" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Name: (First Name, Middle Name , Last Name)">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Father's Occupation</label>
																<input id="" name="foccupation" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Occupation">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Mother's Name</label>
															<input id="" name="mothername" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Name: (First Name, Middle Name , Last Name)">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Mother's Occupation</label>
																<input id="" name="moccupation" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Occupation">
															</div>
													</div>
												</div>
                                                <button type="submit" name="submit" class="btn btn-primary">Add New Student</button>
                                        </form>
									</div>
								</div>
							</div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
                </div><!--/.col-->
				<!-- end of datatable -->
				</div>
			</div><!-- .animated -->
		</div><!-- .content -->
		<div class="clearfix"></div>
        <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include 'script.php';?>
