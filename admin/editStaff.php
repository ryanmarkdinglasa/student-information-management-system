
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['editStaffId'])){
	$_SESSION['editStaffId'] = $_GET['editStaffId'];
	$query = mysqli_query($con,"select * from tblstaff where staffId='$_SESSION[editStaffId]'");
	$rowi = mysqli_fetch_array($query);
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"createStaff.php\")
			</script>"; 
	}
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$othername=$_POST['othername'];
		$emailAddress=$_POST['emailAddress'];
		$phoneNo=$_POST['phoneNo'];
		$newStaffId=$_POST['staffId'];
		$dateCreated = date("Y-m-d");
		$ret=mysqli_query($con,"update tblstaff set firstName='$firstname', lastName='$lastname', otherName='$othername', 
		emailAddress='$emailAddress', phoneNo='$phoneNo', staffId='$newStaffId'
		where staffId='$_SESSION[editStaffId]'");
		if($ret == TRUE){
			$alertStyle ="alert alert-success";
			$statusMsg="Staff Updated Successfully!";
			header("Location:viewStaff.php?statusMsg=".$statusMsg);
			exit();
		}
		else {
		  $alertStyle ="alert alert-danger";
		  $statusMsg="An Error Occurred!";
		  header("Location:viewStaff.php?statusMsg=".$statusMsg);
		  exit();
		}
	}
?>
	<?php include "head.php";?>
	<?php $page="staff"; include 'includes/leftMenu.php';?>
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
                                    <li><a href="viewStaff.php">Staff</a></li>
                                    <li class="active">Edit Staff</li>
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
                                <strong class="card-title"><h2 align="center">Edit Staff</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Firstname</label>
                                                        <input id="" name="firstname" type="tel" class="form-control cc-exp" value="<?php echo $rowi['firstName']?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Lastname</label>
                                                        <input id="" name="lastname" type="tel" class="form-control cc-cvc" value="<?php echo $rowi['lastName']?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname">
                                                        </div>
                                                    </div>
                                                    <div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Othername</label>
                                                        <input id="" name="othername" type="text" class="form-control cc-exp" value="<?php echo $rowi['otherName']?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Othername">
                                                    </div>
                                                </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Email Address</label>
                                                    <input id="" name="emailAddress" type="email" class="form-control cc-cvc" value="<?php echo $rowi['emailAddress']?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Phone Number</label>
                                                        <input id="" name="phoneNo" type="text" class="form-control cc-exp" value="<?php echo $rowi['phoneNo']?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number">
                                                    </div>
                                                </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Staff ID</label>
                                                    <input id="" name="staffId" type="text" class="form-control cc-cvc" value="<?php echo $rowi['staffId']?>" data-val="true" Required data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="StaffID">
                                                </div>
                                            </div>
                                        </div>
                                                <button type="submit" name="submit" class="btn btn-primary">Update Staff</button>
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
	<?php include "script.php";?>