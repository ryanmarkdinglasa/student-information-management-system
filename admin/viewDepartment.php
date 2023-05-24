<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg']; 
?>
	<?php include 'head.php';?>
	<?php $page="department"; include 'includes/leftMenu.php';?>
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
                                    <li class="active">Courses</li>
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
                        <div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">All Courses</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                   <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Courses</th>
                                            <th>Department</th>
                                            <th>Date Created</th>
                                            <th>Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$ret=mysqli_query($con,"SELECT tbldepartment.Id, tbldepartment.departmentName,tbldepartment.dateCreated, tblfaculty.facultyName
											from tbldepartment 
											INNER JOIN tblfaculty ON tblfaculty.Id = tbldepartment.facultyId");
											$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {
										?>
											<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['departmentName'];?></td>
											<td><?php  echo $row['facultyName'];?></td>
											<td><?php  echo $row['dateCreated'];?></td>
											<td colspan=2><a href="editDepartment.php?editid=<?php echo $row['Id'];?>" title="Edit Courses"><i class="fa fa-edit fa-1x"></i> Edit</a><br>
											<a onclick="return confirm('Are you sure you want to delete?')" href="deleteDepartment.php?delid=<?php echo $row['Id'];?>" title="Delete Courses"><i class="fa fa-trash fa-1x"></i> Delete</a></td>
											</tr>
										<?php 
											$cnt=$cnt+1;
										}?>                                
                                    </tbody>
                                </table>
								<br>
								<a href="createDepartment.php" class="btn btn-primary" style="margin-left:15px;"><i class="fa fa-plus" aria-hidden="true"></i> New Courses</a>
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

