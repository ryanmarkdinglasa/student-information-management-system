
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
	error_reporting(0);
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['status']) && $_GET['status'] == "success"){
		$alertStyle ="alert alert-success";
		$statusMsg="School Year Set and Updated Successfully!";
	}
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$sessionName=$_POST['sessionName'];
		$query=mysqli_query($con,"select * from tblsession where sessionName ='$sessionName'");
		$ret=mysqli_fetch_array($query);
		if($ret > 0){
			$alertStyle ="alert alert-danger";
			$statusMsg="This School Year already exist!";
			header("location:createSession.php?statusMsg=$statusMsg");
			exit();
		}
		else{
			$query=mysqli_query($con,"insert into tblsession(sessionName,isActive) value('$sessionName','0')");
			if ($query){
				$alertStyle ="alert alert-success";
				$statusMsg="School Year Added Successfully!";
				header("location:createSession.php?statusMsg=$statusMsg");
				exit();
			}
			else{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("location:createSession.php?statusMsg=$statusMsg");
				exit();
			}
		}
	}
  ?>
		<?php include 'head.php';?>
		<?php $page="session"; include 'includes/leftMenu.php';?>
		<style>
			table{
				text-align:center;
				font-size:13px;
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
										<li class="active">School Year</li>
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
						<div class="col-md-12">
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
							<div class="card">
								<div class="card-header" style="background:rgb(69,69,69);color:white;">
									<strong class="card-title"><h2 align="center">All School Year</h2></strong>
								</div>
								<div class="card-body">
									<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>School Year</th>
												<th>Status</th>
												<th>Make Active</th>
												<th>Action</th>
												                                          
												</tr>
										</thead>
										<tbody>
										<?php
											$ret=mysqli_query($con,"SELECT * from tblsession");
											$cnt=1;
											while ($row=mysqli_fetch_array($ret)) {
														?>
											<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['sessionName'];?></td>
											<td><?php  if($row['isActive'] == 1){ echo "Active";}else{ echo "InActive";}?></td>
											<td ><a href="activateSession.php?activateId=<?php echo $row['Id'];?>" title="Activate School Year"><i class="fa fa-check fa-1x"></i></a></td>
											<td style="text-align:center;"><a href="editSession.php?editid=<?php echo $row['Id'];?>" title="Edit School Year Details"><i class="fa fa-edit fa-1x"></i> Edit</a>
											&nbsp;&nbsp;&nbsp;
											<a onclick="return confirm('Are you sure you want to delete?')" href="deleteSession.php?delid=<?php echo $row['Id'];?>" title="Delete School Year"><i class="fa fa-trash fa-1x"></i> Delete</a></td>
											</tr>
										<?php 
											$cnt=$cnt+1;
										}?>                                 
										</tbody>
									</table>
									
								<br>
								<a href="createSession.php" class="btn btn-primary" style="margin-left:15px;"><i class="fa fa-plus" aria-hidden="true"></i> New School Year</a>
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
