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
    $session_email = $_SESSION['email'];
    $session_which = $_SESSION['which'];
    $which = strtolower($session_which);

    if(isset($_POST['btn']))
    {

        $pass = $_POST['pass'];
        $c_pass = $_POST['c_pass'];

        if(empty($pass) || empty($c_pass))
        {
            $empty = " * Plz Enter Both Password";
        }
        else
        {
            if($pass == $c_pass)
            {
                echo $session_email;echo "<br><br>";
                echo $session_which;echo "<br><br>";
                echo $which;echo "<br><br>";

                $query = "update ".$which." set PASSWORD='$pass' where EMAIL='$session_email' ";

                echo $query;

                mysqli_query($con,$query);

                header("location:login.php");

            }
            else
            {
                $wrong = " * Both Password are not same ";
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
                            <label style="font-size: 12px;margin-left: 3px">Enter Your New Password</label>
                            <input style="border: 1px solid lightgray ; border-radius: 5px" placeholder="New Password" ONCLICK="ShowAndHide()" autocomplete="off" type="password" class="form-control" name="pass" autofocus>
                            <input style="border: 1px solid lightgray ; border-radius: 5px ; margin-top: 8px" placeholder="Confirm Password" ONCLICK="ShowAndHide()" autocomplete="off" type="password" class="form-control" name="c_pass" autofocus>
                        </div>


                        <div id="hide" style="margin-top: -15px;margin-bottom: 9px;margin-left: 4px;font-family: monospace;font-size: 12px;color: red">
                            <?php 
                                if(isset($empty)) { echo $empty; }
                                if(isset($wrong)) { echo $wrong; }
                            ?> 
                        </div>



                        <div class="form-group text-center" style="margin-top: 17px">
                            <button class="btn btn-primary account-btn" name="btn" type="submit">Done</button>
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