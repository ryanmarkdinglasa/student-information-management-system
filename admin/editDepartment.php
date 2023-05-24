
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['editid'])){
	$_SESSION['editId'] = $_GET['editid'];
	$query = mysqli_query($con,"select * from tbldepartment where Id='$_SESSION[editId]'");
	$rowi = mysqli_fetch_array($query);
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"index.php\")
			</script>"; 
	}
	if(isset($_POST['submit'])){
		$alertStyle ="";
		$facultyId=$_POST['facultyId'];
		$departmentName=$_POST['departmentName'];
		$dateCreated = date("Y-m-d");
		$ret=mysqli_query($con,"update tbldepartment set departmentName='$departmentName', facultyId='$facultyId' where Id='$_SESSION[editId]'");
		if($ret == TRUE){
			$statusMsg="Course Updated Successfully!";
			header("Location:viewDepartment.php?statusMsg=".$statusMsg);
			exit();
		}
		else {
			$alertStyle ="alert alert-danger";
			$statusMsg="An Error Occurred!";
			header("Location:viewDepartment.php?statusMsg=".$statusMsg);
			exit();
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
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="viewDepartment.php">Courses</a></li>
                                    <li class="active">Edit Courses</li>
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
                                <strong class="card-title"><h2 align="center">Edit Courses</h2></strong>
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
                                                        <input id="" name="departmentName" type="tel" class="form-control cc-cvc" value="<?php echo $rowi['departmentName'];?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Course">
                                                        </div>
                                                    </div>
                                                    <div>

                                                <button type="submit" name="submit" class="btn btn-primary">Update Course</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
                <!--<br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Department</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Department</th>
                                            <th>Faculty</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>                                            
                                            </tr>
                                    </thead>
                                    <tbody>
                                      
                            <?php /*
        $ret=mysqli_query($con,"SELECT tbldepartment.Id,tbldepartment.departmentName,tbldepartment.dateCreated, tblfaculty.facultyName
        from tbldepartment 
        INNER JOIN tblfaculty ON tblfaculty.Id = tbldepartment.facultyId");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['departmentName'];?></td>
                <td><?php  echo $row['facultyName'];?></td>
                <td><?php  echo $row['dateCreated'];?></td>
                <td><a href="editDepartment.php?editid=<?php echo $row['Id'];?>" title="Edit Department"><i class="fa fa-edit fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteDepartment.php?delid=<?php echo $row['Id'];?>" title="Delete Department"><i class="fa fa-trash fa-1x"></i></a></td>
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );

      // Menu Trigger
      $('#menuToggle').on('click', function(event) {
            var windowWidth = $(window).width();   		 
            if (windowWidth<1010) { 
                $('body').removeClass('open'); 
                if (windowWidth<760){ 
                $('#left-panel').slideToggle(); 
                } else {
                $('#left-panel').toggleClass('open-menu');  
                } 
            } else {
                $('body').toggleClass('open');
                $('#left-panel').removeClass('open-menu');  
            } 
                
            }); 

      
  </script>

</body>
</html>
