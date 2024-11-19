<?php include 'db.php';

    if(isset($_POST['btn']))
    {
        $email = $_POST['email'];
        $radiogp = $_POST['radiogp'];    

        if(empty($email))
        {
            $empty = " * Plz Enter Your Email";
        }
        else
        {
            
            // ADMIN
            if($radiogp == "Admin")
            {

                $query = " select count(*) as c from admin where EMAIL = '$email' ";

                $result = mysqli_query($con,$query);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $notfound = " * Email Not Found";
                }
                else
                {
                    $OTP = rand(100001,999999);

                    $to_email = $email;
                    $subject = "e-Healthcare";
                    $body = " Your One Time Password is : "."$OTP";
                    $headers = "From: romeoboxoffice5849@gmail.com";

                        if (mail($to_email, $subject, $body, $headers))
                        {
                            $success = "Email successfully sent to $to_email...";

                            session_start();
                            $_SESSION['OTPNUMBER']=$OTP;

                            $_SESSION['email']=$email;

                            $_SESSION['which']=$radiogp;

                            header("location:otp.php");
                        }
                        else
                        {
                            $faild = " * Email sending failed...Plz Check Your Internet Connection";
                        }
                }

            }

            // HOSPITAL
            if($radiogp == "Hospital")
            {
                $query = " select count(*) as c from hospital where EMAIL = '$email' ";

                $result = mysqli_query($con,$query);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $notfound = " * Email Not Found";
                }
                else
                {
                    $OTP = rand(100001,999999);

                    $to_email = $email;
                    $subject = "e-Healthcare";
                    $body = " Your One Time Password is : "."$OTP";
                    $headers = "From: romeoboxoffice5849@gmail.com";

                        if (mail($to_email, $subject, $body, $headers))
                        {
                            $success = "Email successfully sent to $to_email...";

                            session_start();
                            $_SESSION['OTPNUMBER']=$OTP;

                            $_SESSION['email']=$email;

                            $_SESSION['which']=$radiogp;

                            header("location:otp.php");
                        }
                        else
                        {
                            $faild = " * Email sending failed...Plz Check Your Internet Connection";
                        }
                }
            }
            

            // USER
            if($radiogp == "User")
            {
                $query = " select count(*) as c from user where EMAIL = '$email' ";

                $result = mysqli_query($con,$query);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $notfound = " * Email Not Found";
                }
                else
                {
                    $OTP = rand(100001,999999);

                    $to_email = $email;
                    $subject = "e-Healthcare";
                    $body = " Your One Time Password is : "."$OTP";
                    $headers = "From: romeoboxoffice5849@gmail.com";

                        if (mail($to_email, $subject, $body, $headers))
                        {
                            $success = "Email successfully sent to $to_email...";

                            session_start();
                            $_SESSION['OTPNUMBER']=$OTP;

                            $_SESSION['email']=$email;

                            $_SESSION['which']=$radiogp;

                            header("location:otp.php");
                        }
                        else
                        {
                            $faild = " *    Email sending failed...Plz Check Your Internet Connection";
                        }
                }
            }    

        }
    }

?>



<!DOCTYPE html>
<html lang="en">


<!-- forgot-password24:03-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>e-Healthcare</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->

    <style type="text/css">
        
        .maindiv
        {
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
            border: 1px solid lightgray;
            background-color: #ecf0f3;
        }

    </style>


</head>

<body style="background-color: #ecf0f3">
    <div class="main-wrapper account-wrapper " >
        <div class="account-page" >
			<div class="account-center" >
                <div class="account-box maindiv">
                    <form class="form-signin" method="post">
						<div class="account-logo">
                            <a href="index-2.html"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group" >
                            <label style="font-size: 12px;margin-left: 3px">Enter Your Email</label>
                            <input style="border: 1px solid lightgray ; border-radius: 5px" autocomplete="off" ONCLICK="ShowAndHide()" type="text" class="form-control" name="email" autofocus>
                        </div>


                        <div id="hide" style="margin-top: -15px;margin-bottom: 9px;margin-left: 4px;font-family: monospace;font-size: 12px;color: red">
                            <?php 
                                if(isset($empty)) { echo $empty; }
                                if(isset($notfound)) { echo $notfound; }
                                if(isset($faild)) { echo $faild; }
                                if(isset($success)) { echo $success; }
                            ?>
                        </div>


                        <div style="margin-top: -3px;margin-bottom: 7px;margin-left: 4px;text-align: center;">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" style="font-size: 15px" name="radiogp" id="inlineRadio1" value="Admin" checked>
                              <label class="form-check-label" style="font-size: 11px" for="inlineRadio1">Admin</label>
                            </div>

                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" style="font-size: 15px" name="radiogp" id="inlineRadio2" value="Hospital">
                              <label class="form-check-label" style="font-size: 11px" for="inlineRadio2">Hospital</label>
                            </div>

                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" style="font-size: 15px" name="radiogp" id="inlineRadio3" value="User">
                              <label class="form-check-label" style="font-size: 11px" for="inlineRadio3">User</label>
                            </div>
                        </div>


                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" name="btn" type="submit">Reset Password</button>
                        </div>
                        <div class="text-center register-link">
                            <a style="font-size: 12px" href="login.php">Back to Login</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
            function ShowAndHide() {

                var a = document.getElementById('hide');
                a.style.display = 'none';

            }    

    </script>            
</body>


<!-- forgot-password24:03-->
</html>