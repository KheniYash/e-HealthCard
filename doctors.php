<?php 

include 'db.php';
include 'hospital_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_hospital'];

    // FETCH-ALL-VALUE
    $query = " select * from hospital where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);

    // Logout
    if(isset($_POST['logout']))
    {
        // session_destroy();
        unset($_SESSION['$session']);
        header("location:login.php");
    }

?>


<!DOCTYPE html>
<html lang="en">


<!-- doctors23:12-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index-2.html" class="logo">
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Preclinic</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        

                        <?php

                            if(empty($data['IMAGE_PATH']))
                            {
                                ?>
                                    <span class="user-img">
                                        <img class="rounded-circle" src="assets/img/user.jpg" width="70" height="25" alt="user">
                                        <span class="status online"></span>
                                    </span>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <span class="user-img">
                                        <img class="rounded-circle" src="<?php echo $data['IMAGE_PATH']; ?>" width="70" height="25" alt="user">
                                        <span class="status online"></span>
                                    </span>
                                <?php
                            }

                        ?>


                        <span style="padding-left: 4px"><?php echo $data['HOSPITAL_NAME']; ?></span>
                    </a>



					<div class="dropdown-menu">
						<a class="dropdown-item" href="hospital_profile.php">My Profile</a>
						<a class="dropdown-item" href="hospital_editprofile.php">Edit Profile</a>
						<form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="hospital_profile.php">My Profile</a>
                    <a class="dropdown-item" href="hospital_editprofile.php">Edit Profile</a>
                    <form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        
						<li class="active">
                            <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <li>
                            <a href="hospital_patient_registration.php"><i class="fa fa-user"></i> <span>New Case</span></a>
                        </li>
                        <li>
                            <a href="hospital_patient_pending.php"><i class="fa fa-user"></i> <span>Pending Case</span></a>
                        </li>
                        <li>
                            <a href="hospital_endcase.php"><i class="fa fa-user"></i> <span>End Case</span></a>
                        </li>
                        <li>
                            <a href="hospital_patient_pending_payment.php"><i class="fa fa-user"></i> <span>Pending Payment</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-3" >
                        <h4 class="page-title">Doctors</h4>
                    </div>
                    <div class="col-sm-2 text-right m-b-20" >
                        <a href="add_doctors.php" style="font-size: 12px" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add New Doctor</a>
                    </div>
                    <div class="col-sm-2 text-left m-b-20" >
                        <a href="add_registered_doctor.php" style="font-size: 12px" class="btn btn-primary btn-rounded float-left"><i class="fa fa-plus"></i> Registered Doctor</a>
                    </div>
                </div>




				<div class="row doctor-grid">

                    <?php

                        $hospital = $data['HOSPITAL_NAME'];

                        $query = " select count(*) as c from doctor where HOSPITAL = '$hospital' ";
                        $result = mysqli_query($con , $query);
                        $data = mysqli_fetch_assoc($result);

                        if(empty($data['c']))
                        {
                            ?> <h2>  No Doctors Available.....  </h2> <?php
                        }
                        else
                        {
                            $query = " select * from doctor where HOSPITAL = '$hospital' ";
                            $result = mysqli_query($con , $query);

                            while($data = mysqli_fetch_assoc($result))
                            {
                                ?>
                                    <div class="col-md-4 col-sm-4  col-lg-3">
                                        <div class="profile-widget">
                                            <div class="doctor-img">
                                                <a class="avatar" ><img alt="" src="<?php echo $data['IMAGE_PATH']; ?>"></a>
                                            </div>
                                            <div class="dropdown profile-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-doctor.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                            <h4 class="doctor-name text-ellipsis"><a href="profile.html"><?php echo $data['F_NAME']; ?> <?php echo $data['L_NAME']; ?></a></h4>
                                            <div class="doc-prof"><?php echo $data['SPECIALIST']; ?></div>
                                            <div class="user-country">
                                                <i class="fa fa-map-marker"></i> <?php echo $data['STATE']; ?> , <?php echo $data['CITY']; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }

                        }

                    ?>   

                </div>




				
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- doctors23:17-->
</html>