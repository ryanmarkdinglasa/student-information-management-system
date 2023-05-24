<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
    $querys = mysqli_query($con,"select * from tbladmin where staffId='$staffId'");
    $rrow = mysqli_fetch_array($querys);
    $statusMsg=$_GET['statusMsg'];
	$photos = $rrow['img'];
	$role =(trim($rrow['adminTypeId'])=='1')?'Administrator':'Staff';
?>
	<?php include 'head.php';?>
	<?php $page="profile"; include 'includes/leftMenu.php';?>
	<style>
		.profile-con{
			/border:1px solid green;
			float:left;
		}
		.profile-con:hover{
			opacity:0.9;
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
                                    <li class="active">Profile</li>
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
						<div class="col-lg-12">
							<?php
										if($statusMsg!='' && $statusMsg!='An error Occurred!'&& $statusMsg!='No image selected!' && $statusMsg!='Uploaded file is not an image!'){
											echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
										}
										else{
											if($statusMsg!=''){
												echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
											}
										}
							?>
						</div><!--/.col-->
						<div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"> My Profile</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
										<div class="content w3-card-4" 
											style="
												border-radius:15px;
												background:rgb(240,242,245)">
											<div class="features">
											  <div class="wow fadeInDown">
													<div class="col-sm-3 profile-con">
														<div class="panel">            
															<div id="img_profile" class="panel-body">
																<a href="" data-target="#studentmodal" data-toggle="modal" >
																	<img title="profile image" class="img-hover" src="<?php if($photos==''){echo '../img/user.jpg';} else{echo $photos;}?>">
																</a>
															</div>
														</div>
													</div>
												<!--/col-3-->
												<div class="col-sm-6 profile-con" > 
													<div class="table-responsive">
														<div class=""><h2>Account Information</h2></div>
														  <table class="table"> 
														<tr>
															  <td><label>Staff ID:</label></td>
															  <td style="pull-left" colspan="5" >
															  <label><?php echo ''.$_SESSION['staffId']?></label>
															 </td>
														</tr>
														<tr>
															<td><label>Name:</label></td>
															<td style="pull-left" colspan="5">
																<label ><?php echo $rrow['firstName'];echo ' '.$rrow['otherName'];echo ' '.$rrow['lastName'];?></label>
															</td>  
														</tr> 
														<tr> 
															<td><label>E-mail:</label></td>
															<td style="pull-left" colspan="5">
																<label> <?php echo $rrow['emailAddress'];?></label> 
															</td>
														</tr>  
														<tr> 
															<td><label>Contact Number:</label></td>
															<td style="pull-left" colspan="5">
																<label><?php echo $rrow['phoneNo'];?></label> 
															</td>
														</tr>  
														<tr> 
															<td><label>Role:</label></td>
															<td style="pull-left" colspan="5">
																<label><?php echo $role;?></label> 
															</td>
														</tr>   
														</table>
														
													</div>
												</div>
												
											  </div> 
											</div><!--/.services-->
											
										</div><!--/.row--> 
										<br>
										<a href="updateProfile.php" class="btn btn-primary" style="margin:20px 0px;"> Update Profile</a>
										<a href="changePassword.php" class="btn btn-primary" style="margin:20px 0px;"> Change Password</a>
										<?php include 'modal.php';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/.col-->
                </div> <!-- .card -->
			</div><!-- .animated -->
		</div><!-- .content -->
	<div class="clearfix"></div>
    <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	<?php include 'script.php';?>
