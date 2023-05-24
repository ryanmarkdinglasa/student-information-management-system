<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg']; 
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$facultyId=$_POST['facultyId']; //department
        $departmentId=$_POST['departmentId']; //course
        $sessionId=$_POST['sessionId']; // school-year
        $levelId=$_POST['levelId']; //year-level
        $className=trim($_POST['className']);
		$dateCreated = date("Y-m-d");
		$query=mysqli_query($con,"SELECT * FROM `tblclass` WHERE `departmentId` ='$departmentId' and `classCode` = '$className'");
		$ret=mysqli_fetch_array($query);
		if($ret > 0){
			$alertStyle ="alert alert-danger";
			$statusMsg="This Class already exist for this course!";
		}
		else{
			$query=mysqli_query($con,"INSERT INTO `tblclass`(`classCode`, `facultyId`, `departmentId`, `levelId`, `sessionId`, `dateCreated`) VALUES ('".$className."','".$facultyId."','".$departmentId."','".$levelId."','".$sessionId."','".$dateCreated."')");
			if ($query) {
				$alertStyle ="alert alert-success";
				$statusMsg="Class Added Successfully!";
				header("location:viewClass.php?statusMsg=".$statusMsg);
				exit();
			}
			else{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("location:viewClass.php?statusMsg=".$statusMsg);
				exit();
			}
		}
	}
?>  
	<?php include 'head.php';?>
	<?php $page="class"; include 'includes/leftMenu.php';?>
    <script>
		function showValues(str) {
			if (str == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","ajaxCall2.php?fid="+str,true);
				xmlhttp.send();
			}
		}
	</script>
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
                                    <li><a href="viewDepartment.php">Class</a></li>
                                    <li class="active">Add Class</li>
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
                                <strong class="card-title"><h2 align="center">Add New Class</h2></strong>
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
                                        <form method="POST" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Class Name</label>
                                                        <input id="className" name="className" type="tel" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Class Name">
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
														<label for="x_card_code" class="control-label mb-1">Year Level</label>
														<?php 
															$query=mysqli_query($con,"select * from tbllevel");                        
															$count = mysqli_num_rows($query);
															if($count > 0){                       
																echo ' <select required name="levelId" class="custom-select form-control">';
																echo'<option value="">--Select Level--</option>';
																while ($row = mysqli_fetch_array($query)) {
																echo'<option value="'.$row['Id'].'" >'.$row['levelName'].'</option>';
																	}
																		echo '</select>';
															}
														?>   
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Department</label>
                                                    <?php 
                                                    $query=mysqli_query($con,"select * from tblfaculty ORDER BY facultyName ASC");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required name="facultyId" onchange="showValues(this.value)" class="custom-select form-control">';
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
                                                    <div class="form-group">
                                                        <label for="x_card_code" class="control-label mb-1">School Year</label>
                                                        <?php 
                                                            $query=mysqli_query($con,"select * from tblsession where isActive = 1");                        
                                                            $count = mysqli_num_rows($query);
                                                            if($count > 0){                       
                                                                echo ' <select required name="sessionId" class="custom-select form-control">';
                                                                echo'<option value="">--Select S.Y.--</option>';
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                echo'<option value="'.$row['Id'].'" >'.$row['sessionName'].'</option>';
                                                                }
                                                                echo '</select>';
                                                            }
                                                        ?>   
                                                    </div>
                                                </div>
                                                 <div class="col-6">
                                                    <div class="form-group">
                                                   <?php
                                                        echo"<div id='txtHint'></div>";
                                                    ?>                                    
                                                 </div>
                                                </div>
                                            </div>


                                                <button type="submit" name="submit" class="btn btn-primary">Add Class</button>
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
