<?php 

include 'db.php';
include 'hospital_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_hospital'];

    // FETCH-ALL-VALUE
    $query = " select * from hospital where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);


    // UPDATE_DATE
    if(isset($_POST['save']))
    {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name']; 
        $h_name = $_POST['h_name'];
        $contact = $_POST['contact'];
        $emergency = $_POST['emergency'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $hospital = $_POST['hospital'];
        $landmark = $_POST['landmark'];
        $locality = $_POST['locality'];
        $pin = $_POST['pin'];
        $des = $_POST['des'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        if(empty($f_name) || empty($l_name) || empty($h_name) || empty($contact) || empty($emergency) || empty($state) || empty($city) || empty($district) || empty($hospital) || empty($landmark) || empty($locality) || empty($pin) || empty($des) || empty($password) || empty($c_password) )
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
                $email = $data['EMAIL'];
                $random = rand(10000001,99999999);
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                

                if(empty($filename))
                {
                    $query = " update hospital set F_NAME='$f_name',L_NAME='$l_name',HOSPITAL_NAME='$h_name',CONTACT='$contact',H_E_CONTACT='$emergency',H_STATE='$state',H_CITY='$city',H_DISTRICT='$district',H_ADD_NUM='$hospital',H_ADD_LOCALITY='$locality',H_ADD_LANDMARK='$landmark',H_ADD_PIN='$pin',H_DES='$des',PASSWORD='$password' where UNIQUE_ID='$session' ";
                        mysqli_query($con,$query);

                        header("location:hospital_editprofile.php");
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

                        $folder = 'hospital/'.$email.'/'.'1.'.$random.'.'.$filename;
                        move_uploaded_file($tempname, $folder);

                        $query = " update hospital set F_NAME='$f_name',L_NAME='$l_name',HOSPITAL_NAME='$h_name',CONTACT='$contact',H_E_CONTACT='$emergency',H_STATE='$state',H_CITY='$city',H_DISTRICT='$district',H_ADD_NUM='$hospital',H_ADD_LOCALITY='$locality',H_ADD_LANDMARK='$landmark',H_ADD_PIN='$pin',H_DES='$des',PASSWORD='$password',IMAGE_PATH='$folder' where UNIQUE_ID='$session' ";
                        mysqli_query($con,$query);

                        header("location:hospital_editprofile.php");
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
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
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
                                        <img class="rounded-circle" src="assets/img/user.jpg" width="70" height="25" alt="Admin">
                                        <span class="status online"></span>
                                    </span>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <span class="user-img">
                                        <img class="rounded-circle" src="<?php echo $data['IMAGE_PATH']; ?>" width="70" height="25" alt="Admin">
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
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12" >
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

                                    <div class="fileupload btn" >
                                        <span  class="btn-text">edit</span>
                                        <input  class="upload" name="uploadfile" type="file">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" name="f_name" class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $data['F_NAME']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" name="l_name" class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $data['L_NAME']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Hospital Name</label>
                                                <input type="text" name="h_name" class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $data['HOSPITAL_NAME']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                        
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Contact</label>
                                    <input type="text" name="contact" ONCLICK="ShowAndHide()" value="<?php echo $data['CONTACT']; ?>" class="form-control floating" value="New York">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Emergency Number</label>
                                    <input type="text" name="emergency" ONCLICK="ShowAndHide()" value="<?php echo $data['H_E_CONTACT']; ?>" class="form-control floating" value="United States">
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card-box">
                        <h3 class="card-title">Residential Informations</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">State</label>
                                    <input type="text" name="state" ONCLICK="ShowAndHide()" value="<?php echo $data['H_STATE']; ?>" class="form-control floating" value="4487 Snowbird Lane">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">City</label>
                                    <input type="text" name="city" ONCLICK="ShowAndHide()" value="<?php echo $data['H_CITY']; ?>" class="form-control floating" value="4487 Snowbird Lane">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">District</label>
                                    <input type="text" name="district" ONCLICK="ShowAndHide()" value="<?php echo $data['H_DISTRICT']; ?>" class="form-control floating" value="New York">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Hospital Number</label>
                                    <input type="text" name="hospital" ONCLICK="ShowAndHide()" value="<?php echo $data['H_ADD_NUM']; ?>" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Locality</label>
                                    <input type="text" name="locality" ONCLICK="ShowAndHide()" value="<?php echo $data['H_ADD_LOCALITY']; ?>" class="form-control floating" value="United States">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Landmark</label>
                                    <input type="text" name="landmark" ONCLICK="ShowAndHide()" value="<?php echo $data['H_ADD_LANDMARK']; ?>" class="form-control floating" value="United States">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">PIN</label>
                                    <input type="text" name="pin" ONCLICK="ShowAndHide()" value="<?php echo $data['H_ADD_PIN']; ?>" class="form-control floating" value="United States">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Hospital Description</label>
                                    <input type="text" name="des" ONCLICK="ShowAndHide()" value="<?php echo $data['H_DES']; ?>" class="form-control floating" value="United States">
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
                        <button class="btn btn-primary submit-btn" type="submit" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
    <div class="sidebar-overlay" data-reff=""></div>


    <!-- SCRIPT -->
        <script>
            function ShowAndHide() {

                var a = document.getElementById('error');
                a.style.display = 'none';

            }
        </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>


</body>


<!-- blank-page24:04-->
</html>