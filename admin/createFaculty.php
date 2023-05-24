
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$facultyName=$_POST['facultyName'];
		$dateCreated = date("Y-m-d");
		$query=mysqli_query($con,"select * from tblfaculty where facultyName ='$facultyName'");
		$ret=mysqli_fetch_array($query);
		if($ret > 0){
			$alertStyle ="alert alert-danger";
			$statusMsg="This Department already exist!";
			header("location:createFaculty.php?statusMsg=$statusMsg");
			exit();
		}
		else{
			$query=mysqli_query($con,"insert into tblfaculty(facultyName,dateCreated) value('$facultyName','$dateCreated')");
			if ($query) {
				$alertStyle ="alert alert-success";
				$statusMsg="Department Added Successfully!";
				header("location:viewFaculty.php?statusMsg=$statusMsg");
				exit();
		  }
			else
			{
				$alertStyle ="alert alert-danger";
				$statusMsg="An error Occurred!";
				header("location:createFaculty.php?statusMsg=$statusMsg");
				exit();
			}
		}
	}
?>
	<?php include 'head.php';?>
	<?php $page="faculty"; include 'includes/leftMenu.php';?>
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
                                    <li><a href="viewFaculty.php">Department</a></li>
                                    <li class="active">Add Department</li>
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
                                <strong class="card-title"><h2 align="center" >Add New Department</h2></strong>
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
												if($statusMsg=='An error Occurred!' ||$statusMsg=='This Faculty already exist!' ){
													echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
												}
											}
										?>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Department</label>
                                                        <input id="" name="facultyName" type="tel" class="form-control cc-exp" value="" placeholder="Department Name">
                                                    </div>
                                                </div>
                                                
                                                    </div>
                                                    <div>
                                                <button type="submit" name="submit" class="btn btn-primary">Add Department</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
					<br><br>
                    <!--<div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Faculty</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Faculty</th>
                                            <th>Date Created</th>
                                            <th>Edit</th>
                                            <th>Delete</th>                                           
                                            </tr>
                                    </thead>
                                    <tbody>
									<?php /*
										$ret=mysqli_query($con,"SELECT * from tblfaculty");
										$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {
									?>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['facultyName'];?></td>
											<td><?php  echo $row['dateCreated'];?></td>
											<td><a href="editFaculty.php?editid=<?php echo $row['Id'];?>" title="Edit Faculty Details"><i class="fa fa-edit fa-1x"></i></a></td>
											<td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteFaculty.php?delid=<?php echo $row['Id'];?>" title="Delete Faculty Details"><i class="fa fa-trash fa-1x"></i></a></td>
										</tr>
									<?php 
										$cnt=$cnt+1;
									}
									*/
									?>															
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->
				<!-- end of datatable -->
				</div>
			</div><!-- .animated -->
		</div><!-- .content -->
		<div class="clearfix"></div>
        <?php include 'includes/footer.php';?>
	</div><!-- /#right-panel -->
	<!-- Right Panel -->
	 <?php include 'script.php';?>
