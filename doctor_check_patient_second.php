<?php 

include 'db.php';
include 'doctor_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_doctor'];

    // FETCH-ALL-VALUE
    $query = " select * from doctor where U_NAME='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);

    // SESSION-ANOTHER-VALUE
    $unique_in_doctor = $_SESSION['unique_in_doctor'];
    $unique_in_doctor_hospital = $_SESSION['unique_in_doctor_hospital'];


    // Next
    if(isset($_POST['next']))
    {
        $medicine = $_POST['medicine'];
        $advise = $_POST['advise'];
        $appoinment = $_POST['appoinment'];

        if(empty($medicine) || empty($advise))
        {
            $empty = "";
        }
        else
        {

            $update = " update new_patient set MEDICINE='$medicine' , ADVICE='$advise' , NEXT_APPOINMENT='$appoinment' where UNIQUE_ID='$unique_in_doctor' && HOSPITAL_NAME='$unique_in_doctor_hospital' && STATUS='0' ";
            mysqli_query($con,$update);

            header("location:doctor_check_patient.php");

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
                



                <form method="post">
             
               <div class="row">
                    <div class="col-sm-12">
                        <h4 style="font-family: monospace;" class="page-title">Check Patient</h4>
                    </div>
                </div>

            
                <div class="row filter-row">

                    <div class="col-sm-4">
                        <div class="form-group form-focus">
                            <label class="focus-label">Patient UNIQUE-ID</label>
                            <input type="text" id="idfield" ONCLICK="ShowAndHide()" disabled maxlength="19" name="unique" class="form-control floating" value="<?php echo "$unique_in_doctor"; ?>">
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group form-focus">
                            <label class="focus-label">Hospital Name</label>
                            <input type="text" id="idfield" ONCLICK="ShowAndHide()" disabled maxlength="19" name="unique" class="form-control floating" value="<?php echo "$unique_in_doctor_hospital"; ?>">
                        </div>
                    </div>


                    
                    <div class="col-sm-3">
                        <button name="search" id="search" class="btn btn-secondary btn-block">Search</button>
                    </div>

                </div>


            







                <!-- MID-PORTION -->
            <div class="card-box" style="background-color: #F8F8F9">
                        <!-- <h3 class="page-title" style="font-family: monospace;">Basic Informations</h3> -->
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="profile-img-wrap">

                                    <?php

                                        $userinfo = " select * from user where UNIQUE_ID='$unique_in_doctor' ";
                                        $userinfore = mysqli_query($con , $userinfo);
                                        $userinfoda = mysqli_fetch_assoc($userinfore);

                                    ?>

                                    <?php
                                        if(empty($userinfoda['IMAGE_PATH']))
                                        {
                                            ?><img class="inline-block" src="assets/img/user.jpg" alt="user"><?php
                                        }
                                        else
                                        {
                                            ?><img class="inline-block" src="<?php echo $userinfoda['IMAGE_PATH']; ?>" alt="user"><?php
                                        }
                                    ?>

                                    
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Patient Name</label>
                                                <input type="text" name="f_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $userinfoda['F_NAME']; echo " "; echo $userinfoda['L_NAME']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Contact</label>
                                                <input type="text" name="l_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $userinfoda['CONTACT']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Blood Group</label>
                                                <input type="text" name="l_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $userinfoda['BLOOD_GROUP']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">ADDRESS</label>
                                                <input type="text" name="h_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $userinfoda['U_ADD_NUM']; echo ", "; echo $userinfoda['U_ADD_LOCALITY']; echo ", "; echo $userinfoda['U_ADD_LANDMARK']; echo ", "; echo $userinfoda['U_DISTRICT']; echo ", "; echo $userinfoda['U_CITY']; echo ", "; echo $userinfoda['U_STATE']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>





                    <!-- FOUND -->
                    <div class="row" style="position: absolute;">
                        <div class="col-sm-12" style="margin-top: -17px;margin-left: 3px">
                            <h4 style="font-size: 13px;font-family: monospace;color: green"><b> User Found, Continue to next process...</b></h4>
                        </div>
                    </div>










                    <!-- NEW-DETAIL -->
                    <div class="row filter-row" style="margin-top: 50px;border: 1px solid lightgray;border-radius: 5px;padding-top: 20px">
                    <div class="col-sm-12" style="">
                        <div class="row">


                                    
                                       <div class="col-sm-12">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Give Medicine</label>
                                                <input type="text" ONCLICK="ShowAndHide()" style="border: 1.5px solid lightgray"   name="medicine" class="form-control floating">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Give Advise</label>
                                                <input type="text" ONCLICK="ShowAndHide()" style="border: 1.5px solid lightgray"  name="advise" class="form-control floating">
                                            </div>
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Next Appoinment</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating datetimepicker" style="border: 1.5px solid lightgray" ONCLICK="ShowAndHide()" name="appoinment" type="text">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <button name="next" id="next" class="btn btn-success btn-block">Next</button>
                                        </div>


                                       <?php

                                            if(isset($empty))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Fill All The Fields</b></h4>
                                                    </div>
                                                <?php
                                            }

                                            

                                            

                                        ?>

                        </div>
                    </div>
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