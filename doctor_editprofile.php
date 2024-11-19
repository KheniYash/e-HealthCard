<?php 

include 'db.php';
include 'doctor_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_doctor'];

    // FETCH-ALL-VALUE
    $query = " select * from doctor where U_NAME='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);



    // UPDATE_DATE
    if(isset($_POST['save']))
    {
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $pin = $_POST['pin'];
        $specialist = $_POST['specialist'];
        $biography = $_POST['biography'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        if( empty($dob) || empty($contact) || empty($state) || empty($city) || empty($address) || empty($pin) || empty($specialist) || empty($biography) || empty($password) || empty($c_password) )
        {
            $empty = " * Plz Fill All The Empty Fields";
        }
        else
        {
            if($password != $c_password)
            {
                $pass = " * Both Password Not Same";
            }
            else
            {

                // PHOTO-UPLOAD
                // $email = $data['EMAIL'];
                $random = rand(10000001,99999999);
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                

                if(empty($filename))
                {
                    $query = " update doctor set DOB='$dob',CONTACT='$contact',STATE='$state',CITY='$city',ADDRESS='$address',PIN='$pin',SPECIALIST='$specialist',BIO='$biography',PASSWORD='$password' where U_NAME='$session' ";
                        mysqli_query($con,$query);

                        header("location:doctor_editprofile.php");
                }
                else
                {

                        // PHOTO-REMOVE
                        if(empty($data['IMAGE_PATH']))
                        {

                        }
                        else
                        {
                            $path = $data['IMAGE_PATH'];
                            unlink($path);
                        }

                        $folder = 'doctor/'.$session.'/'.'1.'.$random.'.'.$filename;
                        move_uploaded_file($tempname, $folder);

                        $query = " update doctor set DOB='$dob',CONTACT='$contact',STATE='$state',CITY='$city',ADDRESS='$address',PIN='$pin',SPECIALIST='$specialist',BIO='$biography',PASSWORD='$password',IMAGE_PATH='$folder' where U_NAME='$session' ";
                        mysqli_query($con,$query);

                        header("location:doctor_editprofile.php");
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
						<a class="dropdown-item" href="doctor_profile.php">My Profile</a>
						<a class="dropdown-item" href="doctor_editprofile.php">Edit Profile</a>
						<form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="doctor_profile.php">My Profile</a>
                    <a class="dropdown-item" href="doctor_editprofile.php">Edit Profile</a>
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
                            <a href="doctor_check_patient.php"><i class="fa fa-user-md"></i> <span>Check Patient</span></a>
                        </li>

                        <li>
                            <a href="doctor_patient_info.php"><i class="fa fa-user-md"></i> <span>Find Patient Info</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">

                                    <?php
                                        if(empty($data['IMAGE_PATH']))
                                        {
                                            ?><img class="inline-block" src="assets/img/user.jpg" alt="user"><?php
                                        }
                                        else
                                        {
                                            ?><img class="inline-block" src="<?php echo $data['IMAGE_PATH']; ?>" alt="user"><?php
                                        }
                                    ?>

                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" name="uploadfile" type="file">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" name="f_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $data['F_NAME']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" name="l_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $data['L_NAME']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating datetimepicker" ONCLICK="ShowAndHide()" name="dob" type="text" value="<?php echo $data['DOB']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Contact</label>
                                                <input type="text" name="contact" class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $data['CONTACT']; ?>">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="card-box">
                        <h3 class="card-title">Residential Informations</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">State</label>
                                    <input type="text" name="state" ONCLICK="ShowAndHide()" value="<?php echo $data['STATE']; ?>" class="form-control floating" value="4487 Snowbird Lane">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">City</label>
                                    <input type="text" name="city" ONCLICK="ShowAndHide()" value="<?php echo $data['CITY']; ?>" class="form-control floating" value="4487 Snowbird Lane">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" name="address" ONCLICK="ShowAndHide()" value="<?php echo $data['ADDRESS']; ?>" class="form-control floating" value="New York">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Pin</label>
                                    <input type="text" name="pin" ONCLICK="ShowAndHide()" value="<?php echo $data['PIN']; ?>" class="form-control floating" value="New York">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card-box">
                        <h3 class="card-title">Working Area</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Specialist</label>
                                    <input type="text" name="specialist" ONCLICK="ShowAndHide()" value="<?php echo $data['SPECIALIST']; ?>" class="form-control floating" value="Oxford University">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Biography</label>
                                    <input type="text" name="biography" ONCLICK="ShowAndHide()" value="<?php echo $data['BIO']; ?>" class="form-control floating" value="Computer Science">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card-box">
                        <h3 class="card-title">Private Informations</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Password</label>
                                    <input type="password" name="password" ONCLICK="ShowAndHide()" value="<?php echo $data['PASSWORD']; ?>" class="form-control floating" value="Oxford University">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Confirm Password</label>
                                    <input type="password" name="c_password" ONCLICK="ShowAndHide()" value="<?php echo $data['PASSWORD']; ?>" class="form-control floating" value="Computer Science">
                                </div>
                            </div>

                            <div class="col-md-6" style="color: red ; font-family: monospace;font-size: 12px ; margin-left: 3px" id="error">
                                    <?php
                                        if(isset($empty)) { echo $empty; } 
                                        if(isset($pass)) { echo $pass; }
                                    ?>
                            </div>

                        </div>
                    </div>

                    <div class="text-center m-t-20">
                        <input class="btn btn-primary submit-btn" type="submit" value="Save" name="save"/>
                    </div>
                </form>
                   
            </div>
        </div>



    </div>

    <!-- SCRIPT -->
        <script>
            function ShowAndHide() {

                var a = document.getElementById('error');
                a.style.display = 'none';

            }
        </script>

    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>


</body>


<!-- blank-page24:04-->
</html>