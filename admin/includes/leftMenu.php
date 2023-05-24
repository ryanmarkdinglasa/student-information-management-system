<?php
	include('../includes/dbconnection.php');
    include('../includes/session.php');
	//include('../includes/dataValues.php');
	error_reporting(0);
	$con=mysqli_connect("localhost", "root", "", "dbsims") or die("Database Connection Error!".mysqli_error());
	$query = mysqli_query($con,"select * from tbladmin where staffId='$staffId'");
	$row = mysqli_fetch_array($query);
	$staffFullName = $row['firstName'].' '.$row['lastName'];
?>
<style>
.actives{
	color:red;
}
#left-panel,#main-menu,#main-menu li a,#main-menu li a i{
	background:rgb(69,69,69);
	//color:#fff;
}
.sub-menu li{
	background:rgb(240,242,245);
}
.deactive{
	color:white;
}
.d{
	background:red;
}
.actives{
	background:#FFF;
	
}
</style>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="menu-title" style="color:white;">ADMIN:&nbsp;<?php echo $staffFullName;?></li>
                    <li class="<?php if($page=='dashboard'){ echo 'active';}?>">
                        <a href="index.php" style=" <?php if($page=='dashboard'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"><i class="menu-icon fa fa-dashboard" 
						style="display:block;<?php if($page=='dashboard'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Dashboard </a>
                    </li>
                    <li class=" dropdown <?php if($page=='admin'){ echo 'active'; }else{'deactive';}?>">
                        <a href="viewAdmin.php" class="dropdown-toggle "
						style="<?php if($page=='admin'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"><i class="menu-icon fa fa-user "
						style="<?php if($page=='admin'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Admin</a>
                    </li>  
					<li class="dropdown <?php if($page=='session'){ echo 'active'; }?>">
						<a href="viewSession.php" class="dropdown-toggle" style="<?php if($page=='session'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-cogs" style="<?php if($page=='session'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>School Year</a>
					</li>
                    <li class="dropdown <?php if($page=='faculty'){ echo 'active'; }?>">
                        <a href="viewFaculty.php" class="dropdown-toggle" 
						style="<?php if($page=='faculty'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-th" 
						style="<?php if($page=='faculty'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>">
						</i>Departments</a>
                    </li>
                    <li class=" dropdown <?php if($page=='department'){ echo 'active'; }?>">
                        <a href="viewDepartment.php" class="dropdown-toggle" style="<?php if($page=='department'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-bars" style="<?php if($page=='department'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Courses</a>
                    </li>
                    <li class=" dropdown <?php if($page=='student'){ echo 'active'; }?>">
                        <a href="viewStudent.php" class="dropdown-toggle" style="<?php if($page=='student'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-users" style="<?php if($page=='student'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Student</a>
                        <!--<ul class="sub-menu children dropdown-menu" style="background:rgb(240,242,245);">
                            <li><i class="fa fa-plus"></i> <a href="createStudent.php">Add New Student</a></li>
                            <li><i class="fa fa-eye"></i> <a href="viewStudent.php">View Student</a></li>
                        </ul>-->
                    </li>
                    <li class="dropdown <?php if($page=='courses'){ echo 'active'; }?>">
                        <a href="viewCourses.php" class="dropdown-toggle" style="<?php if($page=='courses'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-book " style="<?php if($page=='courses'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Subjects</a>
                    </li>
                    <li class="dropdown <?php if($page=='class'){ echo 'active'; }?>">
                        <a href="viewClass.php" class="dropdown-toggle" style="<?php if($page=='class'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-th-large " style="<?php if($page=='class'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Class</a>
                    </li>
                    <li class="dropdown <?php if($page=='grade'){ echo 'active'; }?>">
                        <a href="viewGrades.php" class="dropdown-toggle" style="<?php if($page=='grade'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-line-chart " style="<?php if($page=='grade'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Grade</a>
                    </li>
                    <li class="dropdown <?php if($page=='print'){ echo 'active'; }?>">
                        <a href="studentList.php" class="dropdown-toggle" style="<?php if($page=='print'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-file " style="<?php if($page=='print'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Print Records</a>
                    </li>
                    <li class="dropdown <?php if($page=='profile'){ echo 'active'; }?>">
                        <a href="viewProfile.php" class="dropdown-toggle" style="<?php if($page=='profile'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"> <i class="menu-icon fa fa-user-circle" style="<?php if($page=='profile'){ echo 'background:rgb(250,250,250);';}
						else{echo 'color:#FFF;';}?>"></i>Profile</a>
                         <li>
                        <a href="logout.php" style="color:#FFF;"> <i class="menu-icon fa fa-power-off" style="color:#FFF;"></i>Logout </a>
                    </li>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
	