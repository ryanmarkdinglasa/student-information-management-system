<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg='';
	$levelId='';
	$sessionId='';
	$departmentId='';
	$facultyId='';
?>
	<?php include 'head.php';?>
	<?php $page="print"; include 'includes/leftMenu.php';?>
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
							<!-- Log on to codeastro.com for more projects! -->
                                <ol class="breadcrumb text-right">
                                    <li><a href="./">Dashboard</a></li>
                                    <li class="active">Print Records</li>
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
                                <strong class="card-title"><h3 align="center">Print Records</h3></strong>
							
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <?php
										if($statusMsg!='' &&$statusMsg!='An error Occurred!' && $statusMsg!='The result has aleady been computed for this student for this semester!'){
											echo "<div class='alert alert-success' role='alert'>".$statusMsg."</div>";
										}
										else{
											if($statusMsg!=''){
												echo "<div class='alert alert-danger' role='alert'>".$statusMsg."</div>";
											}
										}
										?>
                                        <form method="Post" action="">
                                            <div class="row">
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
                                        </div>
                                         <div class="row">
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
                                                   <?php
                                                        echo"<div id='txtHint'></div>";
                                                    ?>                                    
                                                 </div>
                                                </div>
                                             </div>
                                                <div>
                                                <button type="submit" name="submit" class="btn btn-primary">View Student</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
					<br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h3 align="center">All Student</h3></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                     <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>ID Number</th>
                                            <th>Level</th>
                                            <th>Deparment</th>
                                            <th>Course</th>
                                            <th>School Year</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
										<?php
											if(isset($_POST['submit']))
											{
												$levelId=$_POST['levelId'];
												$sessionId=$_POST['sessionId'];
												$departmentId=$_POST['departmentId'];
												$facultyId=$_POST['facultyId'];
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
												$cnt=1;
												//$row=mysqli_fetch_array($ret);
												while ($row=mysqli_fetch_array($ret)) {
												?>
												<tr>
												<td><?php echo $cnt;?></td>
												<td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
												<td><?php  echo $row['matricNo'];?></td>
												<td><?php  echo $row['levelName'];?></td>
												<td><?php  echo $row['facultyName'];?></td>
												<td><?php  echo $row['departmentName'];?></td>
												 <td><?php  echo $row['sessionName'];?></td>
												<td><?php  echo $row['dateCreated'];?></td>
												</tr>
												<?php 
												$cnt=$cnt+1;
												}
											}?>                                   
									</tbody>
                                </table>
								<br>
								
								<form action="print/print-record.php" method="POST" target="_blank">
									<input type="hidden" name="print" value="<?php echo isset($_POST['print'])?$_POST['print']:''; ?>">
									<input type="hidden" name="level" value="<?php echo $levelId; ?>">
									<input type="hidden" name="faculty" value="<?php echo $facultyId; ?>">
									<input type="hidden" name="session" value="<?php echo $sessionId; ?>">
									<input type="hidden" name="department" value="<?php echo $departmentId; ?>">
									<button class="btn btn-primary" target="_blank" type="submit" style="margin-left:15px;"><i class="fa fa-file" aria-hidden="true"></i> Print</Button>
							   </form>
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
	<script>
		function generatePDF() {
		  // Get the current page's HTML
		  var pageHTML = document.documentElement.outerHTML;
		  
		  // Send the HTML to the PHP script
		  fetch('generatepdf.php', {
			method: 'POST',
			body: JSON.stringify({html: pageHTML}),
			headers: {
			  'Content-Type': 'application/json'
			}
		  })
		  .then(response => response.blob())
		  .then(blob => {
			// Create a downloadable link and click it
			const url = window.URL.createObjectURL(blob);
			const link = document.createElement('a');
			link.href = url;
			link.download = 'page.pdf';
			document.body.appendChild(link);
			link.click();
			link.remove();
		  });
		}
	</script>
	<?php include 'script.php';?>