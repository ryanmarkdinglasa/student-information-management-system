<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
    include('../includes/functions.php');
	$statusMsg=$_GET['statusMsg'];
    if(isset($_GET['matricNo'])){
        $matricNo = $_GET['matricNo'];
        $stdQuery=mysqli_query($con,"select * from tblstudent where matricNo = '$matricNo'");                        
        $rowStd = mysqli_fetch_array($stdQuery);
    }
    else{
        echo "<script type = \"text/javascript\">
        window.location = (\"studentList.php\");
        </script>";
    }
//------------------------------------ COMPUTE RESULT -----------------------------------------------
	if (isset($_POST['compute'])){
	}//end of POST
?>
	<?php include 'head.php';?>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
            <?php include 'includes/header.php';?>
        <!-- Header-->
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          
                        </div> <!-- .card -->
                    </div><!--/.col-->
               
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h4 align="center"><?php echo  $rowStd['firstName'].' '.$rowStd['lastName']?>&nbsp; - Final Result</h></strong>
                            </div>
                            <div class="card-body">
								<div class="<?php if(isset($alertStyle)){echo $alertStyle;}?>" role="alert"><?php if(isset($statusMsg)){echo $statusMsg;}?></div>
								<table class="table table-hover table-striped table-bordered">
									<thead>
										<tr>
											<th>Full Name</th>
											<th>Matric No.</th>
											<th>Faculty</th>
											<th>Department</th>
											<th>CGPA</th>
											<th>Class of Diploma</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
											tblstudent.dateCreated,tblfaculty.facultyName,tbldepartment.departmentName,tblcgparesult.cgpa,tblcgparesult.classOfDiploma,
											tblstudent.facultyId,tblstudent.departmentId
											from tblcgparesult
											INNER JOIN tblstudent ON tblstudent.matricNo = tblcgparesult.matricNo
											INNER JOIN tblfaculty ON tblfaculty.Id = tblstudent.facultyId
											INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId
											where tblcgparesult.matricNo ='$matricNo'");
											$cnt=1;
											while ($row=mysqli_fetch_array($ret)) {
										?>
											<tr>
											<td bgcolor="#F9D342"><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
											<td bgcolor="#F9D342"><?php  echo $row['matricNo'];?></td>
											<td bgcolor="#F9D342"><?php  echo $row['facultyName'];?></td>
											<td bgcolor="#F9D342"><?php  echo $row['departmentName'];?></td>
											<td bgcolor="#F9D342"><?php  echo $row['cgpa'];?></td>
											<td bgcolor="#F9D342"><?php  echo $row['classOfDiploma'];?></td>
											</tr>
										<?php 
											$cnt=$cnt+1;
										}?>                                                
									</tbody>
								</table>
							<a href="studentList3.php" class="btn btn-primary">Go Back</a>
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