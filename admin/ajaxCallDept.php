<?php
    error_reporting(0);
    include('../includes/dbconnection.php');

    $fid = intval($_GET['fid']);//gradeId

        $queryss=mysqli_query($con,"select * from tbldepartment where facultyId=".$fid." ORDER BY departmentName ASC");                        
        $countt = mysqli_num_rows($queryss);

        if($countt > 0){                       
        echo '<label for="select" class=" form-control-label">Select Course</label>
        <select required name="departmentId" class="custom-select form-control">';
        echo'<option value="">--Select Course--</option>';
        while ($row = mysqli_fetch_array($queryss)) {
        echo'<option value="'.$row['Id'].'" >'.$row['departmentName'].'</option>';
        }
        echo '</select>';
        }

?>
