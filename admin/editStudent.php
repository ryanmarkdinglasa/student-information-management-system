<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	$page='';
	if(isset($_GET['editStudentId'])){
		$_SESSION['editStudentId'] = $_GET['editStudentId'];
		$query1 = mysqli_query($con,"select * from tblstudent where matricNo='$_SESSION[editStudentId]'");
		$rowi = mysqli_fetch_array($query1);
		
		$query2 = mysqli_query($con,"select * from tblstudent_info where matricNo='$_SESSION[editStudentId]'");
		$row2 = mysqli_fetch_array($query2);
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"viewStudent.php\")
			</script>"; 
	}
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$othername=$_POST['othername'];
		$sessionId=$_POST['sessionId'];
		$matricNo=$_SESSION['editStudentId'];
		$levelId=$_POST['levelId'];
		$departmentId=$_POST['departmentId'];
		$facultyId=$_POST['facultyId'];
		$dateCreated = date("Y-m-d");
		//student other informations
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
		
		$ret=mysqli_query($con,"update tblstudent set firstName='$firstname', lastName='$lastname', otherName='$othername', 
		matricNo='$matricNo', levelId='$levelId', facultyId='$facultyId', departmentId = '$departmentId', sessionId='$sessionId'
		where matricNo='$_SESSION[editStudentId]'");
		$query3=mysqli_query($con,"UPDATE tblstudent_info SET matricNo='$matricNo',email='$email',contactNo='$contactNo',birthdate='$birthdate',birthplace='$birthplace',address='$address',zipcode='$zipcode',status='$status',citizenship='$citizenship',fathername='$fathername',foccupation='$foccupation',mothername='$mothername',moccupation='$moccupation' WHERE `matricNo`='".$_SESSION['editStudentId']."'");
		if ($ret && $query3) {
			$alertStyle ="alert alert-success";
			$statusMsg="Student Updated Successfully!";
			header("Location:viewStudent.php?statusMsg=".$statusMsg);
			exit();
		}
		else{
			$alertStyle ="alert alert-danger";
			$statusMsg="An error Occurred!";
			header("Location:viewStudent.php?statusMsg=".$statusMsg);
			exit();
		}
	}
?>
	<?php include "head.php";?>
	<?php if($page=='student'){ echo 'active'; }?>
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
    <!-- Left Panel -->
		<?php $page="student"; include 'includes/leftMenu.php';?>
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
                                    <li><a href="viewStudent.php">Student</a></li>
                                    <li class="active">Edit Student</li>
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
                                <strong class="card-title"><h2 align="center">Edit Student</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <!--<div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>-->
                                       <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name</label>
                                                        <input id="" name="firstname" type="text" class="form-control cc-exp" value="<?php echo $rowi['firstName'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Middle Name</label>
                                                        <input id="" name="othername" type="text" class="form-control cc-exp" value="<?php echo $rowi['otherName'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Middle Name">
                                                    </div>
                                                </div>
                                            </div>
                                        <div>
                                            <div class="row">
												<div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Last Name</label>
                                                    <input id="" name="lastname" type="text" class="form-control cc-cvc" value="<?php echo $rowi['lastName'];?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Last Name">
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
                                                        <input id="" name="matricNo" type="text" class="form-control cc-exp" value="<?php echo $rowi['matricNo'];?>" disabled data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="ID Number">
                                                    </div>
                                                </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                     <label for="x_card_code" class="control-label mb-1">School Year</label>
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
															<input id="" name="email" type="email" class="form-control cc-exp" value="<?php echo $row2['email'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="E-mail Address">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Contact Number:</label>
																<input id="" name="contactNo" type="number" class="form-control cc-exp" value="<?php echo $row2['contactNo'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Contact Number">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Date of Birth</label>
															<input id="" name="birthdate" type="date" class="form-control cc-exp" value="<?php echo $row2['birthdate'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Date of Birth">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Place of Birth</label>
																<input id="" name="birthplace" type="text" class="form-control cc-exp" value="<?php echo $row2['birthplace'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Place of Birth">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Permanent Address</label>
															<input id="" name="address" type="text" class="form-control cc-exp" value="<?php echo $row2['address'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Permanent Address">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">ZIP Code</label>
																<input id="" name="zipcode" type="number" class="form-control cc-exp" value="<?php echo $row2['zipcode'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="ZIP Code">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Status</label>
															<select required name="status" class="custom-select form-control">
																<option value="<?php echo $row2['status'];?>"><?php echo $row2['status'];?></option>
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
																<input id="" name="citizenship" type="text" class="form-control cc-exp" value="<?php echo $row2['citizenship'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Citizenship">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Father's Name</label>
															<input id="" name="fathername" type="text" class="form-control cc-exp" value="<?php echo $row2['fathername'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Name: (First Name, Middle Name , Last Name)">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Father's Occupation</label>
																<input id="" name="foccupation" type="text" class="form-control cc-exp" value="<?php echo $row2['foccupation'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Occupation">
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Mother's Name</label>
															<input id="" name="mothername" type="text" class="form-control cc-exp" value="<?php echo $row2['mothername'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Name: (First Name, Middle Name , Last Name)">
														</div>
													</div>
													<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Mother's Occupation</label>
																<input id="" name="moccupation" type="text" class="form-control cc-exp" value="<?php echo $row2['moccupation'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Occupation">
															</div>
													</div>
												</div>
                                                <button type="submit" name="submit" class="btn btn-primary">Update Student</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
					<!--<br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Student</h2></strong>
                            </div>
                            <div class="card-body">
								<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>FullName</th>
                                            <th>MatricNo</th>
                                            <th>Level</th>
                                            <th>Faculty</th>
                                            <th>Department</th>
                                            <th>Session</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
										<?php /*
											$ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
											tblstudent.dateCreated, tbllevel.levelName,tblfaculty.facultyName,tbldepartment.departmentName,tblsession.sessionName
											from tblstudent
											INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
											INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
											INNER JOIN tblfaculty ON tblfaculty.Id = tblstudent.facultyId
											INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId");
											$cnt=1;
											while ($row=mysqli_fetch_array($ret)) {
										?>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
											<td><?php  echo $row['matricNo'];?></td>
											<td><?php  echo $row['levelName'];?></td>
											<td><?php  echo $row['facultyName'];?></td>
											<td><?php  echo $row['departmentName'];?></td>
											<td><?php  echo $row['sessionName'];?></td>
											<td><?php  echo $row['dateCreated'];?></td>
											<td><a href="editStudent.php?editStudentId=<?php echo $row['matricNo'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a>
											<a onclick="return confirm('Are you sure you want to delete?')" href="deleteStudent.php?delid=<?php echo $row['matricNo'];?>" title="Delete Student Details"><i class="fa fa-trash fa-1x"></i></a></td>
										</tr>
										<?php 
											$cnt=$cnt+1;
										}
										*/?>                                                     
									</tbody>
								</table>
							</div>
						</div>
					</div>-->
				<!-- end of datatable -->
				</div>
			</div><!-- .animated -->
		</div><!-- .content -->
		<div class="clearfix"></div>
		<?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include "script.php";?>