<?php include 'db.php'; 

    if(isset($_POST['login']))
    {
        if(empty($_POST['unique_id']) || empty($_POST['password']) )
        {
            $empty = " * Please fill all the fields";
        }
        else
        {
            $unique_id = $_POST['unique_id'];
            $password = $_POST['password'];
            $radiogp = $_POST['radiogp'];

            // ADMIN
            if($radiogp == "Admin")
            {
                $relogin = " select count(*) as c from admin where UNIQUE_ID = '$unique_id' && PASSWORD = '$password' ";

                $result = mysqli_query($con,$relogin);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $wrong = " * Unique-ID and Password are wrong";
                }
                else
                {
                        $query = "select STATUS from admin where UNIQUE_ID='$unique_id'";
                        $result = mysqli_query($con,$query);
                        $data = mysqli_fetch_assoc($result);

                        if($data['STATUS'] == '0')
                        {
                            
                            $blockadmin = " * Your Account Is Temporary Blocked !";
                        }
                        else
                        {
                            session_start();
                            $_SESSION['unique']=$unique_id;
                            header("location:adminmainpage.php");
                        }
                }
            }

            // HOSPITAL
            if($radiogp == "Hospital")
            {
                $relogin = " select count(*) as c from hospital where UNIQUE_ID = '$unique_id' && PASSWORD = '$password' ";

                $result = mysqli_query($con,$relogin);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $wrong = " * Unique-ID and Password are wrong";
                }
                else
                {
                        $query = "select STATUS from hospital where UNIQUE_ID='$unique_id'";
                        $result = mysqli_query($con,$query);
                        $data = mysqli_fetch_assoc($result);

                        if($data['STATUS'] == '0')
                        {
                            
                            $blockadmin = " * Your Account Is Temporary Blocked !";
                        }
                        else
                        {
                            session_start();
                            $_SESSION['unique_hospital']=$unique_id;
                            header("location:hospital_mainpage.php");
                        }
                }
            }

            // USER
            if($radiogp == "User")
            {
                $relogin = " select count(*) as c from user where UNIQUE_ID = '$unique_id' && PASSWORD = '$password' ";

                $result = mysqli_query($con,$relogin);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $wrong = " * Unique-ID and Password are wrong";
                }
                else
                {
                        $query = "select STATUS from user where UNIQUE_ID='$unique_id'";
                        $result = mysqli_query($con,$query);
                        $data = mysqli_fetch_assoc($result);

                        if($data['STATUS'] == '0')
                        {
                            
                            $blockadmin = " * Your Account Is Temporary Blocked !";
                        }
                        else
                        {
                            session_start();
                            $_SESSION['unique_user']=$unique_id;
                            header("location:user_mainpage.php");
                        }
                }
            }





            // DOCTOR
            if(empty($radiogp))
            {
                $relogin = " select count(*) as c from doctor where U_NAME='$unique_id' && PASSWORD = '$password' ";

                $result = mysqli_query($con,$relogin);

                $data = mysqli_fetch_assoc($result);

                if(empty($data['c']))
                {
                    $wrong = " * Username and Password are wrong";
                }
                else
                {
                            session_start();
                            $_SESSION['unique_doctor']=$unique_id;
                            header("location:doctor_mainpage.php");
                }
            }



            
        }    
    }
?>

