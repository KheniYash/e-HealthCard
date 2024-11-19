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
    $session_unique_id = $_SESSION['unique_in_hospital'];

    if(isset($_POST['next']))
    {

        $bp = $_POST['bp'];
        $sl = $_POST['sl'];
        $ox = $_POST['ox'];
        $te = $_POST['te'];
        $de = $_POST['de'];
        $doctor = $_POST['doctor'];

        if(empty($ox) && empty($te) && empty($de))
        {
            $emptyall = "both empty";
        }

        else if(empty($ox))
        {
            $emptyox = "Oxygeon Empty";
        }

        else if(empty($te))
        {
            $emptyte = "Tempreture Empty";
        }

        else if(empty($de))
        {
            $emptyde = "descreption empty";
        }

        else
        {
            $ready = "ready";

            
                date_default_timezone_set('asia/kolkata');
                $time = date('h:i:s A');
                $date = date('d-m-y');
                $day = date("D");
                $hospitalname = $data['HOSPITAL_NAME'];

                $patient = " select * from user where UNIQUE_ID='$session_unique_id' ";
                $patientre = mysqli_query($con,$patient);
                $patientda = mysqli_fetch_assoc($patientre);
                $patientname = $patientda['F_NAME']." ".$patientda['L_NAME'];

                // INSER_DATA
                $insert = " insert into new_patient (UNIQUE_ID,PATIENT_NAME,HOSPITAL_NAME,DATE,TIME,DAY,BLOOD_PRESSURE,SUGAR_LEVEL,SPO2,TEMPRETURE,BRIEF_DESCRIPTION_OF_DIESES,DR_NAME) values ('$session_unique_id','$patientname','$hospitalname','$date','$time','$day','$bp','$sl','$ox','$te','$de','$doctor') ";
                $insert_result = mysqli_query($con , $insert);


                header("location:hospital_patient_registration.php");
            
            

            
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
                        <li>
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
                        <h4 style="font-family: monospace;" class="page-title">New Case</h4>
                    </div>
                </div>

            
                <div class="row filter-row">
                    <div class="col-sm-9">
                        <div class="form-group form-focus">
                            <label class="focus-label">Patient UNIQUE-ID</label>
                            <input type="text" id="idfield" ONCLICK="ShowAndHide()" border: 1.5px solid lightgray value="<?php echo $session_unique_id; ?>" disabled class="form-control floating">
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <button name="search" disabled id="search" class="btn btn-secondary btn-block">Search</button>
                    </div>
                </div>


            




            <!-- MID-PORTION -->
            <div class="card-box" style="background-color: #F8F8F9">
                        <!-- <h3 class="page-title" style="font-family: monospace;">Basic Informations</h3> -->
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="profile-img-wrap">

                                    <?php

                                        $userinfo = " select * from user where UNIQUE_ID='$session_unique_id' ";
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

                                    <!-- <div class="fileupload btn" >
                                        <span  class="btn-text">edit</span>
                                        <input  class="upload" name="uploadfile" type="file">
                                    </div> -->
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Patient Name</label>
                                                <input type="text" name="f_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $userinfoda['F_NAME']; echo " "; echo $userinfoda['L_NAME']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Contact</label>
                                                <input type="text" name="l_name" disabled class="form-control floating" ONCLICK="ShowAndHide()" value="<?php echo $userinfoda['CONTACT']; ?>">
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










            <!-- <div style="position: relative;"> -->

                    <div class="row" style="position: absolute;">
                        <div class="col-sm-12" style="margin-top: -17px;margin-left: 3px">
                            <h4 style="font-size: 13px;font-family: monospace;color: green"><b> User Found, Continue to next process...</b></h4>
                        </div>
                    </div>
                
            <!-- </div> -->










                <div class="row filter-row" style="margin-top: 50px;border: 1px solid lightgray;border-radius: 5px;padding-top: 20px">
                    <div class="col-sm-12" style="">
                        <div class="row">


                                    
                                       <div class="col-sm-3">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Blood Pressure (mmHg)</label>
                                                <input type="text" ONCLICK="ShowAndHide()" style="border: 1.5px solid lightgray"   name="bp" class="form-control floating">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Sugar Level</label>
                                                <input type="text" ONCLICK="ShowAndHide()" style="border: 1.5px solid lightgray"  name="sl" class="form-control floating">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Oxygeon (SpO<sub>2</sub>)</label>
                                                <input type="text" ONCLICK="ShowAndHide()" style="border: 1.5px solid lightgray"  name="ox" class="form-control floating">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Tempreture (°C)</label>
                                                <input type="text" ONCLICK="ShowAndHide()"  style="border: 1.5px solid lightgray"  name="te" class="form-control floating">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Brief Discription Of Dieses</label>
                                                <input type="text" ONCLICK="ShowAndHide()" style="height: 60px;border: 1px solid lightgray" name="de" class="form-control floating">
                                            </div>
                                        </div>


                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select name="doctor" class="form-control" style="height: 51px;border: 1px solid lightgray">

                                                    <?php

                                                        $hospital = $data['HOSPITAL_NAME'];
                                                        $dquery = "select * from doctor where HOSPITAL='$hospital'";
                                                        $dresult = mysqli_query($con , $dquery);

                                                        while($ddata = mysqli_fetch_assoc($dresult))
                                                        {
                                                            ?>
                                                                <option>Dr. <?php echo $ddata['F_NAME']; echo " "; echo $ddata['L_NAME']; echo " ( "; echo $ddata['SPECIALIST']; echo " )"; ?></option>
                                                            <?php
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        

                                        <div class="col-sm-3">
                                            <button name="next" id="next" class="btn btn-success btn-block">Next</button>
                                        </div>



                                       <?php

                                            if(isset($emptyall))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter Patient SPO<sub>2</sub>, Current Tempreture (°C), & Brief Discription Of Dieses</b></h4>
                                                    </div>
                                                <?php
                                            }

                                            if(isset($emptyox))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter Patient SPO<sub>2</sub></b></h4>
                                                    </div>
                                                <?php
                                            }

                                            if(isset($emptyte))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter Patient Current Tempreture (°C)</b></h4>
                                                    </div>
                                                <?php
                                            }

                                            if(isset($emptyde))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter Brief Discription Of Dieses</b></h4>
                                                    </div>
                                                <?php
                                            }

                                            if(isset($ready))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: green"><b>Record Succesfully Saved, Continue...</b></h4>
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
            var x = document.getElementById('error');
            x.style.display = 'none';
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