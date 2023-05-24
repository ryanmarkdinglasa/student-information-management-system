
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
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
				header("location:viewSession.php?statusMsg=$statusMsg");
				exit();
			}
			else{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("location:viewSession.php?statusMsg=$statusMsg");
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
										<li><a href="viewSession.php">School Year</a></li>
										<li class="active">Add School Year</li>
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
									<strong class="card-title"><h2 align="center">Add New School Year</h2></strong>
								</div>
								<div class="card-body">
									<!-- Credit Card -->
									<div id="pay-invoice">
										<div class="card-body">
											<?php
												if($statusMsg!='' && $statusMsg!='An error Occurred!' && $statusMsg!='This School Year already exist!'){
													echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
												}
												else{
													if($statusMsg=='An error Occurred!' || $statusMsg=='This School Year already exist!'){
														echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
													}
												}
											?>
											<form method="Post" action="">
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">School Year</label>
															<input id="" name="sessionName" type="tel" class="form-control cc-exp" value="" placeholder="S.Y. Name: ( i.e 2022-2023 )">
														</div>
													</div>
												</div>
												<div>
													<button type="submit" name="submit" class="btn btn-primary">Add School Year</button>
												</div>
											</form>
										</div>
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
		<?php include 'script.php';?>
