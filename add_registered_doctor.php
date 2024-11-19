<?php 

include 'db.php';
include 'hospital_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_hospital'];

    // FETCH-ALL-VALUE
    $query = " select * from hospital where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);


    // Search
    if(isset($_POST['search']))
    {
        $uname = $_POST['uname'];

        if(empty($uname))
        {
            $empty = "empty";
        }
        else
        {
            $check = " select count(*) as c from doctor where U_NAME='$uname' ";
            $checkre = mysqli_query($con , $check);
            $checkda = mysqli_fetch_assoc($checkre);

            if(empty($checkda['c']))
            {
                $notfound = "notfound";
            }
            else
            {

                $h_name = $data['HOSPITAL_NAME'];
                $already = "select count(*) as k from doctor where U_NAME='$uname' && HOSPITAL='$h_name' ";
                $alreadyre = mysqli_query($con , $already);
                $alreadyda = mysqli_fetch_assoc($alreadyre);

                if(empty($alreadyda['k']))
                {
                    $found = "";
                    $_SESSION['uname_doctor']=$uname;
                    header("location:add_registered_doctor_second.php");
                }
                else
                {
                    $alreadyregi = "already registered";
                }





                
                
            }
        }
    }

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
                


                <form method="post">
             
               <div class="row">
                    <div class="col-sm-12">
                        <h4 style="font-family: monospace;" class="page-title">Find Registered Doctor</h4>
                    </div>
                </div>

            
                <div class="row filter-row">
                    <div class="col-sm-9">
                        <div class="form-group form-focus">
                            <label class="focus-label">Enter User Name</label>
                            <input type="text" id="uname" ONCLICK="ShowAndHide()" maxlength="19" name="uname" class="form-control floating">
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <button name="search" id="search" class="btn btn-success btn-block">Search</button>
                    </div>
                </div>


            <div style="position: relative;">

                <?php
                    
                      if(isset($empty))
                        {
                            ?>
                                <div id="error" class="row" style="position: absolute;">
                                    <div class="col-sm-12" style="margin-top: -8px;margin-left: 3px">
                                        <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter User Name Of Doctor</b></h4>
                                    </div>
                                </div>
                            <?php
                        }  


                       if(isset($notfound))
                        {
                            ?>
                                <div id="error" class="row" style="position: absolute;">
                                    <div class="col-sm-12" style="margin-top: -8px;margin-left: 3px">
                                        <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Doctor NOT Found In Any Hospital</b></h4>
                                    </div>
                                </div>
                            <?php
                        }   

                        if(isset($alreadyregi))
                        {
                            ?>
                                <div id="error" class="row" style="position: absolute;">
                                    <div class="col-sm-12" style="margin-top: -8px;margin-left: 3px">
                                        <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Doctor Already Registered To Your Hospital</b></h4>
                                    </div>
                                </div>
                            <?php
                        }   

                ?>
                
            </div>

            </form>

				
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function ShowAndHide() {
            var x = document.getElementById('error');
            x.style.display = 'none';
        }
    </script>  

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