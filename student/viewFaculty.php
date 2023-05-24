<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg']; 
?>
    <!-- Left Panel -->
		<?php include 'head.php';?>
		<?php $page="faculty"; include 'includes/leftMenu.php';?>
		<style>
			table{
				/text-align:center;
				font-size:13px;
			}
		</style>
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
                                    <li class="active">Department</li>
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
                            <div class="card-header"  style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">All Department</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Department</th>
                                            <th>Date Created</th>                                       
                                            </tr>
                                    </thead>
                                    <tbody>
                                      
									<?php
										$ret=mysqli_query($con,"SELECT * from tblfaculty ");
										$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {
									?>
										<tr>
										<td><?php echo $cnt;?></td>
										<td><?php  echo $row['facultyName'];?></td>
										<td><?php  echo $row['dateCreated'];?></td>
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
	<!-- Right Panel -->
	<?php include 'script.php';?>