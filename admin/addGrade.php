
<?php
	error_reporting(0);
    include('../includes/dbconnection.php');
    include('../includes/session.php');
	$statusMsg=$_GET['statusMsg'];
	if(isset($_GET['id'])){
	$_SESSION['Id'] = $_GET['id'];
	$query = mysqli_query($con,"SELECT * FROM `tblclass` WHERE `Id`='$_SESSION[Id]'");
	$rowi = mysqli_fetch_array($query);
    $prelimGrade=0.0;
    $midtermGrade=0.0;
    $finalGrade=0.0;
	}
	else{
		echo "<script type = \"text/javascript\">
			window.location = (\"index.php\")
			</script>"; 
	}
    if(isset($_POST['addsubject'])){
        $classCode = $_SESSION['Id'];
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
            $sql = "INSERT INTO `tblclass_sub`(`classCode`,`subjectCode`,`dateCreated`) VALUES('$classCode','$subjectCode','$dateCreated')";
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
    
?>
	<?php include 'head.php';?>
    <?php $page="grade"; include 'includes/leftMenu.php';?>
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
                                    <li><a href="viewGrades.php">Grade</a></li>
                                    <li class="active">Add Grade</li>
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
                     <?php


  $ret=mysqli_query($con,"SELECT *,tblclass_stud.Id AS csId,tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.matricNo,
  tblstudent.dateCreated, tbllevel.levelName,tbldepartment.departmentName,tblsession.sessionName
  from tblclass_stud
  INNER JOIN tblstudent ON tblstudent.matricNo = tblclass_stud.matricNo
  INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
  INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
  INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId
  WHERE tblclass_stud.classId=".$_SESSION['Id']."
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
                      <th>Prelim</th>
                      <th>Midterm</th>
                      <th>Finals</th>
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
                          <td style="text-align:center">
                          <a href="prelimGrade.php?csid=<?php echo $row['csId'];?>" title="Add Prelim Grade"><i class="fa fa-tasks fa-1x"></i> Input Grade</a></td>
                          <td style="text-align:center">
                          <a href="midtermGrade.php?csid=<?php echo $row['csId'];?>" title="Add Midterm Grade"><i class="fa fa-tasks fa-1x"></i> Input Grade</a></td>
                          <td style="text-align:center">
                          <a href="finalGrade.php?csid=<?php echo $row['csId'];?>" title="Add Final Grade"><i class="fa fa-tasks fa-1x"></i> Input Grade</a></td>
                      </tr>
                  <?php 
                      $cnt=$cnt+1;
                     
                  } 
                  ?>              
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php

                           $ret = mysqli_query($con, "SELECT DISTINCT tblstudent.Id, tblclass_stud.Id AS csId, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName, tblstudent.matricNo,
                                    tblstudent.dateCreated, tbllevel.levelName, tbldepartment.departmentName, tblsession.sessionName
                                    FROM tblclass_stud
                                    INNER JOIN tblstudent ON tblstudent.matricNo = tblclass_stud.matricNo
                                    
                                    INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
                                    INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId
                                    INNER JOIN tbldepartment ON tbldepartment.Id = tblstudent.departmentId
                                    WHERE tblclass_stud.classId = '".$_SESSION['Id']."'");
                            $cnt=1;
                            ?>
                            <div class="card" >
                                <div class="card-header" style="background:rgb(69,69,69);color:white;">
                                    <strong class="card-title"><h2 align="center">Student Grade</h2></strong>
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
                                                <th>Grade</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <?php
                                            while ($row = mysqli_fetch_array($ret)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row['firstName'].' '.$row['otherName'].' '.$row['lastName'];?></td>
                                                    <td><?php echo $row['matricNo'];?></td>
                                                    <td><?php echo $row['levelName'];?></td>
                                                    <td><?php echo $row['departmentName'];?></td>
                                                    <td><?php echo $row['sessionName'];?></td>
                                                    <td><a href="studentGrade.php?id=<?php echo $row['csId'];?>" title="Student Grade"><i class="fa fa-eye fa-1x"></i> View</a></td>
                                                </tr>
                                                <?php 
                                                $cnt = $cnt + 1;
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