<?php
    error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_POST['submit'])){
		$cpassword=md5($_POST['currentpassword']);
		$newpassword=md5($_POST['newpassword']);
		$query=mysqli_query($con,"select * from tbladmin where staffId='$staffId' and password='$cpassword'");
		$row=mysqli_fetch_array($query);
		if($row > 0){
		$ret=mysqli_query($con,"update tbladmin set password='$newpassword' where staffId='$staffId'");
			$alertStyle ="alert alert-success";
			$statusMsg="Password changed successfully!";
			header("location:changePassword.php?statusMsg=$statusMsg");
			exit();
		} 
		else{
		  $alertStyle ="alert alert-danger";
		  $statusMsg="Your current password is wrong!";
		  header("location:changePassword.php?statusMsg=$statusMsg");
		  exit();
		}
	}
  ?>
	<?php include "head.php";?>
    <?php $page="profile"; include 'includes/leftMenu.php';?>
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
                                    <li><a href="viewProfile.php">Profile</a></li>
                                    <li class="active">Change Password</li>
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
                                <strong class="card-title">Change Password</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
									<?php
									if($statusMsg!='' && $statusMsg!='Your current password is wrong!'){
										echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
									}
									else{
										if($statusMsg=='Your current password is wrong!'){
										echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
										}
									}
									?>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Current Password</label>
                                                        <input id="" name="currentpassword" type="password" class="form-control cc-exp" value="" Required placeholder="Current Password">
                                                    </div>
                                                </div>
                                            </div>
											<div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">New Password</label>
															<input id="" name="newpassword" type="password" class="form-control cc-exp" value="" data-val="true" placeholder="New Password">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
														</div>
													</div>
												</div>
												<div class="row">
														<div class="col-6">
															<div class="form-group">
															</div>
														</div>
												</div>
													<button type="submit" name="submit" class="btn btn-primary">Change Password</button>
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