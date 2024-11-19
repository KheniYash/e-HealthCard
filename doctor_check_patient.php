<?php 

include 'db.php';
include 'doctor_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_doctor'];

    // FETCH-ALL-VALUE
    $query = " select * from doctor where U_NAME='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);



    // CHECK-PATIENT
    if(isset($_POST['search']))
    {
        $uniqueID = $_POST['unique'];
        $hospital = $_POST['hospital'];
        $doctor  = $_POST['DR_NAME'];

        if(empty($uniqueID))
        {
            $empty = "";
        }
        else
        {
            $check = " select count(*) as c from new_patient where UNIQUE_ID='$uniqueID' && STATUS='0' && HOSPITAL_NAME='$hospital' ";
            $checkre = mysqli_query($con , $check);
            $checkda = mysqli_fetch_assoc($checkre);

            if(empty($checkda['c']))
            {
                $notfound = "";
            }
            else
            {
                
                $another = "select * from new_patient where UNIQUE_ID='$uniqueID' && STATUS='0' && HOSPITAL_NAME='$hospital' ";
                $anotherre = mysqli_query($con , $another);
                $anotherda = mysqli_fetch_assoc($anotherre);

                if(empty($anotherda['MEDICINE']) && empty($anotherda['ADVICE']) )
                {
                    $found = "";
                    $_SESSION['unique_in_doctor'] = $uniqueID;
                    $_SESSION['unique_in_doctor_hospital'] = $hospital;
                    header("location:doctor_check_patient_second.php");
                }
                else
                {
                    $notfound = "";
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
                            <input type="text" id="idfield" ONCLICK="ShowAndHide()" maxlength="19" name="unique" class="form-control floating">
                        </div>
                    </div>


                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <select name="hospital" class="form-control" style="height: 51px;border: 1px solid lightgray">

                                                    <?php

                                                        
                                                        $dquery = "select * from doctor where U_NAME='$session'";
                                                        $dresult = mysqli_query($con , $dquery);

                                                        while($ddata = mysqli_fetch_assoc($dresult))
                                                        {
                                                            ?>
                                                                <option><?php echo $ddata['HOSPITAL']; ?></option>
                                                            <?php
                                                        }

                                                    ?>
                                                </select>
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
                                    <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter Patient UNIQUE-ID</b></h4>
                                </div>
                            </div>
                        <?php
                    }

                    if(isset($notfound))
                    {
                        ?>
                            <div id="error" class="row" style="position: absolute;">
                                <div class="col-sm-12" style="margin-top: -8px;margin-left: 3px">
                                    <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Patient Not Found, Check & Registered To New Case</b></h4>
                                </div>
                            </div>
                        <?php
                    }

                    if(isset($found))
                    {
                        ?>
                            <div id="error" class="row" style="position: absolute;">
                                <div class="col-sm-12" style="margin-top: -8px;margin-left: 3px">
                                    <h4 style="font-size: 13px;font-family: monospace;color: green"><b>*FOUND</b></h4>
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