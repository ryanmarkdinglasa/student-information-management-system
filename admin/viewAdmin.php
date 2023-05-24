<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
?>
		<?php include 'head.php';?>
		<?php $page='admin'; include 'includes/leftMenu.php';?>
		<style>
			table{
				/text-align:center;
				font-size:13px;
			}
		</style>
		<!-- /#left-panel -->
		<!-- Left Panel -->
		
		<!-- Right Panel -->
		<div id="right-panel" class="right-panel" style="">
			<!-- Header-->
				<?php include 'includes/header.php';?>
			<!-- /header -->
			<!-- Header-->
			<div class="breadcrumbs">
				<div class="breadcrumbs-inner">
					<div class="row m-0">
						<div class="col-sm-4">
							<div class="page-header float-left">
								<div class="page-title" >
									<h1>Dashboard</h1>
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="page-header float-right">
								<div class="page-title">
									<ol class="breadcrumb text-right">
										<li><a href="./">Dashboard</a></li>
										
										<li class="active">Administrator</li>
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
								if($statusMsg!='' && $statusMsg!='An error Occurred!' && $statusMsg!='Administrator or Staff with the StaffID already exist!'){
									echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
								}
								if($statusMsg=='An error Occurred!'|| $statusMsg==' ' || $statusMsg=='Administrator or Staff with the StaffID already exist!' ){
										echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
									}
							
							?>
							</div><!--/.col-->
							<div class="card">
								<div class="card-header"  style="background:rgb(69,69,69);color:white;">
									<strong class="card-title"> <h2 align="center" >Administrators</h2></strong>
								</div>
								<div class="card-body">
									<!-- Credit Card -->
									<div id="pay-invoice">
										<div class="card-body">
										
											<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered" style="width:;" >
												<thead>
													<tr>
														<th>Staff ID</th>
														<th>Firstname</th>
														<th>Lastname</th>
														<th>E-mail</th>
														<th>Contact No.</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
													$ret=mysqli_query($con,"SELECT * FROM `tbladmin`");
													$cnt=1;
													while ($row=mysqli_fetch_array($ret)) {
												?>
													<tr>
													<td><?php  echo $row['staffId'];?></td>
													<td><?php  echo $row['firstName'];?></td>
													<td><?php  echo $row['lastName'];?></td>
													<td><?php  echo $row['emailAddress'];?></td>
													<td><?php  echo $row['phoneNo'];?></td>
													<td>
													<?php if( $_SESSION['staffId']!= $row['staffId']){?>
													<a onclick="return confirm('Are you sure you want to delete?')" href="deleteAdmin.php?delid=<?php echo $row['staffId'];?>" title="Delete Admin"><i class="fa fa-trash fa-1x"></i> Delete</a> </td>
													<?php }else{echo "Online";}?>
													</tr>
													<?php 
													$cnt=$cnt+1;
													}?>          
													</tbody>
											</table>
											<br>
											<a href="createAdmin.php" class="btn btn-primary" style="margin-left:15px;"><i class="fa fa-plus" aria-hidden="true"></i> New Admin</a>
										</div>
									</div>
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
