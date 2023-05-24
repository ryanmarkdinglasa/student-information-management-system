<?php
    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);
    $querys = mysqli_query($con,"select * from tblstaff where staffId='$staffId'");
    $rrow = mysqli_fetch_array($querys);
    $statusMsg=$_GET['statusMsg']; 
	if(isset($_POST['submit'])){
		$alertStyle="";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$othername=$_POST['othername'];
		$emailAddress=$_POST['emailAddress'];
		$phoneNo=$_POST['phoneNo'];
		$ret=mysqli_query($con,"update tblstaff set firstName='$firstname', lastName='$lastname', otherName='$othername', 
			emailAddress='$emailAddress', phoneNo='$phoneNo' where staffId='$staffId'");
		if($ret == TRUE){
			$alertStyle ="alert alert-success";
			$statusMsg="Profile Updated Successfully!";
			header("location:viewProfile.php?statusMsg=".$statusMsg);
			exit();
		}
		else{
			$alertStyle ="alert alert-danger";
			$statusMsg="An error Occurred!";
			header("location:updateProfile.php?statusMsg=".$statusMsg);
			exit();
		}
	}
?>
	<?php include 'head.php';?>
	<?php $page="profile"; include 'includes/leftMenu.php';?>
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
                                    <li><a href="viewProfile.php">Profile</a></li>
                                    <li class="active">Update Information</li>
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
                                <strong class="card-title">Update Profile Information</strong>
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
                                                        <label for="cc-exp" class="control-label mb-1">Firstname</label>
                                                        <input id="" name="firstname" type="tel" class="form-control cc-exp" value="<?php echo $rrow['firstName'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="First Name">
                                                    </div>
                                                </div>
												<div class="col-6">
													<div class="form-group">
														<label for="cc-exp" class="control-label mb-1">Middle Name</label>
														<input id="" name="othername" type="text" class="form-control cc-exp" value="<?php echo $rrow['otherName'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Middle Name">
													</div>
												</div>
                                            </div>
                                            <div>
												<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label for="x_card_code" class="control-label mb-1">Lastname</label>
																<input id="" name="lastname" type="tel" class="form-control cc-cvc" value="<?php echo $rrow['lastName'];?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Last Name">
															</div>
														</div>
													<div class="col-6">
														<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Email Address</label>
															<input id="" name="emailAddress" type="email" class="form-control cc-cvc" value="<?php echo $rrow['emailAddress'];?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
														</div>
													</div>
												</div>
												<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Phone Number</label>
																<input id="" name="phoneNo" type="number" class="form-control cc-exp" value="<?php echo $rrow['phoneNo'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number">
															</div>
														</div>
												</div>
                                                <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
				</div>
			</div><!-- .animated -->
		</div><!-- .content -->
		<div class="clearfix"></div>
        <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include 'script.php';?>
