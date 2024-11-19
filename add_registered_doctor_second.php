<?php 

include 'db.php';
include 'hospital_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_hospital'];

    // FETCH-ALL-VALUE
    $query = " select * from hospital where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);


    //SESSION-ANOTHER-VALUE
    $uname_doctor = $_SESSION['uname_doctor'];

    $doctor = " select * from doctor where U_NAME='$uname_doctor' ";
    $doctorre = mysqli_query($con , $doctor);
    $doctorda = mysqli_fetch_assoc($doctorre);


    // ADD_DOCTOR
    if(isset($_POST['add']))
    {
        if(!isset($_POST['box']))
        {
            $change = "";
        }
        else
        {

            // ADD-DOCTOR
            $get = " select * from doctor where U_NAME='$uname_doctor' ";
            $getre = mysqli_query($con , $get);
            $getda = mysqli_fetch_assoc($getre);

            $f_name = $getda['F_NAME'];
            $l_name = $getda['L_NAME'];
            $h_name = $data['HOSPITAL_NAME'];
            $u_name = $getda['U_NAME'];
            $email = $getda['EMAIL'];
            $password = $getda['PASSWORD'];
            $dob = $getda['DOB'];
            $gender = $getda['GENDER'];
            $address = $getda['ADDRESS'];
            $state = $getda['STATE'];
            $city = $getda['CITY'];
            $pin = $getda['PIN'];
            $phone = $getda['CONTACT'];
            $Specialist = $getda['SPECIALIST'];
            $bio = $getda['BIO'];
            $image = $getda['IMAGE_PATH'];


            $insert = " insert into doctor (F_NAME,L_NAME,HOSPITAL,U_NAME,EMAIL,PASSWORD,DOB,GENDER,ADDRESS,STATE,CITY,PIN,CONTACT,SPECIALIST,BIO,IMAGE_PATH) values ('$f_name','$l_name','$h_name','$u_name','$email','$password','$dob','$gender','$address','$state','$city','$pin','$phone','$Specialist','$bio','$image') ";
            $insertre = mysqli_query($con , $insert);
            header("location:doctors.php");

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
                        <h4 style="font-family: monospace;" class="page-title">Doctor Registered</h4>
                    </div>
                </div>

            
                <div class="row filter-row">
                    <div class="col-sm-9">
                        <div class="form-group form-focus">
                            <label class="focus-label">Enter User Name</label>
                            <input type="text" id="uname" ONCLICK="ShowAndHide()" disabled value="<?php echo $uname_doctor; ?>" maxlength="19" name="uname" class="form-control floating">
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <button name="search" id="search" class="btn btn-secondary btn-block">Search</button>
                    </div>
                </div>










                <!-- MID-PORTION -->
                <div class="card-box profile-header" style="background-color: #F8F8F9">
                    <div class="row" >
                        <div class="col-md-12">

                            <div class="profile-view" >

                                <div class="profile-img-wrap" >
                                    <div class="profile-img-wrap"style="background-color: #F8F8F9" >

                                        <?php
                                            if(empty($doctorda['IMAGE_PATH']))
                                            {
                                                ?><img class="inline-block" src="assets/img/user.jpg" alt="user"><?php
                                            }
                                            else
                                            {
                                                ?><img  class="inline-block" src="<?php echo $doctorda['IMAGE_PATH']; ?>" alt="user"><?php
                                            }
                                        ?>
                                    </div>
                                    
                                </div>

                            </div>

                                <div class="profile-basic">
                                    <div class="row">

                                        <div class="col-md-3" >
                                            <div class="profile-info-left" >
                                                <h3 class="user-name m-t-0 mb-0" style="font-size: 20px">Dr.<?php echo $doctorda['F_NAME']; echo " "; echo $doctorda['L_NAME']; ?></h3>
                                                <small class="text-muted"><?php echo $doctorda['SPECIALIST']; ?></small>
                                                <div class="staff-id"><b style="font-size: 12px">Email : </b><span style="font-size: 10px"><?php echo $doctorda['EMAIL']; ?></span></div>
                                                <div class="staff-id"><b style="font-size: 12px">Dob : </b><span style="font-size: 11px"><?php echo $doctorda['DOB']; ?></span></div>
                                                <div class="staff-id"><b style="font-size: 12px">Gender : </b><span style="font-size: 11px"><?php echo $doctorda['GENDER']; ?></span></div>
                                                
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="staff-id"><b style="font-size: 12px">Contact : </b><span style="font-size: 11px"><?php echo $doctorda['CONTACT']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">Address : </b><span style="font-size: 11px"><?php echo $doctorda['ADDRESS']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">State : </b><span style="font-size: 11px"><?php echo $doctorda['STATE']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">City : </b><span style="font-size: 11px"><?php echo $doctorda['CITY']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">Biography : </b><span style="font-size: 11px"><?php echo $doctorda['BIO']; ?></span></div>
                                        </div>


                                         <div class="col-md-5" >
                                            







                                            
                        <div class="card member-panel" >
                                <div class="staff-id"><b style="font-size: 12px;padding-left: 5px">Registered Hospitals</b></div>
                            <div class="card-body" style="max-height: 110px">

                                <ul class="contact-list">

                                    <?php

                                        $hospital = " select * from doctor where U_NAME='$uname_doctor' ";
                                        $hospitalre = mysqli_query($con , $hospital);

                                        while($hospitalda = mysqli_fetch_assoc($hospitalre))
                                        {
                                            ?>
                                            <li><span style="padding-left: 5px;color: gray" class="contact-name text-ellipsis"><span style="color: black">•</span> <?php echo $hospitalda['HOSPITAL']; ?></span></li>
                                            <?php
                                        }

                                    ?>

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






            <div id="error" class="row" style="position: absolute;">
                <div class="col-sm-12" style="margin-top: -17px;margin-left: 30px">
                    <h4 style="font-size: 13px;font-family: monospace;color: green"><b>Dr.<?php echo $uname_doctor; ?> Found, Continue to next process...</b></h4>
                </div>
            </div>



            </form>

            <hr>










            
            <div class="content">
                <form method="post">    
                    <div class="row">

                            <div class="col-sm-12" style="text-align: center;">
                                <!-- <h4 style="font-family: monospace;" class="page-title">Doctor Registered</h4> -->

                                <input type="checkbox" value="checked" name="box"> 
                                <span id="colorchange" style="font-family: monospace;color: #0080ff;font-size: 12.5px">Are You Sure You Wan't To Add This Doctor To Your Hospital</span>


                            </div>

                            <button style="margin-top: 4px"  name="add" id="ADD" class="btn btn-primary btn-block">ADD DOCTOR</button>

                    </div>
                </form>
            </div>   






            <?php

            if(isset($change))
            {
                ?>
                    <script type="text/javascript">
                        var col=document.getElementById("colorchange");
                        col.style.color="#FF0000";
                    </script>
                <?php
            }

            ?>












				
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