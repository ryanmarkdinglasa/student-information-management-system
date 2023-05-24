<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');

    $alertStyle = "";
    $statusMsg = "";

    if (isset($_POST['submit'])) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $othername = trim($_POST['othername']);
        $emailAddress = trim($_POST['emailAddress']);
        $phoneNo = trim($_POST['phoneNo']);
        $staffId = trim($_POST['staffId']);
        $password =md5('12345');
        $roleId = 1;
        $dateCreated = date("Y-m-d");
        $dateAssigned = date("Y-m-d");

        // Sanitize user input
        $firstname = mysqli_real_escape_string($con, $firstname);
        $lastname = mysqli_real_escape_string($con, $lastname);
        $othername = mysqli_real_escape_string($con, $othername);
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);
        $phoneNo = mysqli_real_escape_string($con, $phoneNo);
        $staffId = mysqli_real_escape_string($con, $staffId);

        // Check if staffId exists in tbladmin or tblstaff
        $que1 = mysqli_query($con, "SELECT * FROM tbladmin WHERE staffId = '$staffId'");
        $que2 = mysqli_query($con, "SELECT * FROM tblstaff WHERE staffId = '$staffId'");
        $res1 = mysqli_fetch_array($que1);
        $res2 = mysqli_fetch_array($que2);

        if ($res1 || $res2) {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Administrator or Staff with the StaffID already exists!";
        } else {
            $query = mysqli_query($con, "INSERT INTO tbladmin(firstName,lastName,otherName,emailAddress,phoneNo,password,staffId,adminTypeId,isPasswordChanged,dateCreated) VALUES ('$firstname','$lastname','$othername','$emailAddress','$phoneNo','$password','$staffId',$roleId,'0','$dateCreated')");
            if ($query) {
                $alertStyle = "alert alert-success";
                $statusMsg = "Administrator created successfully!";
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred!";
            }
        }
		header("location:viewAdmin.php?statusMsg=$statusMsg");
	}
	
?>

	<?php include 'head.php';?>
	<?php $page="admin"; include 'includes/leftMenu.php';?>
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
			xmlhttp.open("GET","ajaxCall.php?fid="+str,true);
			xmlhttp.send();
		}
	}
	function showRole(str) {
		if (str == "") {
			document.getElementById("txtHintt").innerHTML = "";
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
					document.getElementById("txtHintt").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","ajaxCallRole.php?id="+str,true);
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
                                    <li><a href="viewAdmin.php">Administrator</a></li>
                                    <li class="active">Add Administrator</li>
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
                                <strong class="card-title" ><h2 align="center">Add New Administrator</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
									<div class="card-body">
									<?php
											if($statusMsg=='An error Occurred!'|| 
												$statusMsg=='An Administrator has been Assigned to this Department!'||
												$statusMsg=='Administrator with the StaffID already exist!'
												){
												echo "";
											}
											else{
												if($statusMsg!=''){
													echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
												}
											} 
										?>
									</div>
                                    <div class="card-body">
										
									
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name</label>
                                                        <input id="" name="firstname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Last Name</label>
                                                        <input id="" name="lastname" type="tel" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Last Name">
                                                        </div>
                                            </div>
											<div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="cc-exp" class="control-label mb-1">Middle Name</label>
															<input id="" name="othername" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Middle Name">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Email Address</label>
															<input id="" name="emailAddress" type="email" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
														</div>
													</div>
												</div>
												<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label for="cc-exp" class="control-label mb-1">Phone Number</label>
																<input id="" name="phoneNo" type="number" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number">
															</div>
														</div>
													<div class="col-6">
														<div class="form-group">
															<label for="x_card_code" class="control-label mb-1">Staff ID No.</label>
															<input id="" name="staffId" type="text" class="form-control cc-cvc" value="" data-val="true" Required data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Staff ID Number">
														</div>
													</div>
												</div>
                                                <button type="submit" name="submit" class="btn btn-primary">Add Admin</button>
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
