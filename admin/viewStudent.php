<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if (!$con){
		echo "Database Error!";
		$statusMsg="Database is not connected!";
		header("Location:viewStudent.php?statusMsg=".$statusMsg);
		exit();
	}else{
		//echo "Database is Good!";
		$ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
		tblstudent.dateCreated, tbllevel.levelName,tblfaculty.facultyName,tbldepartment.departmentName,tblsession.sessionName
		from tblstudent
		INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
		INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
		INNER JOIN tblfaculty ON tblfaculty.Id = tblstudent.facultyId
		INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId");
		$cnt=1;
		//$result=mysqli_fetch_array($ret);
	}
?>
	<?php include 'head.php';?>
	<?php $page="student"; include 'includes/leftMenu.php';?>
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
                                    <li class="active">Student</li>
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
							if($statusMsg!='' &&$statusMsg!='An error Occurred!'){
								echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
							}
							else{
								if($statusMsg=='An error Occurred!'){
									echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
								}
							}
						?>
                    </div><!--/.col-->
                    <div class="col-md-12">
                        <div class="card" >
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">All Student</h2></strong>
                            </div>
                            <div class="card-body">
								<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>FullName</th>
                                            <th>ID Number</th>
                                            <th>Year Level</th>
                                            <th>Department</th>
                                            <th>Course</th>
                                            <th>School Year</th>
                                            <th>Date Added</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
										<?php
											while($row=mysqli_fetch_array($ret)) {
										?>
											<tr>
												<td><?php echo $cnt;?></td>
												<td><?php  echo $row['firstName'].' '.$row['otherName'].' '.$row['lastName'];?></td>
												<td><?php  echo $row['matricNo'];?></td>
												<td><?php  echo $row['levelName'];?></td>
												<td><?php  echo $row['facultyName'];?></td>
												<td><?php  echo $row['departmentName'];?></td>
												 <td><?php  echo $row['sessionName'];?></td>
												<td><?php  echo $row['dateCreated'];?></td>
												<td colspan=2><a href="viewStudentProfile.php?viewStudentId=<?php echo $row['matricNo'];?>" title="View Details"><i class="fa fa-eye fa-1x"></i> View</a><br>
												<a href="editStudent.php?editStudentId=<?php echo $row['matricNo'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i> Edit</a><br>
												<a onclick="return confirm('Are you sure you want to delete?')" href="deleteStudent.php?delid=<?php echo $row['matricNo'];?>" title="Delete Student Details"><i class="fa fa-trash fa-1x"></i> Delete</a></td>
											</tr>
										<?php 
											$cnt=$cnt+1;
										}?>                                                  
									</tbody>
								</table>
								<br>
								<a href="createStudent.php" class="btn btn-primary" style="margin-left:15px;"><i class="fa fa-plus" aria-hidden="true"></i> New Student</a>
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