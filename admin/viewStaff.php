<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
 ?>
	<?php include 'head.php';?>
	<?php $page="staff"; include 'includes/leftMenu.php';?>
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
                                    <li class="active">Staff</li>
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
							if($statusMsg!='' && $statusMsg!='An error Occurred!' && $statusMsg!='Administrator or Staff with the StaffID already exist!'){
								echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
							}
							if($statusMsg=='An error Occurred!'|| $statusMsg==' ' || $statusMsg=='Administrator or Staff with the StaffID already exist!' ){
								echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
							}
						?>
                    </div><!--/.col-->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">All Staff</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff ID</th>
                                            <th>Full Name</th>
                                            <th>E-mail</th>
                                            <th>Contact No.</th>
                                            <th>Department</th>
                                            <th>Date Added</th>
                                            <th>Action</th>                                        
                                            </tr>
                                    </thead>
									<tbody>
										<?php
											$ret=mysqli_query($con,"SELECT tblstaff.staffId,tblstaff.firstName, tblstaff.lastName, tblstaff.otherName,
											tblfaculty.facultyName, tblstaff.emailAddress, tblstaff.phoneNo, tblstaff.dateCreated
											from tblstaff
											INNER JOIN tblfaculty ON tblfaculty.Id = tblstaff.facultyId");
											$cnt=1;
											while ($row=mysqli_fetch_array($ret)) {
										?>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['staffId'];?></td>
											<td><?php  echo $row['firstName'].' '.$row['otherName'].' '.$row['lastName'];?></td>
											<td><?php  echo $row['emailAddress'];?></td>
											<td><?php  echo $row['phoneNo'];?></td>
											 <td><?php  echo $row['facultyName'];?></td>
											 
											<td><?php  echo $row['dateCreated'];?></td>
											<td><a href="editStaff.php?editStaffId=<?php echo $row['staffId'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i> Edit</a><br>
											<a onclick="return confirm('Are you sure you want to delete?')" href="deleteStaff.php?delid=<?php echo $row['staffId'];?>" title="Delete Staff Details"><i class="fa fa-trash fa-1x"></i> Delete</a></td>
										</tr>
										<?php 
										$cnt=$cnt+1;
										}
										?>                              
                                    </tbody>
                                </table>
								<br>
								<a href="createStaff.php" class="btn btn-primary" style="margin-left:15px;"><i class="fa fa-plus" aria-hidden="true"></i> New Staff</a>
                            </div>
                        </div>
                    </div>
					
				</div>
			</div>
		</div>
	
		<div class="clearfix"></div>
        <?php include 'includes/footer.php';?>
		</div><!-- /#right-panel -->
		<!-- Right Panel -->
	<?php include 'script.php';?>