<?php
	error_reporting(0);
    //include('../includes/dbconnection.php');
	$con=mysqli_connect("localhost", "root", "", "dbsims");
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['viewStudentId'])){
		$_SESSION['viewStudentId'] = $_GET['viewStudentId'];
		$query1 = mysqli_query($con,
		"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
		tblstudent.dateCreated, tbllevel.levelName,tblfaculty.facultyName,tbldepartment.departmentName,tblsession.sessionName
		from tblstudent
		INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
		INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
		INNER JOIN tblfaculty ON tblfaculty.Id = tblstudent.facultyId
		INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId
		where matricNo='$_SESSION[viewStudentId]'");
		$student1 = mysqli_fetch_array($query1);
		
		$query2 = mysqli_query($con,"select * from tblstudent_info where matricNo='$_SESSION[viewStudentId]'");
		$student2 = mysqli_fetch_array($query2);
		//$signature = ($student2['studentsignature']=='' || $student2['studentsignature']==' ')?$signature='No Signature':$signature="<img title='signature'class='img-hover' width='100px' height='50px' src='".$student2['studentsignature']."/>";
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"index.php\")
			</script>"; 
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
	<style>
		.panel{
			margin:0 auto;
			/border:2px solid rgb(69,69,69);
			width:270px;
			height:260px;
		}
		.panel-body{
			width:100%;
			text-align:center;
			/border:1px solid red;
		}
		
		.pic-con{
			float:left;
			width:50%;
			height:150px;
			/border:1px solid blue;
			padding:5px 5px;
			/text-align:left;
			background:rgb(144,160,183);
			color:khaki;
		}
		.id-con:hover{
			opacity:0.9;
		}
		.id-con{
			width:300px;
			/height:430px;
			/border:2px solid rgb(69,69,69);
			padding:10px 10px;
			text-align:center;
			border-radius:5px;
			background:rgb(25,49,83);
			/background:rgb(6969);
			color:white;
		}
		.id-text{
			margin:-1px auto;
			width:268px;
			height:35px;
			/border-bottom:2px solid rgb(69,69,69);
			/border-radius:5px;
		}
		.id-text-con{
			margin:10px auto;
			width:270px;
			height:117px;
			border-radius:5px;
			border:2px solid white;
			background:#FFF;
			color:black;
		}
		.text{
			/border-bottom:2px solid #FFF;
			height:20px;
			line-height:15px;
			/background:rgb(25,49,83);
			background:#FFF;
			font-size:13px;
			margin:25px 0px;
			color:rgb(69,69,69);
			/position:absolute;
		}
		.info{
			width:270px;
			/border:1px solid red;
			position:absolute;
			/float:right;
			margin:5px auto;
			font-weight: 600;
		}
		.student-profile{
			/width:550px;
			/border:1px solid red;
			float:left;
			/position:absolute;
			/margin:0pxpx;
		}
		.id-course{
			margin:-10px auto;
			width:270px;
			color:khaki;
		}
		.student-info{
			margin:0 auto;
			width:100%%px;
			/heigth:700px;
			/border:1px solid red;
			/position:relative;
			/background:red;
		}
		.other-info{
			background:rgb(240,242,245);
			padding:5px 10px;
			border-radius:5px;
		}
		
	</style>
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
						<?php
							if($student2['studentphoto']==''|| $student2['studentphoto']==' ' ){
								echo "<div class='alert alert-danger' role='alert'>Upload a photo of the student</div>";
							}
							if($student2['studentsignature']==''|| $student2['studentsignature']==' '){
								echo "<div class='alert alert-danger' role='alert'>Upload a signature of the student</div>";
							}
						?>
                    </div><!--/.col-->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">Student Profile</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
									<div>
										<label class="pull-right">Student Created: <?php echo $student1['dateCreated'];?>
									</div>
									<button type="button"  data-target="#studentmodal" data-toggle="modal" name="submit" class="btn btn-primary">Upload Student Photo</button>
									<button type="submit"  data-target="#studensignature" data-toggle="modal"name="submit" class="btn btn-primary">Upload Student Signature</button><br><br>
									<?php include 'modal2.php';?>
									<?php include 'modal3.php';?>
										<div class="student-info">
											<div class="student-profile" style="width:300px">
												<div class=" id-con">
													<div class="panel"> 
														<div class="panel-body">
															<label style="
															font-family:New Times Roman;
															font-weight:550;
															color:khaki;
															"><span style="color:#FFF;">Republic of the Philippines</span><br>
															PHILIPPINE STATE COLLEGE<br> OF AERONAUTICS<br>
															<span style="color:#FFF;font-size:12px;"><small>Maxtan Extension Campus Curvs, Medellin, Cebu</small></span></label>
															
														</div>
														<div id="img_profile" class="panel-body" >
															<div class="pic-con" style="">
																<img title="profile image" style="margin-top:10px;"class="img-hover" 	width="80px" height="100px"src="<?php echo '../img/philsca-official-logo.png';?>">
																<?php 
																	
																?>
																<br>
																<label style="font-weight:600;">S.Y. <?php echo $student1['sessionName'];?></label>
															</div>
															<div class="pic-con" style="">
																<img title="student photo" style="border:2px solid rgb(69,69,69);"class="img-hover" width="100%" height="100%"src="<?php 
																if($student2['studentphoto']==''||$student2['studentphoto']==' '){echo '../img/user.jpg';}else{echo $student2['studentphoto'];}
																?>">
																
															</div>
														</div>
													</div>
													<div class="id-text-con">
														<div  class="info"><span><?php echo $student1['firstName'].' '.$student1['otherName'].' '.$student1['lastName'];?></span></div>
														<div class="id-text">
															<label class="text"><small>NAME</small></label>
														</div>
														<div  class="info"><span><?php echo $student1['matricNo'];?></span></div>
														<div class="id-text">
															<label class="text" style="background:none; "><small> ID NO.</small></label>
														</div>
														<div  class="info" style="background:nonel;margin-top:5px;"><span style="color:black;"><?php 
														if($student2['studentsignature']=='' || $student2['studentsignature']==' '){
															echo "No Signature";
														}else{
															echo "<img title='signature'class='img-hover' width='100px' height='40px' src='".$student2['studentsignature']."' />";
														}
														?></span></div>
														<div class="id-text" style="background:none;border:none;margin-top:3px;position:absolute;">
															<label class="text" style="background:none;"><small> SIGNATURE</small></label>
														</div>
													</div>
													<div class="" style="
													margin:-5px auto;
															font-family:New Times Roman;
															font-weight:550;
															color:khaki;
															">
														<label> <?php echo $student1['departmentName'];?>
														</label>
													</div>
												</div>
												
											</div>
											<div class="student-profile other-info" style="width:66%;margin-left:10px;">
												<div class=" profile-con" > 
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
									<form action="print/print.php" method="POST" target="_blank">
										<input type="hidden" name="print" value="<?php echo isset($_POST['print'])?$_POST['print']:''; ?>">
										<input type="hidden" name="studentId" value="<?php echo $student1['matricNo']; ?>">
										<input type="hidden" name="level" value="<?php echo $levelId; ?>">
										<input type="hidden" name="faculty" value="<?php echo $facultyId; ?>">
										<input type="hidden" name="session" value="<?php echo $sessionId; ?>">
										<input type="hidden" name="department" value="<?php echo $departmentId; ?>">
										<button class="btn btn-primary" target="_blank" type="submit" style="margin-left:15px;"><i class="fa fa-file" aria-hidden="true"></i> Print</Button>
									</form>
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