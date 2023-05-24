<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
?>
<?php include 'head.php';?>
<style>
	.layout{
		/:1px solid red;
		padding:10px 10px;
	}
</style>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice layout">
    <!-- title row -->
    <div class="row">
      <div style="margin:0 auto;width:90%">
          <p class="pull-left"><small> Student Information Management System</small></p>
            <p class="pull-right"><small>Printed Date: <?php echo date('m/d/Y'); ?></small></p>
      </div>
      <!-- /.col -->
    </div>
            <div class="center wow fadeInDown"> 
				<center>
                <h2 class="page-header">Student Record</h2>  
				<hr>
                <p class="lead"> 
                 
                </p>
				</div>

                <div class="features">
                  <?php 
                  if (isset($_POST['print'])) {
						$levelId=$_POST['level'];
						$sessionId=$_POST['session'];
						$departmentId=$_POST['department'];
						$facultyId=$_POST['faculty'];
					  if($levelId!=''){
						
                    # code...
                   ?>
                   <table id="dash-table" class="table table-striped table-bordered table-hover "border='1px' style="font-size:12px;text-align:center;" cellspacing="0">
						<thead>
                            <tr>
                                <th>Student Name</th>
                                <th>ID Number</th>
                                <th>Deparment</th>
                                <th>Course and Year</th>
                                <th>School Year</th>
                            </tr>
                        </thead>
						<tbody>
							<?php
								$ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
								tblstudent.dateCreated, tbllevel.levelName,tblfaculty.facultyName,tbldepartment.departmentName,tblsession.sessionName,
								tblstudent.levelId,tblstudent.sessionId,tblstudent.facultyId,tblstudent.departmentId
								from tblstudent
								INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
								INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
								INNER JOIN tblfaculty ON tblfaculty.Id = tblstudent.facultyId
								INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId
								where tblstudent.levelId ='$levelId' and tblstudent.sessionId ='$sessionId' 
								and tblstudent.departmentId ='$departmentId' and tblstudent.facultyId ='$facultyId'");
							while ($row=mysqli_fetch_array($ret)) {
							?>
									<tr>
										<td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
										<td><?php  echo $row['matricNo'];?></td>
										<td><?php  echo $row['facultyName'];?></td>
										<td><?php  echo $row['departmentName'].' - '.$row['levelName'];?></td>
										<td><?php  echo $row['sessionName'];?></td>
									</tr>
							<?php 					
							}
							?>
						</tbody>
                  
					</table> 
                  <?php }else{
                    echo "<center><h2 style='color:red;'>*No Record Found</h2></center>";
                    } }
					?>
                 </div><!--/.services--> 
          
 
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
