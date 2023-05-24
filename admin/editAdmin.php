<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['editid'])){
	$_SESSION['editId'] = $_GET['editid'];
	$query = mysqli_query($con,"select * from tbladmin where staffId='$_SESSION[editId]'");
	$rowi = mysqli_fetch_array($query);
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"index.php\")
			</script>"; 
	}
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$othername=$_POST['othername'];
		$emailAddress=$_POST['emailAddress'];
		$phoneNo=$_POST['phoneNo'];
		$newStaffId=$_POST['staffId'];
		$ret=mysqli_query($con,"update tbladmin set firstName='$firstname', lastName='$lastname', otherName='$othername', 
			emailAddress='$emailAddress', phoneNo='$phoneNo', staffId='$newStaffId' where staffId='$_SESSION[editId]'");
		if($ret == TRUE){
			$statusMsg="Admin Updated Successfully!";
			header("Location:viewAdmin.php?statusMsg=".$statusMsg);
			exit();
		}
		else {
			$alertStyle ="alert alert-danger";
			$statusMsg="An Error Occurred!";
			header("Location:viewAdmin.php?statusMsg=".$statusMsg);
			exit();
		}
	}
?>	
	<?php include 'head.php';?>
	<?php $page="admin"; include 'includes/leftMenu.php';?>
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
				xmlhttp.open("GET","ajaxCall.php?fid="+str,true);
				xmlhttp.send();
			}
		}
		function showRole(str) {
			if (str == "") {
				document.getElementById("txtHintt").innerHTML = "";
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
						document.getElementById("txtHintt").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","ajaxCallRole.php?id="+str,true);
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
                                    <li><a href="viewAdmin.php">Administrator</a></li>
                                    <li class="active">Edit Administrator</li>
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
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Edit Administrator Details</h2></strong>
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
                                                        <label for="cc-exp" class="control-label mb-1">Firstname</label>
                                                        <input id="" name="firstname" type="tel" class="form-control cc-exp" value="<?php echo $rowi['firstName']?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Lastname</label>
                                                        <input id="" name="lastname" type="tel" class="form-control cc-cvc" value="<?php echo $rowi['lastName']?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname">
                                                        </div>
                                            </div>
                                            <div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Othername</label>
															<input id="" name="othername" type="text" class="form-control cc-exp" value="<?php echo $rowi['otherName']?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Othername">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Email Address</label>
															<input id="" name="emailAddress" type="email" class="form-control cc-cvc" value="<?php echo $rowi['emailAddress']?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
														</div>
													</div>
												</div>
												<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Phone Number</label>
																<input id="" name="phoneNo" type="text" class="form-control cc-exp" value="<?php echo $rowi['phoneNo']?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number">
															</div>
														</div>
													<div class="col-6">
														<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Staff ID</label>
															<input id="" name="staffId" type="text" class="form-control cc-cvc" value="<?php echo $rowi['staffId']?>" data-val="true" Required data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="StaffID">
														</div>
													</div>
												</div>
												<div class="row">
													   <div class="col-6">
															<div class="form-group">
																<label for="x_card_code" class="control-label mb-1">Faculty</label>
																<?php 
																$query=mysqli_query($con,"select * from tblfaculty ORDER BY facultyName ASC");                        
																$count = mysqli_num_rows($query);
																if($count > 0){                       
																	echo ' <select required name="facultyId" onchange="showValues(this.value)" class="custom-select form-control">';
																	echo'<option value="">--Select Faculty--</option>';
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
												<button type="submit" name="submit" class="btn btn-primary">Update Admin</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
					<br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Administrator</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff ID</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Othername</th>
                                            <th>EmailAddress</th>
                                            <th>PhoneNo</th>
                                            <th>Role</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
										<?php
											$ret=mysqli_query($con,"SELECT tbladmin.staffId, tbladmin.firstName, tbladmin.lastName, tbladmin.otherName,tbladmin.emailAddress, tbladmin.phoneNo, tbladmin.dateCreated,tbladmintype.adminTypeName
											from tbladmin 
											INNER JOIN tbladmintype ON tbladmintype.Id = tbladmin.adminTypeId
											where adminTypeId = '2'");
											$cnt=1;
											while ($row=mysqli_fetch_array($ret)) {
																?>
													<tr>
													<td><?php echo $cnt;?></td>
													<td><?php  echo $row['staffId'];?></td>
													<td><?php  echo $row['firstName'];?></td>
													<td><?php  echo $row['lastName'];?></td>
													<td><?php  echo $row['otherName'];?></td>
													<td><?php  echo $row['emailAddress'];?></td>
													<td><?php  echo $row['phoneNo'];?></td>
													<td><?php  echo $row['adminTypeName'];?></td>
													<td><?php  echo $row['dateCreated'];?></td>
													<td><a href="editAdmin.php?editid=<?php echo $row['staffId'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a></td>
													<td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteAdmin.php?delid=<?php echo $row['staffId'];?>" title="Delete Admin"><i class="fa fa-trash fa-1x"></i></a></td>
													</tr>
													<?php 
													$cnt=$cnt+1;
													}?>                             
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				<!-- end of datatable -->

				</div>
			</div><!-- .animated -->
		</div><!-- .content -->
		<div class="clearfix"></div>
        <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include 'script.php';?>