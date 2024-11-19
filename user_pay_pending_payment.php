<?php 

include 'db.php';
include 'user_security.php';

    // SESSION-VALUE
    $session = $_SESSION['unique_user'];

    // FETCH-ALL-VALUE
    $query = " select * from user where UNIQUE_ID='$session' ";
    $result = mysqli_query($con , $query);
    $data = mysqli_fetch_assoc($result);


    // PAYED-PAYMENT
    if(isset($_POST['pay']))
    {
        $h_ID = $_POST['hiddenid']; 
        $h_NAME = $_POST['hiddenname'];
        $put_MONEY = $_POST['putmoney'];
        $walletmoney = $data['MONEY'];
        $leftmoney = $_POST['hiddenleftmoney'];
        $payedpayment = $_POST['hiddenpayedpayment'];

        $get = " select * from new_patient where PATIENT_NAME='$h_NAME' && ID='$h_ID' ";
        $getre = mysqli_query($con , $get);
        $fetda = mysqli_fetch_assoc($getre);


        if(empty($put_MONEY))
        {

        }
        else
        {
            if( $put_MONEY > $walletmoney )
            {
                $notcomplete = "";
            }
            else
            {

                if( $put_MONEY > $leftmoney )
                {
                    $more = "";
                }
                else
                {
                    if($put_MONEY == $leftmoney)
                    {
                        $wa = $walletmoney - $put_MONEY;
                        $add = $payedpayment + $put_MONEY;

                        $another = " update user set MONEY='$wa' where UNIQUE_ID='$session' ";
                        mysqli_query($con , $another);

                        $updatefinal = " update new_patient set PAYMENT_STATUS='SUCCESS' , PATIENT_ADDED_MONEY='$add' where PATIENT_NAME='$h_NAME' && ID='$h_ID' ";
                        mysqli_query($con , $updatefinal);

                        header("location:user_pay_pending_payment.php");
                    }
                    else
                    {

                        $wa = $walletmoney - $put_MONEY;
                        $add = $payedpayment + $put_MONEY;

                        $anotherr = " update user set MONEY='$wa' where UNIQUE_ID='$session' ";
                        mysqli_query($con , $anotherr);

                        $update = " update new_patient set PATIENT_ADDED_MONEY='$add' where PATIENT_NAME='$h_NAME' && ID='$h_ID' ";
                        mysqli_query($con , $update);

                        header("location:user_pay_pending_payment.php");
                    }
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
                        <a class="dropdown-item" href="user_profile.php">My Profile</a>
                        <a class="dropdown-item" href="user_editprofile.php">Edit Profile</a>
                        <form method="post"><button type="submit" name="logout" class="dropdown-item">Logout</button></form>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user_profile.php">My Profile</a>
                    <a class="dropdown-item" href="user_editprofile.php">Edit Profile</a>
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
                            <a href="user_add_money.php"><i class="fa fa-dashboard"></i> <span>Add Money</span></a>
                        </li>
                        <li>
                            <a href="user_find_info.php"><i class="fa fa-dashboard"></i> <span>Check Past Info</span></a>
                        </li>
                        <li>
                            <a href="user_pay_pending_payment.php"><i class="fa fa-dashboard"></i> <span>Pay Pending Payment</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">

                <form method="post">
                
                <div class="row">
                    <div class="col-sm-9">
                        <h4 style="font-family: monospace;" class="page-title">Your Pending Payment</h4>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-focus">
                            <label class="focus-label" style="font-family: monospace;">E-Health Wallet Money</label>
                            <input type="text" style="border-radius: 7px" id="walletmoney" disabled value="<?php echo $data['MONEY']; ?>" ONCLICK="ShowAndHide()" maxlength="19" name="walletmoney" class="form-control floating">
                        </div>
                    </div>






                    <!-- MAIN-DETAIL -->


                    <div class="row" style="font-size: 11px;">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-border table-striped custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>U-NAME</th>
                                                <th>HOSPITAL-NAME</th>
                                                <th>DATE</th>
                                                <th>PAYMENT-STATUS</th>
                                                <th>TOTAL-PAYMENT</th>
                                                <th>PAYED-PAYMENT</th>
                                                <th>LEFT-PAYMENT</th>
                                                <th>MAKE-PAYMENT</th>
                                                <th>PAY</th>
                                            </tr>
                                        </thead>    
                                        <tbody>

                                            <?php

                                                $queryy = "select * from new_patient where UNIQUE_ID='$session' && PAYMENT_STATUS='PENDING' && STATUS='1' ";
                                                $resultt = mysqli_query($con,$queryy);

                                                while($dataa = mysqli_fetch_assoc($resultt))
                                                {

                                                    // CALCULATION
                                                    $leftpayment = $dataa['PAYMENT'] - $dataa['PATIENT_ADDED_MONEY'];


                                                    ?>

                                                        <tr>


                                                                    <td><?php echo $dataa['ID']; ?></td>

                                                                    <td style="text-align: center;"><?php echo $dataa['PATIENT_NAME']; ?></td>

                                                                    <td><?php echo $dataa['HOSPITAL_NAME']; ?></td>

                                                                    <td><?php echo $dataa['DATE']; ?></td>

                                                                    <td><?php echo $dataa['PAYMENT_STATUS']; ?></td>

                                                                    <td><?php echo $dataa['PAYMENT']; ?></td>

                                                                    <td><?php echo $dataa['PATIENT_ADDED_MONEY']; ?></td>

                                                                    <td><?php echo $leftpayment; ?></td>

                                                                    <form method="post">

                                                                         <td>
                                                                            <div class="form-focus">
                                                                                <label class="focus-label">Make Payment</label>
                                                                                <input type="text" style="border-radius: 7px" id="putmoney" value="<?php echo $leftpayment; ?>" ONCLICK="ShowAndHide()" name="putmoney" class="form-control floating">
                                                                            </div>
                                                                         </td>

                                                                         <!-- HIDDEN-FIELD -->
                                                                         <input type="hidden" name="hiddenid" value="<?php echo $dataa['ID']; ?>">
                                                                         <input type="hidden" name="hiddenname" value="<?php echo $dataa['PATIENT_NAME']; ?>">
                                                                         <input type="hidden" name="hiddenleftmoney" value="<?php echo $leftpayment; ?>">
                                                                         <input type="hidden" name="hiddenpayedpayment" value="<?php echo $dataa['PATIENT_ADDED_MONEY']; ?>">

                                                                         <td><button name="pay" id="pay" style="height: 45px" class="btn btn-primary btn-block">Pay</button></td>

                                                                    </form>  

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

             </form>   

            </div>
        </div>



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