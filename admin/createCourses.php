
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$courseTitle=$_POST['courseTitle'];
		$courseCode=$_POST['courseCode'];
		$levelId=$_POST['levelId'];
		$semesterId=$_POST['semesterId'];
		$courseUnit=$_POST['courseUnit'];
		$departmentId=$_POST['departmentId'];
		$facultyId=$_POST['facultyId'];
		$dateAdded = date("Y-m-d");
		//Checks the Course Code
		$query=mysqli_query($con,"select * from tblcourse where courseCode ='$courseCode'");
		$ret=mysqli_fetch_array($query);
		if($ret > 0){ //Check the coure Title
			$alertStyle ="alert alert-danger";
			$statusMsg="This Subject already exist!";
			header("location:createCourses.php?statusMsg=".$statusMsg);
			exit();
		}
		else{
			$query=mysqli_query($con,"insert into tblcourse(courseTitle,courseCode,courseUnit,facultyId,departmentId,levelId,semesterId,dateAdded) value('$courseTitle','$courseCode','$courseUnit','$facultyId','$departmentId','$levelId','$semesterId','$dateAdded')");
			if ($query) {
				$alertStyle ="alert alert-success";
				$statusMsg="Subject Created and Assigned Successfully!";
				header("location:viewCourses.php?statusMsg=".$statusMsg);
				exit();
			}
			else{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("location:createCourses.php?statusMsg=".$statusMsg);
				exit();
			}
		}
	}
?>
	<?php include 'head.php';?>
	<?php $page="courses"; include 'includes/leftMenu.php';?>
	<script>
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
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

		function showLecturer(str) {
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
				xmlhttp.open("GET","ajaxCallLecturer.php?deptId="+str,true);
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
                                    <li><a href="viewCourses.php">Subject</a></li>
                                    <li class="active">Add Subject</li>
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
                                <strong class="card-title"><h2 align="center">Add New Subject</h2></strong>
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
											if($statusMsg=='An error Occurred!'){
												echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
											}
										}
										?>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Subject Title</label>
                                                        <input id="" name="courseTitle" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Subject Title">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Subject Code</label>
                                                        <input id="" name="courseCode" type="text" class="form-control cc-exp" value="" Required placeholder="Subject Code">
                                                        <!-- <input id="" maxlength="4" onkeypress="return isNumber(event)" name="courseId" type="text" class="form-control cc-cvc" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Course ID should start from 0001"> -->
                                                        </div>
                                            </div>
											<div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Subject Unit</label>
															<input id="" name="courseUnit" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Subject Unit">
														</div>
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
															<label for="cc-exp" class="control-label mb-1">Semester</label>
														<?php 
														$query=mysqli_query($con,"select * from tblsemester");                        
														$count = mysqli_num_rows($query);
														if($count > 0){                       
															echo ' <select required name="semesterId" class="custom-select form-control">';
															echo'<option value="">--Select Semester--</option>';
															while ($row = mysqli_fetch_array($query)) {
															echo'<option value="'.$row['Id'].'" >'.$row['semesterName'].'</option>';
																}
																	echo '</select>';
																}
														?>                                                       
														</div>
													</div><!-- Log on to codeastro.com for more projects! -->
													<div class="col-6">
														<div class="form-group">
														 <label for="x_card_code" class="control-label mb-1">Department</label>
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
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
														<?php
															echo"<div id='txtHint'></div>";
														 ?>   													
														</div>
													</div> 
												</div>
                                                <button type="submit" name="submit" class="btn btn-primary">Add Subject</button>
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
                                <strong class="card-title"><h2 align="center">All Courses</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Code</th>
                                            <th>Unit</th>
                                            <th>Level</th>
                                            <th>Faculty</th>
                                            <th>Department</th>
                                             <th>Semester</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php /*
											$ret=mysqli_query($con,"SELECT tblcourse.courseCode,tblcourse.courseTitle,tblcourse.dateAdded,
										   tblcourse.courseUnit,tbllevel.levelName,tblfaculty.facultyName,tbldepartment.departmentName,tblsemester.semesterName
											from tblcourse 
											INNER JOIN tbllevel ON tbllevel.Id = tblcourse.levelId
											INNER JOIN tblsemester ON tblsemester.Id = tblcourse.semesterId
											INNER JOIN tblfaculty ON tblfaculty.Id = tblcourse.facultyId
											INNER JOIN tbldepartment ON tbldepartment.Id = tblcourse.departmentId");
										$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {
										?>
											<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['courseTitle'];?></td>
											<td><?php  echo $row['courseCode'];?></td>
											<td><?php  echo $row['courseUnit'];?></td>
											<td><?php  echo $row['levelName'];?></td>
											<td><?php  echo $row['facultyName'];?></td>
											<td><?php  echo $row['departmentName'];?></td>
											<td><?php  echo $row['semesterName'];?></td>
											<td><?php  echo $row['dateAdded'];?></td>
											<td><a href="editCourses.php?editCourseId=<?php echo $row['courseCode'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a>
											<a onclick="return confirm('Are you sure you want to delete?')" href="deleteCourse.php?delid=<?php echo $row['courseCode'];?>" title="Delete Course"><i class="fa fa-trash fa-1x"></i></a></td>
											</tr>
										<?php 
											$cnt=$cnt+1;
										}*/?>                               
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
	<?php include 'script.php';?>
