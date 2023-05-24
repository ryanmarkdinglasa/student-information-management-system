<?php
    error_reporting(0);
    session_start();

    include('includes/dbconnection.php');
    if(isset($_POST['login'])){
        $staffId = trim($_POST['staffId']);
        $password = trim($_POST['password']);
        $adminType = $_POST['check'];
        $field='';
        // Validate input
        if(empty($staffId) || empty($password)){
            $errorMsg = "<div class='alert alert-danger' role='alert'>Please enter your staff ID and password.</div>";
        } else {
            // Determine which table to query based on the admin type
            if($adminType == 'admin'){
                $tableName = 'tbladmin';
                $redirectUrl = 'admin/index.php';
                $field='staffId';
            } else {
                $tableName = 'tblstudent';
                $redirectUrl = 'student/index.php';
                $field='matricNo';
            }
            // Query the database for the user
            $query = mysqli_prepare($con, "SELECT * FROM $tableName WHERE `".$field."`= ?");
            mysqli_stmt_bind_param($query, 's', $staffId);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            if(mysqli_num_rows($result) == 1){
                // User exists, verify password
                $row = mysqli_fetch_assoc($result);
                if(md5($password)==trim($row['password'])){
                    // Password is correct, log the user in
                    $_SESSION['staffId'] = $row[$field];
                    $_SESSION['emailAddress'] = $row['emailAddress'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['facultyId']=$row['facultyId'];
                    $_SESSION['adminTypeId'] = $row['adminTypeId'];
                    if($_SESSION['adminTypeId'] == 1){ // Administrator
                        header("Location: $redirectUrl");
                        exit();
                    } else { // Syuden
                        header("Location: $redirectUrl");
                        exit();
                    }
                } else {
                    // Password is incorrect
                    $errorMsg = "<div class='alert alert-danger' role='alert'>Incorrect password.</div>";
                }
            } else {
                // User does not exist
                $errorMsg = "<div class='alert alert-danger' role='alert'>Invalid staff ID.</div>";
            }
        }
    }
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Information Management System</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <!-- Favicons -->
	<link href="img/philsca-official-logo.png" rel="icon">
	<link href="img/philsca-official-logo.png" rel="apple-touch-icon">	
    <link rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style2.css">
	<link rel="stylesheet" href="assets/css/w3.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body class="">
	<style>
		body{
			background:rgb(69,69,69);
			font-size:14px;
		}
	</style>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content w3-card-4" style="width:400px;border-radius:7px;">
                <div class="login-logo">
                    <a href="index.html">
                    </a>
                </div>
                <div class="login-form" style="border-radius:7px;">
                    <form method="Post" Action="">
                            <?php echo $errorMsg; ?>
                               <strong><h3 align="center">Sign In</h3></strong><hr>
                        <div class="form-group">
                            <input type="text" name="staffId" Required class="form-control" placeholder="I.D No. or Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" Required class="form-control" placeholder="Password">
                        </div>
						<div class="checkbox">
                           <label class="pull-left">
                                <input type="checkbox" id="check" name="check" value="admin"/><span> Admin</span>
                            </label>
                        </div>
						<br>
                        <div class="checkbox">
                           <label class="pull-right">
                                <button type="submit" name="login" class=" btn-primary" style="width:100px;height:35px;line-height:px;border:none;border-radius:5px;">Sign In</button>
                            </label>
                        </div>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
			<div>
				<center>
					<div class="form-group" >
						<p style="color:#FFF;"><small>Copyright &copy; 2023 Student Information Management System | PHILSCA</small></p>
					</div>
				</center>
			</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
