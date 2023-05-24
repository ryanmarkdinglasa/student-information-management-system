<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	//$query = mysqli_query($con,"SELECT * FROM `tblgrade` WHERE `matricNo`='".$_SESSION['staffId']."'");
	//$rowi = mysqli_fetch_array($query);
	//$id=$rowi['Id'];
?>
		<?php include 'head.php';?>
		<!-- Left Panel -->
			<?php $page="grade"; include 'includes/leftMenu.php';?>
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
										<li class="active">Subject</li>
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
									<?php 
										$query=mysqli_query($con,"SELECT * FROM `tblfaculty` WHERE `Id`='".$_SESSION['facultyId']."'");
										$row=mysqli_fetch_array($query);
									?>
									<strong class="card-title"><h2 align="center">Student Grade</h2></strong>
								</div>
								<div class="card-body">
									<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
										<thead>
											<tr>
												<th>Sem</th>
												<th>Title</th>
												<th>Code</th>
												<th>Unit</th>
												<th>Prelim</th>
												<th>Midterm</th>
												<th>Finals</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$ret=mysqli_query($con,"SELECT * 
												FROM tblgrade
												INNER JOIN tblcourse ON tblcourse.courseCode=tblgrade.subjectCode
												WHERE matricNo = '".$_SESSION['staffId']."';
											");
												$cnt=1;
												while ($row=mysqli_fetch_array($ret)) {
															?>
												<tr>
												<td><?php  if ($row['semesterId']==1){
													echo "First Sem";
												}else{
													echo "Second Sem";
												}
												?></td>
												<td><?php  echo $row['courseTitle'];?></td>
												<td><?php  echo $row['courseCode'];?></td>
												<td><?php  echo $row['courseUnit'];?></td>
												<td><?php  
												if ($row['prelimGrade']!=0){
												echo $row['prelimGrade'];
												}
												?></td>
												<td><?php  if ($row['midtermGrade']!=0){echo $row['midtermGrade'];}?></td>
												<td><?php  	if ($row['finalGrade']!=0){echo $row['finalGrade'];}?></td>
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
		<?php include 'script.php';?>