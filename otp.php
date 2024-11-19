<?php include 'db.php';

    // SECURITY
    // session_start();
    // if(isset($_SESSION['OTPNUMBER']))
    // {
        
    // }
    // else
    // {
    //     header("location:forgot_password.php");   
    // }

    session_start();
    $session_otp = $_SESSION['OTPNUMBER'];
    $session_email = $_SESSION['email'];
    $session_which = $_SESSION['which'];

    if(isset($_POST['btn']))
    {

        $textotp = $_POST['textotp'];

        if(empty($textotp))
        {
            $empty = " * Plz Enter Your OTP";
        }
        else
        {
            if($session_otp == $textotp)
            {
                header("location:change_password.php");
            }
            else
            {
                $wrong = " * Wrong OTP..Plz Enter Correct OTP ";
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
                            <label style="font-size: 12px;margin-left: 3px">Enter Your One Time Password (OTP)</label>
                            <input style="border: 1px solid lightgray ; border-radius: 5px" placeholder="OTP" ONCLICK="ShowAndHide()" autocomplete="off" type="text" class="form-control" name="textotp" autofocus>
                        </div>


                        <div id="hide" style="margin-top: -15px;margin-bottom: 9px;margin-left: 4px;font-family: monospace;font-size: 12px;color: red">
                            <?php 
                                if(isset($empty)) { echo $empty; }
                                if(isset($wrong)) { echo $wrong; }
                            ?> 
                        </div>



                        <div class="form-group text-center" style="margin-top: 10px">
                            <button class="btn btn-primary account-btn" name="btn" type="submit">Send</button>
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