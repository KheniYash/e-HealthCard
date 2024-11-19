<?php 

include 'db.php';
include 'security_admin.php';

    // SESSION-VALUE
    $session = $_SESSION['unique'];

    // FETCH-ALL-VALUE
    $query = " select * from admin where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);

    // ACCEPT_REQUEST
    if(isset($_POST['acceptbtn']))
    {
        $id = $_POST['hiddenid'];

        // FETCH-UNIQUE-ID
        $query = "select UNIQUE_ID from hospital where ID='$id'";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);

        if($data['UNIQUE_ID'] == '-')
        {
            $num1 = rand(1001,9999);
            $num2 = rand(1001,9999);
            $num3 = rand(1001,9999);
            $num4 = rand(1001,9999);

            $final_number = $num1 . " " . $num2 . " " . $num3 . " " . $num4;

            // ADD-UNIQUE-KEY & STATUS-UPDATE-TO-1
            $update = " update hospital set STATUS='1',UNIQUE_ID='$final_number' where ID='$id' ";
            mysqli_query($con,$update);


        }
        else
        {
             // STATUS-UPDATE-TO-1
            $update = " update hospital set STATUS='1' where ID='$id' ";
            mysqli_query($con,$update);
        }
    }

    // TEMP_BLOCK
    if(isset($_POST['blockbtn']))
    {
        $id = $_POST['hiddenid'];

        // STATUS-UPDATE-TO-0
        $update = " update hospital set STATUS='0' where ID='$id' ";
        mysqli_query($con,$update);
    }

    // DELETE-ENTRY
    // if(isset($_POST['deletebtn']))
    // {
        
        
    // }


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
    <title>e-Healthcare Admin</title>
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

                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile_admin.php">My Profile</a>
						<a class="dropdown-item" href="edit_profile_admin.php">Edit Profile</a>
						<form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile_admin.php">My Profile</a>
                    <a class="dropdown-item" href="edit_profile_admin.php">Edit Profile</a>
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
                            <a href="adminmainpage.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
						<li>
                            <a href="userentry.php"><i class="fa fa-user"></i> <span>All Users</span></a>
                        </li>
                        <li>
                            <a href="hospitalentry.php"><i class="fa fa-hospital-o"></i> <span>Hospitals</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-border table-striped custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>UNIQUE-ID</th>
                                                <th>EMAIL-ID</th>
                                                <th>PASSWORD</th>
                                                <th>DOB</th>
                                                <th>CONTACT</th>
                                                <th>HOSPITAL</th>
                                                <th>Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>    
                                        <tbody>

                                            <?php

                                                $query = "SELECT * FROM hospital";
                                                $result = mysqli_query($con,$query);

                                                while($data = mysqli_fetch_assoc($result))
                                                {
                                                    ?>

                                                        <tr>
                                                            <td>    
                                                                <?php
                                                                    $id = $data['ID'];
                                                                    $newquery = "select UNIQUE_ID from hospital where ID='$id'";
                                                                    $newresult = mysqli_query($con,$newquery);
                                                                    $newdata = mysqli_fetch_assoc($newresult);

                                                                    if($newdata['UNIQUE_ID'] == '-')
                                                                    {

                                                                        ?> <img width="15" height="15" src="assets/img/new.png" class="rounded-circle m-r-5" alt=""> <?php echo $data['ID'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $data['ID'];
                                                                    }
                                                                ?>
                                                            </td>

                                                            <td style="text-align: center;"><!-- <img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> --> <?php echo $data['UNIQUE_ID']; ?></td>

                                                            <td><?php echo $data['EMAIL']; ?></td>

                                                            <td><?php echo $data['PASSWORD']; ?></td>

                                                            <td><?php echo $data['DOB']; ?></td>

                                                            <td><?php echo $data['CONTACT']; ?></td>

                                                            <td><?php echo $data['HOSPITAL_NAME']; ?></td>

                                                            <td>
                                                                <?php
                                                                    $status = $data['STATUS'];
                                                                    if($status == '0') 
                                                                    {   
                                                                        ?> <span class="custom-badge status-red">Not-Active</span><?php      
                                                                    }
                                                                    else
                                                                    {
                                                                        ?> <span class="custom-badge status-green">Active</span><?php
                                                                    }     
                                                                ?>
                                                                
                                                            </td>

                                                            <td class="text-right">
                                                                <form method="post">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">

                                                                        <input type="hidden" name="hiddenid" value=" <?php echo $data['ID']; ?> ">

                                                                        <?php
                                                                            if($data['STATUS'] == '1')
                                                                            {

                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <button type="submit" name="acceptbtn" class="dropdown-item" href="edit-schedule.html"><i class="bi bi-check-square m-r-5"></i>Accept</button>
                                                                                <?php
                                                                            }
                                                                        ?>

                                                                        <?php
                                                                            if($data['STATUS'] == '0')
                                                                            {

                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <button type="submit" name="blockbtn" class="dropdown-item" href="edit-schedule.html"><i class="bi bi-x-circle m-r-5"></i>Block</button>
                                                                                <?php
                                                                            }
                                                                        ?>

                                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_schedule"><i class="fa fa-trash-o m-r-5"></i>Delete</button>

                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </td>

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
                
            </div>
        </div>

        <!-- DELETE-ALERT -->
        <form method="post">
        <div id="delete_schedule" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to delete this Schedule?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="button" name="deletebtn" class="btn btn-danger" onclick="alert()">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>


    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>


</body>


<!-- blank-page24:04-->
</html>