<!DOCTYPE html>
<html>
<head>

	<title>login</title>

    <!-- LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"  />

    <!-- SCRIPT -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	
	<style type="text/css">
		
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

             * {
                 margin: 0;
                 padding: 0;
                 box-sizing: border-box;
                 font-family: 'Poppins', sans-serif
             }

             .maindiv
        {
            position: absolute;
            /*background-color: red;*/
            display: flex;
            width: 100%;
            height: 756px;
        }

        .left
        {
            position: relative;
            /*background-color: #F1948A ;*/
            background-repeat: no-repeat;
            background-size: cover;
            width: 55%;
            height: auto;
            opacity: 0.6;
            background-image: url("https://images.pexels.com/photos/5863391/pexels-photo-5863391.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500");
            /*background-image: url("https://images.pexels.com/photos/4108480/pexels-photo-4108480.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500");*/
            /*background-image: url("https://images.pexels.com/photos/5863374/pexels-photo-5863374.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500");*/
            /*background-image: url("https://images.pexels.com/photos/4047187/pexels-photo-4047187.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500");*/ 
        }

        .right
        {
            position: relative;
            background-color: #ecf0f3;
            width: 45%;
            height: auto;
            margin-top: 50px;
            margin-left: 8px
        }

             body {
                 background: #ecf0f3
             }

             .wrapper {
                 max-width: 350px;
                 min-height: 500px;
                 margin: 80px auto;
                 padding: 40px 30px 30px 30px;
                 background-color: #ecf0f3;
                 border-radius: 15px;
                 box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
                 border: 1px solid lightgray;

             }

             .logo {
                 width: 100px;
                 /*height:200px;*/
                 margin: auto;
                 /*margin-left: -5px;*/
             }

             .logo img {
                 width: 120%;
                 height: 120px;
                 object-fit: cover;
                 border-radius: 50%;
                 box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff;
                 margin: auto
             }

             .wrapper .name {
                 font-weight: 600;
                 font-size: 1.4rem;
                 letter-spacing: 1.3px;
                 padding-left: 10px;
                 color: #555
             }

             .wrapper .form-field input {
                 width: 100%;
                 display: block;
                 border: none;
                 outline: none;
                 background: none;
                 font-size: 1.2rem;
                 color: #666;
                 padding: 10px 15px 10px 10px
             }

             .wrapper .form-field {
                 padding-left: 10px;
                 margin-bottom: 20px;
                 border-radius: 15px;
                 box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
             }

             .wrapper .form-field .fas {
                 color: #555
             }

             .wrapper .btn {
                 box-shadow: none;
                 width: 100%;
                 height: 40px;
                 background-color: #03A9F4;
                 color: #fff;
                 border-radius: 25px;
                 box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
                 letter-spacing: 1.3px
             }

             .wrapper .btn:hover {
                 background-color: #039BE5
             }

             .wrapper a {
                 text-decoration: none;
                 font-size: 0.8rem;
                 color: #03A9F4
             }

             .wrapper a:hover {
                 color: #039BE5
             }

             @media(max-width: 380px) {
                 .wrapper {
                     margin: 30px 20px;
                     padding: 40px 15px 15px 15px
                 }
             }

             .error
             {
                margin-top: -10px;
                margin-left: 2px;
                color:red;
                font-size: 12px;
                font-family: monospace;
             }


	</style>


</head>
<body>


    <div class="maindiv">
        
        <div class="left"></div>

        <div class="right">

        <div class="wrapper">

            <div class="logo"> <img src="https://cdn.zeebiz.com/sites/default/files/styles/zeebiz_850x478/public/2021/09/29/160705-untitled-design-2021-09-29t132818745.jpg?itok=CyVceTgK" alt=""> </div>

            <div class="text-center mt-4 name"> e-healthcare </div>

            <form class="p-3 mt-3" method="post">

                <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input style="height: 45px;font-size: 14px;color: black" type="text" name="unique_id" id="unique" placeholder="Unique-ID" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input style="height: 45px;font-size: 14px;color: black" type="password" name="password" id="password" placeholder="Password" autocomplete="off" ONCLICK="ShowAndHide()"> </div>


                <div class="align-items-center error" id="empty"> 

                    <?php  
                        if(isset($empty)) { echo $empty; }  
                        if(isset($wrong)) { echo $wrong; }
                        if(isset($blockadmin)) { echo $blockadmin; } 
                    ?>
                
                </div>



                <div style="text-align: center ; padding-top: 5px ;">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" style="font-size: 15px" name="radiogp" id="inlineRadio1" value="Admin">
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



                 <button class="btn mt-2" style="" name="login">Login</button>

                </form>

                <div class="text-center fs-6"> <a href="forgot_password.php">Forget password?</a> or <a href="signup.php">Sign up</a> </div>

            </div>



            
        </div>

    </div>



    
    <!-- SCRIPT -->
	<script>
		function ShowAndHide() {
		    var x = document.getElementById('empty');
		    x.style.display = 'none';
		}
	</script>  

</body>
</html>

