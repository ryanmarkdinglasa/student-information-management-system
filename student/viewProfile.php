<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$con= mysqli_connect('localhost','root','','dbsims');
	$id=$_SESSION['staffId'];
    $querys = mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
	tblstudent.dateCreated, tbllevel.levelName,tblfaculty.facultyName,tbldepartment.departmentName,tblsession.sessionName
	from tblstudent
	INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
	INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
	INNER JOIN tblfaculty ON tblfaculty.Id = tblstudent.facultyId
	INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId where `matricNo`='$id'");
    $student1= mysqli_fetch_array($querys);
	$query2 = mysqli_query($con,"SELECT * FROM `tblstudent_info` WHERE `matricNo` = '19925775'");
	$student2 = mysqli_fetch_array($query2);
    $statusMsg=$_GET['statusMsg'];
	$photos = $rrow['img'];
?>
	<?php include 'head.php';?>
	<?php $page="profile"; include 'includes/leftMenu.php';?>
	<style>
		.profile-con{
			/border:1px solid green;
			float:left;
		}
	</style>
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
                                    <li class="active">Profile</li>
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
						<div class="col-lg-12">
							<?php
										if($statusMsg!='' && $statusMsg!='An error Occurred!'&& $statusMsg!='No image selected!' && $statusMsg!='Uploaded file is not an image!'){
											echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
										}
										else{
											if($statusMsg!=''){
												echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
											}
										}
							?>
						</div><!--/.col-->
						<div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"> My Profile</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
										<div class="content w3-card-4" 
											style="
												border-radius:15px;
												background:rgb(240,242,245)">
											<div class="features">
											  <div class="wow fadeInDown">
													<div class="col-sm-3 profile-con">
														<div class="panel">            
															<div id="img_profile" class="panel-body">
																<a href="" data-target="#studentmodal" data-toggle="modal" >
																	<img title="profile image" class="img-hover" src="<?php if($photos==''){echo '../img/user.jpg';} else{echo $photos;}?>">
																</a>
															</div>
														</div>
													</div>
												<!--/col-3-->
												<div class="col-sm-6 profile-con" > 
												<div class="student-profile other-info" style="width:66%;margin-left:10px;">
												<div class=" profile-con" style="width:600px;padding:10px 10px;"> 
													<div class="table-responsive">
														<div class=""><h3>Student Information</h3></div>
													<table class="table"> 
														<tr>
															  <td><label>Name: </label></td>
															  <td style="pull-left" colspan="" >
															  <label><?php echo $student1['firstName'].' '.$student1['otherName'].' '.$student1['lastName'];?></label>
															 </td>
															 <td><label>ID Number: </label></td>
															  <td style="pull-left" colspan="" >
															  <label><?php echo $student1['matricNo'];?></label>
															 </td>
														</tr>
														<tr>
															<td><label>Course & Year:</label></td>
															<td style="pull-left" colspan="">
																<label ><?php echo $student1['departmentName'].'-'.$student1['levelName'];?></label>
															</td> <td><label>School Year:</label></td>
															<td style="pull-left" colspan="">
																<label ><?php echo $student1['sessionName'];?></label>
															</td>  
														</tr> 
														<tr> 
															<td><label>E-mail:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['email'];?></label> 
															</td><td><label>Contact No.:</label></td>
															<td style="pull-left" colspan="">
																<label> <?php echo $student2['contactNo'];?></label> 
															</td>
														</tr>  
														<tr> 
															<td><label>Date of Birth:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['birthdate'];?></label> 
															</td><td>
															<label>Place of Birth:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['birthplace'];?></label> 
															</td>
														</tr>  
														<tr> 
															<td><label>Permanent Address:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['address'];?></label> 
															</td><td><label>ZIP code:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['zipcode'];?></label> 
															</td>
														</tr>
														<tr> 
															<td><label>Status:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['status'];?></label> 
															</td><td><label>Citizenship:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['citizenship'];?></label> 
															</td>
														</tr>
														<tr> 
															<td><label>Father's Name:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['fathername'];?></label> 
															</td><td><label>Occupation:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['foccupation'];?></label> 
															</td>
														</tr>
														<tr> 
															<td><label>Mother's Name:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['mothername'];?></label> 
															</td><td><label>Occupation:</label></td>
															<td style="pull-left" colspan="">
																<label><?php echo $student2['moccupation'];?></label> 
															</td>
														</tr> 
														</table>
														
													</div>
												</div>
											</div>
										</div>
											
												
											  </div> 
											</div><!--/.services-->
											
										</div><!--/.row--> 
									
										<?php include 'modal.php';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/.col-->
                </div> <!-- .card -->
			</div><!-- .animated -->
		</div><!-- .content -->
	<div class="clearfix"></div>
    <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include 'script.php';?>
