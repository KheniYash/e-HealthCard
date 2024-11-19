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

        if(empty($uniqueID))
        {
            $empty = "";
        }
        else
        {
            $check = " select count(*) as c from user where UNIQUE_ID='$uniqueID' ";
            $checkre = mysqli_query($con , $check);
            $checkda = mysqli_fetch_assoc($checkre);

            if(empty($checkda['c']))
            {
                $notfound = "";
            }
            else
            {
                $found = "";
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
                        <h4 style="font-family: monospace;" class="page-title">Find Patient Information</h4>
                    </div>
                </div>

            
                <div class="row filter-row">

                    <div class="col-sm-9">
                        <div class="form-group form-focus">
                            <label class="focus-label">Patient UNIQUE-ID</label>
                            <input type="text" id="unique" ONCLICK="ShowAndHide()" maxlength="19" name="unique" class="form-control floating">
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
                                    <h4 style="font-size: 13px;font-family: monospace;color: red"><b>* Patient UNIQUE-ID Not Found</b></h4>
                                </div>
                            </div>
                        <?php
                    }


                    if(isset($found))
                    {

                        $find = "select * from user where UNIQUE_ID='$uniqueID' ";
                        $findre = mysqli_query($con , $find);
                        $findda = mysqli_fetch_assoc($findre);

                        ?>
                            

                        


                        <!-- JAVA-SCRIEPT -->

                        <script type="text/javascript">
                            // var disabled = document.getElementById("search");
                            // disabled.disabled = true;
                            // var disabled = document.getElementById("unique");
                            // disabled.disabled = true;
                            var set = document.getElementById("unique");
                            set.value = "<?php echo "$uniqueID"; ?>";
                            
                        </script>

                        <!-- JAVA-SCRIEPT-END -->




                        <!-- MID-PORTION -->
                <div class="card-box profile-header" style="background-color: #F8F8F9">
                    <div class="row" >
                        <div class="col-md-12">

                            <div class="profile-view" >

                                <div class="profile-img-wrap" >
                                    <div class="profile-img-wrap"style="background-color: #F8F8F9" >

                                        <?php
                                            if(empty($findda['IMAGE_PATH']))
                                            {
                                                ?><img class="inline-block" src="assets/img/user.jpg" alt="user"><?php
                                            }
                                            else
                                            {
                                                ?><img  class="inline-block" src="<?php echo $findda['IMAGE_PATH']; ?>" alt="user"><?php
                                            }
                                        ?>
                                    </div>
                                    
                                </div>

                            </div>

                                <div class="profile-basic">
                                    <div class="row">

                                        <div class="col-md-5" >
                                            <div class="profile-info-left" >
                                                <h3 class="user-name m-t-0 mb-0" style="font-size: 20px"><?php echo $findda['F_NAME']; echo " "; echo $findda['L_NAME']; ?></h3>
                                                <small class="text-muted">User</small>
                                                <div class="staff-id"><b style="font-size: 12px">Unique-ID : </b><span style="font-size: 10px"><?php echo $findda['UNIQUE_ID']; ?></span></div>
                                                <div class="staff-id"><b style="font-size: 12px">Email : </b><span style="font-size: 11px"><?php echo $findda['EMAIL']; ?></span></div>
                                                <div class="staff-id"><b style="font-size: 12px">Dob : </b><span style="font-size: 11px"><?php echo $findda['DOB']; ?></span></div>
                                                
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="staff-id"><b style="font-size: 12px">Blood Group : </b><span style="font-size: 11px"><?php echo $findda['BLOOD_GROUP']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">Contact : </b><span style="font-size: 11px"><?php echo $findda['CONTACT']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">Address : </b><span style="font-size: 11px"><?php echo $findda['U_ADD_NUM']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">State : </b><span style="font-size: 11px"><?php echo $findda['U_STATE']; ?></span></div>
                                            <div class="staff-id"><b style="font-size: 12px">City : </b><span style="font-size: 11px"><?php echo $findda['U_CITY']; ?></span></div>
                                            
                                        </div>


                                    </div>
                                </div>

                            </div>                        
                        </div>
                    </div>
                </div>






            <div  class="row" style="position: absolute;">
                <div class="col-sm-12" style="margin-top: 12px;margin-left: 5px">
                    <h4 style="font-size: 13px;font-family: monospace;color: green"><b>Patient <i style="color: #426FFD"><?php echo $findda['F_NAME']; echo $findda['L_NAME']; ?></i> Found, Check his All Past Medicle History...</b></h4>
                </div>
            </div>













            <div class="row" style="font-size: 10px;margin-top: 50px">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-border table-striped custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>UNIQUE-ID</th>
                                                <th>PATIENT-NAME</th>
                                                <th>HOSPITAL_NAME</th>
                                                <th>DATE</th>
                                                <th>TIME</th>
                                                <th>DR.NAME</th>
                                                <th>BP</th>
                                                <th>SUGAR</th>
                                                <th>SPO<sub>2</sub></th>
                                                <th>TEMP</th>
                                                <th>DIESES</th>
                                                <th>MEDICINE</th>
                                                <th>ADVICE</th>
                                                <th>NEXT-APPOINMENT</th>
                                            </tr>
                                        </thead>    
                                        <tbody>

                                            <?php

                                                $queryy = "select * from new_patient where UNIQUE_ID='$uniqueID' ORDER BY ID DESC";
                                                $resultt = mysqli_query($con,$queryy);

                                                while($dataa = mysqli_fetch_assoc($resultt))
                                                {
                                                    ?>

                                                        <tr>


                                                            <?php

                                                                $medicine = $dataa['MEDICINE'];
                                                                $advice = $dataa['ADVICE'];
                                                                $appoinment = $dataa['NEXT_APPOINMENT'];

                                                                if(!empty($medicine) && !empty($advice) )
                                                                {
                                                                    ?>

                                                                    <td><?php echo $dataa['ID']; ?></td>

                                                                    <td style="text-align: center;"><?php echo $dataa['UNIQUE_ID']; ?></td>

                                                                    <td><?php echo $dataa['PATIENT_NAME']; ?></td>

                                                                    <td><?php echo $dataa['HOSPITAL_NAME']; ?></td>

                                                                    <td><?php echo $dataa['DATE']; ?></td>

                                                                    <td><?php echo $dataa['TIME']; ?></td>

                                                                    <td><?php echo $dataa['DR_NAME']; ?></td>

                                                                    <td><?php echo $dataa['BLOOD_PRESSURE']; ?></td>

                                                                    <td><?php echo $dataa['SUGAR_LEVEL']; ?></td>

                                                                    <td><?php echo $dataa['SPO2']; ?></td>

                                                                    <td><?php echo $dataa['TEMPRETURE']; ?></td>

                                                                    <td><?php echo $dataa['BRIEF_DESCRIPTION_OF_DIESES']; ?></td>

                                                                    <td><?php echo $dataa['MEDICINE']; ?></td>

                                                                    <td><?php echo $dataa['ADVICE']; ?></td>

                                                                    <td><?php echo $dataa['NEXT_APPOINMENT']; ?></td>

                                                                    <?php
                                                                }

                                                            ?>

                                                        </tr>

                                                    <?php
                                                }

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

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