<?php 

include 'db.php';
include 'hospital_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_hospital'];

    // FETCH-ALL-VALUE
    $query = " select * from hospital where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);



    //CREATE_DOCTOR
    if(isset($_POST['create']))
    {    

        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $u_name = $_POST['u_name'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];
        $phone = $_POST['phone'];
        $Specialist = $_POST['Specialist'];
        $bio = $_POST['bio'];

        if(empty($f_name) || empty($l_name) || empty($u_name) || empty($email) || empty($dob) || empty($gender) || empty($address) || empty($state) || empty($city) || empty($pin) || empty($phone) || empty($Specialist) || empty($bio))
        {
            $empty = " * Plz Fill All The Fields";
        }
        else
        {
            $hospital = $data['HOSPITAL_NAME'];

            $queryy = " select count(*) as c from doctor where U_NAME = '$u_name' ";
            $resultt = mysqli_query($con , $queryy);
            $dataa = mysqli_fetch_assoc($resultt);

            if(empty($dataa['c']))
            {   

                // PHOTO_UPLOAD
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];

                if(empty($filename))
                {
                    $fileempty = " * Plz Choose Profile Picture";
                }
                else
                {
                    // DOCTOR-PHOTO-FOLDER
                    $dir = 'doctor/'.$u_name;
                    mkdir($dir);

                    $folder = 'doctor/'.$u_name.'/'.'1.'.$random.'.'.$filename;
                    move_uploaded_file($tempname, $folder);

                    $insert = " insert into doctor (F_NAME,L_NAME,HOSPITAL,U_NAME,EMAIL,PASSWORD,DOB,GENDER,ADDRESS,STATE,CITY,PIN,CONTACT,SPECIALIST,BIO,IMAGE_PATH) values ('$f_name','$l_name','$hospital','$u_name','$email','$dob','$dob','$gender','$address','$state','$city','$pin','$phone','$Specialist','$bio','$folder') ";
                    $result = mysqli_query($con , $insert);

                    header("location:doctors.php");
                }
            }
            else
            {
                $already = " * This Is NOT New Doctor, He Is Already Registered Any Hospital ";
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
    <title>e-Healthcare</title>
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input name="f_name" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="l_name" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input name="u_name" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" ONCLICK="ShowAndHide()" class="form-control" type="email">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input name="dob" type="text" ONCLICK="ShowAndHide()" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender:</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" value="male" checked class="form-check-input">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" value="female" class="form-check-input">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="address" ONCLICK="ShowAndHide()" type="text" class="form-control ">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input name="state" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input name="city" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>PIN</label>
                                                <input name="pin" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input name="phone" ONCLICK="ShowAndHide()" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <div class="profile-upload">
                                            <div class="upload-img">
                                                <img alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="upload-input">
                                                <input type="file" name="uploadfile" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label>Specialist <span class="text-danger">*</span></label>
                                <input name="Specialist" ONCLICK="ShowAndHide()" type="text" class="form-control ">
                            </div>        


                            <div class="form-group">
                                <label>Short Biography</label>
                                <textarea name="bio" class="form-control" ONCLICK="ShowAndHide()" rows="3" cols="30"></textarea>
                            </div>

                            <div id="error" style="color: red;font-family: monospace;margin-top: -10px;font-size: 12px" class="col-sm-12">
                                <b>
                                    <?php

                                        if(isset($empty)) { echo "$empty"; }
                                        if(isset($already)) { echo "$already"; }
                                        if(isset($fileempty)) { echo "$fileempty"; }

                                    ?>
                                </b>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button name="create" type="submit" class="btn btn-primary submit-btn">Create Doctor</button>
                            </div>
                        </form>
                    </div>
                </div>
				
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
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- doctors23:17-->
</html>