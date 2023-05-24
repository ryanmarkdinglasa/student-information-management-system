
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	$query = mysqli_query($con,"SELECT * FROM `tblclass_stud` WHERE `matricNo`='".$_SESSION['staffId']."'");
	$rowi = mysqli_fetch_array($query);
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
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="viewClass.php">Class</a></li>
                                    <li class="active">Manage Class</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
           var num_subject_fields = 1;
            function add_subject_input() {
                var input_div = document.createElement('div');
                input_div.className = 'col-6';
                var input_field = document.createElement('input');
                input_field.type = 'text';
                input_field.className = 'form-control cc-cvc';
                input_field.style = 'margin-top:10px;';
                input_field.name = 'subjectCodes[' + num_subject_fields + ']';
                input_field.placeholder = 'Subject Code';
                input_field.required = true;
                input_div.appendChild(input_field);
                var parent_div = document.getElementById('subject-inputs');
                parent_div.appendChild(input_div);
                num_subject_fields++;
            }
        </script>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
								<div class="card-header" style="background:rgb(69,69,69);color:white;">
									<strong class="card-title"><h2 align="center">Class Subjects</h2></strong>
								</div>
								<div class="card-body">
									<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Title</th>
												<th>Code</th>
												<th>Unit</th>
												<th>Year Level</th>
												<th>Semester</th>
												<th>Date Added</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$ret=mysqli_query($con,"SELECT *,tblcourse.courseTitle,tblcourse.dateAdded,
												tblcourse.courseUnit,tbllevel.levelName,tblsemester.semesterName
												FROM `tblclass_sub`
                                                INNER JOIN tblcourse ON tblcourse.courseCode= tblclass_sub.subjectCode
                                                INNER JOIN tbllevel ON tbllevel.Id = tblcourse.levelId
												INNER JOIN tblsemester ON tblsemester.Id = tblcourse.semesterId
                                                WHERE `classId`='".$rowi['classId']."'
												");
												$cnt=1;
												while ($row=mysqli_fetch_array($ret)) {
															?>
												<tr>
												<td><?php echo $cnt;?></td>
												<td><?php  echo $row['courseTitle'];?></td>
												<td><?php  echo $row['courseCode'];?></td>
												<td><?php  echo $row['courseUnit'];?></td>
												<td><?php  echo $row['levelName'];?></td>
												<td><?php  echo $row['semesterName'];?></td>
												<td><?php  echo $row['dateAdded'];?></td>
												</tr>
											<?php 
												$cnt=$cnt+1;
											}?>						
										</tbody>
									</table>
								</div>
							</div>

                            <?php
                            $ret=mysqli_query($con,"SELECT *,tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
                            tblstudent.dateCreated, tbllevel.levelName,tbldepartment.departmentName,tblsession.sessionName
                            from tblclass_stud
                            INNER JOIN tblstudent ON tblstudent.matricNo = tblclass_stud.matricNo
                            INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
                            INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
                            INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId
                            WHERE tblclass_stud.classId =".$rowi['classId'].";
                            ");
                            $cnt=1;
                            ?>
                            <div class="card" >
                            <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">Class Student</h2></strong>
                            </div>
                            <div class="card-body">
								<table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>FullName</th>
                                            <th>ID Number</th>
                                            <th>Year Level</th>
                                            <th>Course</th>
                                            <th>School Year</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
										<?php
											while($row=mysqli_fetch_array($ret)) {
										?>
											<tr>
												<td><?php echo $cnt;?></td>
												<td><?php  echo $row['firstName'].' '.$row['otherName'].' '.$row['lastName'];?></td>
												<td><?php  echo $row['matricNo'];?></td>
												<td><?php  echo $row['levelName'];?></td>
												<td><?php  echo $row['departmentName'];?></td>
												<td><?php  echo $row['sessionName'];?></td>
                                            </tr>
										<?php 
											$cnt=$cnt+1;
										}?>                                                  
									</tbody>
								</table>
                            </div>
                        </div>
                        </div>
                    </div><!--/.col-->
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
