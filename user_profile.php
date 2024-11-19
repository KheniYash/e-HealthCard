<?php 

include 'db.php';
include 'user_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_user'];

    // FETCH-ALL-VALUE
    $query = " select * from user where UNIQUE_ID='$session' ";
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


<!-- blank-page24:04-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>e-Healthcare</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>e-healthcare</span>
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
                        
                        <span style="padding-left: 4px"><?php echo $data['F_NAME']; ?></span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="user_profile.php">My Profile</a>
						<a class="dropdown-item" href="user_editprofile.php">Edit Profile</a>
						<form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user_profile.php">My Profile</a>
                    <a class="dropdown-item" href="user_editprofile.php">Edit Profile</a>
                    <form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="user_add_money.php"><i class="fa fa-dashboard"></i> <span>Add Money</span></a>
                        </li>
                        <li>
                            <a href="user_find_info.php"><i class="fa fa-dashboard"></i> <span>Check Past Info</span></a>
                        </li>
                        <li>
                            <a href="user_pay_pending_payment.php"><i class="fa fa-dashboard"></i> <span>Pay Pending Payment</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>

                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <!-- <a href="edit_profile_admin.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a> -->
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">

                                        <?php
                                            if(empty($data['IMAGE_PATH']))
                                            {
                                                ?><a href="#"><img class="avatar" src="assets/img/user.jpg" alt=""></a><?php
                                            }
                                            else
                                            {
                                                ?><a href="#"><img class="avatar" src="<?php echo $data['IMAGE_PATH']; ?>" alt=""></a><?php
                                            }
                                        ?>

                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5" >
                                            <div class="profile-info-left" style="height: 210px">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $data['F_NAME']; echo " "; echo $data['L_NAME']; ?></h3>
                                                <small class="text-muted">User</small>
                                                <div class="staff-id">UNIQUE-ID : <?php echo $data['UNIQUE_ID']; ?></div>
                                                <div class="staff-msg"><a href="user_editprofile.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a></div>
                                                <!-- <a href="chat.html" class="btn btn-primary">Send Message</a> -->
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">AADHAR:</span>
                                                    <span class="text"><a href="#"><?php echo $data['AADHAR']; ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $data['CONTACT']; ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $data['EMAIL']; ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php echo $data['DOB']; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">State:</span>
                                                    <span class="text"><?php echo $data['U_STATE']; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">City:</span>
                                                    <span class="text"><?php echo $data['U_CITY']; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Blood Group:</span>
                                                    <span class="text"><?php echo $data['BLOOD_GROUP']; ?></span>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>


</body>


<!-- blank-page24:04-->
</html>