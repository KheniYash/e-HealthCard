<?php 

include 'db.php';
include 'hospital_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_hospital'];

    // FETCH-ALL-VALUE
    $query = " select * from hospital where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);

    // FETCH_SESSION_VALUE
    $uniqueid_endcase = $_SESSION['uniqueid_endcase'];


    if(isset($_POST['addbtn']))
    {
        $money = $_POST['addmoney'];

        if(empty($money))
        {
            $empty = "";
        }
        else
        {

                $hospitalname = $data['HOSPITAL_NAME'];

                $update = " update new_patient set PAYMENT='$money' , STATUS='1' where UNIQUE_ID='$uniqueid_endcase' && HOSPITAL_NAME='$hospitalname' && STATUS='0' ";

                $updatere = mysqli_query($con , $update);

                if($updatere)
                {
                    header("location:hospital_endcase.php");
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
                        <h4 style="font-family: monospace;" class="page-title">End Case</h4>
                    </div>
                </div>

            
                <div class="row filter-row">
                    <div class="col-sm-9">
                        <div class="form-group form-focus">
                            <label class="focus-label">Patient UNIQUE-ID</label>
                            <input type="text" id="unique" ONCLICK="ShowAndHide()" value="<?php echo $uniqueid_endcase; ?>" disabled maxlength="19" name="unique" class="form-control floating">
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <button name="search" id="search"  disabled class="btn btn-success btn-block">Search</button>
                    </div>
                </div>


                    <div style="position: relative;">
                            <div class="row" style="position: absolute;">
                                <div class="col-sm-12" style="margin-top: -8px;margin-left: 3px">
                                    <h4 style="font-size: 13px;font-family: monospace;color: green"><b>* Patient Found, Add Money To Ending This Case...</b></h4>
                                </div>
                            </div>
                    </div>







                    <!-- NEW-DETAIL -->
                    <div class="row filter-row" style="margin-top: 50px;border: 1px solid lightgray;border-radius: 5px;padding-top: 20px">
                    <div class="col-sm-12" style="">
                        <div class="row">


                                    
                                       <div class="col-sm-8">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Add Payment</label>
                                                <input type="number" ONCLICK="ShowAndHide()" style="border: 1.5px solid lightgray"   name="addmoney" class="form-control floating">
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <button name="addbtn" id="add" class="btn btn-primary btn-block">ADD MONEY TO END CASE</button>
                                        </div>


                                       <?php

                                            if(isset($empty))
                                            {
                                                ?>
                                                    <div class="col-sm-12" id="error" style="margin-top: -8px">
                                                            <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Plz Enter Money</b></h4>
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