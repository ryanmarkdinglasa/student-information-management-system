<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg']; 
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$facultyId=$_POST['facultyId'];
		$departmentName=$_POST['departmentName'];
		$dateCreated = date("Y-m-d");
		$query=mysqli_query($con,"select * from tbldepartment where facultyId ='$facultyId' and departmentName = '$departmentName'");
		$ret=mysqli_fetch_array($query);
		if($ret > 0){
			$alertStyle ="alert alert-danger";
			$statusMsg="This Course already exist for this Faculty!";
		}
		else{
			$query=mysqli_query($con,"insert into tbldepartment(departmentName,facultyId,dateCreated) value('$departmentName','$facultyId','$dateCreated')");
			if ($query) {
				$alertStyle ="alert alert-success";
				$statusMsg="Course Added Successfully!";
				header("location:viewDepartment.php?statusMsg=".$statusMsg);
				exit();
			}
			else{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("location:viewDepartment.php?statusMsg=".$statusMsg);
				exit();
			}
		}
	}
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
                                    <li><a href="viewDepartment.php">Courses</a></li>
                                    <li class="active">Add Course</li>
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
                                <strong class="card-title"><h2 align="center">Add New Course</h2></strong>
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
                                                <label for="x_card_code" class="control-label mb-1">Department</label>
                                                <?php 
                                                $query=mysqli_query($con,"select * from tblfaculty ORDER BY facultyName ASC");                        
                                                $count = mysqli_num_rows($query);
                                                if($count > 0){                       
                                                    echo ' <select required name="facultyId" class="custom-select form-control">';
                                                    echo'<option value="">--Select Department--</option>';
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    echo'<option value="'.$row['Id'].'" >'.$row['facultyName'].'</option>';
                                                        }
                                                            echo '</select>';
                                                        }
                                                ?>        
                                                </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Course</label>
                                                        <input id="" name="departmentName" type="tel" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Course">
                                                        </div>
                                                    </div>
                                                    <div>

                                                <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
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
