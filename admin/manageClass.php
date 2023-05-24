
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['editid'])){
	$_SESSION['editId'] = $_GET['editid'];
	$query = mysqli_query($con,"SELECT * FROM `tblclass` WHERE `Id`='$_SESSION[editId]'");
	$rowi = mysqli_fetch_array($query);
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"index.php\")
			</script>"; 
	}
    if(isset($_POST['addsubject'])){
        $classCode = $_SESSION['editId'];
        $subjectCode = $_POST['subjectCode']; // retrieve array of subject codes
        $dateCreated = date("Y-m-d");
        //foreach ($subjectCodes as $subjectCode) { // loop through each subject code
            $query = mysqli_query($con, "SELECT * FROM `tblcourse` WHERE `courseCode`='".$subjectCode."'");
            if($query === false){
                $statusMsg= 'An Error Occured while fetching data from tblsubject!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            if(mysqli_num_rows($query) == 0){
                $statusMsg= 'The subject ['.$subjectCode.'] doesnt exist!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            $query = mysqli_query($con, "SELECT * FROM `tblclass_sub` WHERE `subjectCode`='".$subjectCode."'");
            if($query === false){
                $statusMsg= 'An Error Occured while fetching data from tblsubject!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            if(mysqli_num_rows($query) != 0){
                $statusMsg= 'The subject ['.$subjectCode.'] is already added!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            $sql = "INSERT INTO `tblclass_sub`(`classId`,`subjectCode`,`dateCreated`) VALUES('$classCode','$subjectCode','$dateCreated')";
            $query = mysqli_query($con,$sql);
            if($query === false){
                $statusMsg= 'An Error Occured while inserting data into tblclass_sub!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
       // }
        $statusMsg= 'Add Subject to the Class is successful!';
        header("location:viewClass.php?statusMsg=".$statusMsg);
        exit();
    }
    if(isset($_POST['addstudent'])){
        $classCode = $_SESSION['editId'];
        $idno = $_POST['idno']; // retrieve array of subject codes
        $dateCreated = date("Y-m-d");
        //foreach ($subjectCodes as $subjectCode) { // loop through each subject code
            $query = mysqli_query($con, "SELECT * FROM `tblstudent` WHERE `matricNo`='".$idno."'");
            if($query === false){
                $statusMsg= 'An Error Occured while fetching data from tblstudent!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            if(mysqli_num_rows($query) == 0){
                $statusMsg= 'The student with  ID No.['.$idno.'] doesnt exist!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            $query = mysqli_query($con, "SELECT * FROM `tblclass_stud` WHERE `matricNo`='".$idno."'");
            if($query === false){
                $statusMsg= 'An Error Occured while fetching data from tblstudent!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            if(mysqli_num_rows($query) != 0){
                $statusMsg= 'The student with  ID No.['.$idno.'] is already added!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
            $sql = "INSERT INTO `tblclass_stud`(`classId`,`matricNo`,`dateCreated`) VALUES('$classCode','$idno','$dateCreated')";
            $query = mysqli_query($con,$sql);
            if($query === false){
                $statusMsg= 'An Error Occured while inserting data into tblclass_stud!';
                header("location:viewClass.php?statusMsg=".$statusMsg);
                exit(); // exit the loop if an error occurs
            }
       // }
        $statusMsg= 'Add Student to the Class is successful!';
        header("location:viewClass.php?statusMsg=".$statusMsg);
        exit();
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
                            <div class="card-header"  style="background:rgb(69,69,69);color:white;">
                                <strong class="card-title"><h2 align="center">Add Subject to a Class</h2></strong>
                            </div>
                            <div class="card-body">
                            <form method="POST" action="">
                                <!--<button type="button" name="add_subjects" onclick="add_subject_input();" style="margin-left:15px;" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Subject Code</button>
                                <br>-->
                                <div id="subject-inputs">
                                    <div class="col-6">
                                        <label for="x_card_code" class="control-label mb-1">Subject Code</label>
                                        <input name="subjectCode" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Subject Code">
                                    </div>
                                </div>
                                <br>
                               <button type="submit" name="addsubject" style="margin-left:15px;" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                            </form>
                            </div>
                        </div>
                        
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
                                                WHERE `classId`='".$_SESSION['editId']."'
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
                            <div class="card">
                                <div class="card-header"  style="background:rgb(69,69,69);color:white;">
                                    <strong class="card-title"><h2 align="center">Add Student to a Class</h2></strong>
                                </div>
                                <div class="card-body">
                                <form method="POST" action="">
                                    <!--<button type="button" name="add_subjects" onclick="add_subject_input();" style="margin-left:15px;" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Subject Code</button>
                                    <br>-->
                                    <div id="subject-inputs">
                                        <div class="col-6">
                                            <label for="x_card_code" class="control-label mb-1">ID Number</label>
                                            <input name="idno" type="number" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="I.D. No.">
                                        </div>
                                    </div>
                                    <br>
                                <button type="submit" name="addstudent" style="margin-left:15px;" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                                </form>
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
                            WHERE tblclass_stud.classId =".$_SESSION['editId'].";
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
