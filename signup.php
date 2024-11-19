<?php include 'db.php';

    if(isset($_POST['admin_submit']))
    {
        // die();
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];   
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $a_aadhar = $_POST['a_aadhar'];
        $a_city = $_POST['a_city'];

    

        if(empty($_POST['f_name']) || empty($_POST['l_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['c_password']) || empty($_POST['dob']) || empty($_POST['contact']) || empty($_POST['a_aadhar']) || empty($_POST['a_city']) )
        
            {
               $empty=" * Please fill all the fields";
            }
        else
        { 
            if($password != $c_password)
            {
                $passnotsame = " * Both Password are not same";
            }
            else
            {

                $query = " select count(*) as c from admin where EMAIL = '$email' ";

                $result = mysqli_query($con,$query);

                $data = mysqli_fetch_assoc($result);

                if(!empty($data['c']))
                {
                    $admin_allready = " * Admin Allready Registered";
                }
                else
                {
                    
                    $query = " insert into admin ( F_NAME , L_NAME , EMAIL , PASSWORD , GENDER , DOB , CONTACT , AADHAR , CITY) values ('$f_name' , '$l_name' , '$email' , '$password' , '$gender' , '$dob' , '$contact' , '$a_aadhar' , '$a_city' ) ";
                    $result = mysqli_query($con,$query);

                    // ADMIN-FOLDER
                    $dir = 'admin/'.$email;
                    mkdir($dir);

                    header("location: login.php");
                }

            }
        }   
    }
    
    if(isset($_POST['hospital_submit']))
    {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];   
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $h_name = $_POST['h_name'];
        $h_e_contact = $_POST['h_e_contact'];
        $h_state = $_POST['h_state'];
        $h_city = $_POST['h_city'];
        $h_district = $_POST['h_district'];
        $h_add_num = $_POST['h_add_num'];
        $h_add_lacality = $_POST['h_add_lacality'];
        $h_add_landmark = $_POST['h_add_landmark'];
        $h_add_pin = $_POST['h_add_pin'];
        $h_des = $_POST['h_des'];

        if(empty($_POST['f_name']) || empty($_POST['l_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['c_password']) || empty($_POST['dob']) || empty($_POST['contact']) || empty($_POST['h_name']) || empty($_POST['h_e_contact']) || empty($_POST['h_state']) || empty($_POST['h_city']) || empty($_POST['h_district']) || empty($_POST['h_add_num']) || empty($_POST['h_add_lacality']) || empty($_POST['h_add_landmark']) || empty($_POST['h_add_pin']) || empty($_POST['h_des'])  )
            {
                $empty=" * Please fill all the fields";
            }
        else
        {
            
            if($password != $c_password)
            {
                $passnotsame = " * Both Password are not same";
            }

            else
            {

                $query = " select count(*) as c from hospital where EMAIL = '$email' ";

                $result = mysqli_query($con,$query);

                $data = mysqli_fetch_assoc($result);

                if(!empty($data['c']))
                {
                    $hospital_allready = " * Hospital Allready Registered";
                }
                else
                {
                    $query = " insert into hospital ( F_NAME , L_NAME , EMAIL , PASSWORD , DOB , CONTACT , HOSPITAL_NAME , H_E_CONTACT , H_STATE , H_CITY , H_DISTRICT , H_ADD_NUM , H_ADD_LOCALITY , H_ADD_LANDMARK , H_ADD_PIN , H_DES ) values ('$f_name' , '$l_name' , '$email' , '$password' , '$dob' , '$contact' , '$h_name' , '$h_e_contact' , '$h_state' , '$h_city' , '$h_district' , '$h_add_num' , '$h_add_lacality' , '$h_add_landmark' , '$h_add_pin' , '$h_des' ) ";
                    $result = mysqli_query($con,$query);

                    // HOSPITAL-FOLDER
                    $dir = 'hospital/'.$email;
                    mkdir($dir);

                    // $dir2 = 'doctor/'.$h_name;
                    // mkdir($dir2);

                    header("Location: login.php");
                }

            }

        }   
    }

    if(isset($_POST['user_submit']))
    {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];   
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $u_aadhar = $_POST['u_aadhar'];
        $u_bg = $_POST['u_bg'];
        $u_qua = $_POST['u_qua'];
        $u_alt_contact = $_POST['u_alt_contact'];
        $u_state = $_POST['u_state'];
        $u_city = $_POST['u_city'];
        $u_district = $_POST['u_district'];
        $u_add_number = $_POST['u_add_number'];
        $u_add_locality = $_POST['u_add_locality'];
        $u_add_landmark = $_POST['u_add_landmark'];
        $u_add_pin = $_POST['u_add_pin'];
        

        if(empty($_POST['f_name']) || empty($_POST['l_name']) || empty($email) || empty($password) || empty($c_password) || empty($dob) || empty($contact) || empty($u_aadhar) || empty($u_bg) || empty($u_qua) || empty($u_alt_contact) || empty($u_state) || empty($u_city) || empty($u_district) || empty($u_add_number) || empty($u_add_landmark) || empty($u_add_locality) || empty($u_add_pin) )
            {
                $empty=" * Please fill all the fields";
            }
        else
        {
            
            if($password != $c_password)
            {
                $passnotsame = " * Both Password are not same";
            }

            else
            {

                $query = " select count(*) as c from user where EMAIL = '$email' ";

                $result = mysqli_query($con,$query);

                $data = mysqli_fetch_assoc($result);

                if(!empty($data['c']))
                {
                    $user_allready = " * User Allready Registered";
                }
                else
                {
                    $query = " insert into user ( F_NAME , L_NAME , EMAIL , PASSWORD , DOB , CONTACT , AADHAR , BLOOD_GROUP , QUALIFICATION , ALTERNATE_CONTACT , U_STATE , U_CITY , U_DISTRICT , U_ADD_NUM , U_ADD_LOCALITY , U_ADD_LANDMARK , U_ADD_PIN ) values ('$f_name' , '$l_name' , '$email' , '$password' , '$dob' , '$contact' , '$u_aadhar' , '$u_bg' , '$u_qua' , '$u_alt_contact' , '$u_state' , '$u_city' , '$u_district' , '$u_add_number' , '$u_add_locality' , '$u_add_landmark' , '$u_add_pin' ) ";
                    $result = mysqli_query($con,$query);

                    // USER-FOLDER
                    $dir = 'user/'.$email;
                    mkdir($dir);

                    header("Location: login.php");
                }

            }
        }   
    }
?>

<!DOCTYPE html>
<html>
<head>

	<title>Signup</title> 

    <!-- SCRIPT -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- LINK -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"  />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<style type="text/css">
		
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

             * {
                 margin: 0;
                 padding: 0;
                 box-sizing: border-box;
                 font-family: 'Poppins', sans-serif
             }

             body {
                 background: #ecf0f3;
             }

             .wrapper {
                 max-width: 700px;
                 /*min-height: 800px;*/
                 margin-top: 20px;
                 padding: 20px 0px 0px 0px;
                 background-color: #ecf0f3;
                 border-radius: 15px;
                 box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
                 margin-bottom: 25px;
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
                 border-radius: 10px;
                 box-shadow: inset 2px 2px 2px #cbced1, inset -2px -2px 2px lightgray;
                 border: 1px solid lightgray
             }

             .wrapper .form-field .fas {
                 color: #555
             }

             /*.wrapper .btn {
                 box-shadow: none;
                 width: 100%;
                 height: 40px;
                 background-color: #03A9F4;
                 color: #fff;
                 border-radius: 25px;
                 box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
                 letter-spacing: 1.3px
             }*/

             /*.wrapper .btn:hover {
                 background-color: #039BE5
             }*/

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



                ul {
                  list-style-type: none;
                  margin: 0;
                  padding: 0;
                  overflow: hidden;
                }

                li {
                  float: left;
                }

                li a {
                  display: block;
                  color: white;
                  text-align: center;
                  padding: 8px;
                  text-decoration: none;
                }

                .error
                 {
                    margin-top: -14px;
                    margin-left: 10px;
                    margin-bottom: 3px;
                    color:red;
                    font-size: 12px;
                    font-family: monospace;
                 }

                 .errorallready
                 {
                    margin-top: 8px;
                    /*margin-left: 10px;
                    margin-bottom: 3px;*/
                    color:red;
                    font-size: 12px;
                    font-family: monospace;
                 }

	</style>

</head>
<body> 
<!-- Nav-bar -->
<nav class="navbar navbar-expand-lg bg-primary" style=" position: static;">
    <table style="width: 100%">
        <tr>
            <td>
                
                <h2 class="name" style="font-size: 20px;margin-top:auto; margin-bottom:auto; margin-left: 10px ; color: white"> e-healthcare</h2>

            </td>
            <td style="text-align: right;padding-right: 10px">
                
                
                    <a href="login.php" name="login" class="btn btn-outline-light" style="align-items: right;">login</a>
                

            </td>
        </tr>
    </table>
</nav>


<!-- MAIN-FORM -->
<center>
        <div class="wrapper">

            <div class="text-center name"> Sign-up </div>

            <form class="p-4 mt-3" method="post" action="">

                <table width="100%" cellspacing="10">

                    <tr>
                        <td colspan="6" >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input style="height: 45px;font-size: 15px;color: black" type="text" name="f_name" id="f_name" placeholder="First Name" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td colspan="6" >
                            
                            <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input style="height: 45px;font-size: 15px;color: black" type="text" name="l_name" id="l_name" placeholder="Last Name" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                    </tr>


                    <tr>
                        <td colspan="12">
                            
                            <div class="form-field d-flex align-items-center"> <i class="far fa-envelope"></i> <input style="height: 45px;font-size: 15px;color: black" type="email" name="email" id="email" placeholder="Email" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                    </tr>


                    <tr>
                        <td colspan="6" >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"> <i class="fas fa-key"></i> <input style="height: 45px;font-size: 15px;color: black" type="password" name="password" id="password" placeholder="Password" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td colspan="6" >
                            
                            <div class="form-field d-flex align-items-center"> <i class="fas fa-key"></i> <input style="height: 45px;font-size: 15px;color: black" type="password" name="c_password" id="c_password" placeholder="Confirm Password" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="error" style="text-align: left;" id="passnotsame"> 

                                <?php if(isset($passnotsame)) {echo $passnotsame;} ?>

                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td colspan="6" >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"></i> <input style="height: 45px;font-size: 15px;color: black" type="date" name="dob" id="dob" placeholder="DOB" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td colspan="6" >
                            
                            <i class="bi bi-gender-ambiguous"></i>
                            <select name="gender" style="background-color: #ecf0f3;height: 45px;font-size: 15px;color: black" class="select form-field form-control ">
                                <option style="background-color: #ecf0f3" value="male">Male</option>
                                <option style="background-color: #ecf0f3" value="female">Female</option>
                                <option style="background-color: #ecf0f3" value="other">Other</option>
                            </select>

                        </td>

                </table> 

                <!-- Contact -->
                <div class="form-field d-flex align-items-center"> <i class="fas fa-phone"></i> <input style="height: 45px;font-size: 15px;color: black" type="contact" maxlength="10" name="contact" id="txtFirst" placeholder="Contact" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        



            <!-- buttons -->
            <div>
                <button type="button" style="width: 120px;margin-right: 10px" class="btn btn-outline-primary ad">Admin</button>
                <button type="button" style="width: 120px" class="btn btn-outline-primary ho">Hospital</button>
                <button type="button" style="width: 120px;margin-left: 10px" class="btn btn-outline-primary us">User</button>
            </div>

            <div class="errorallready" style="text-align: center;" id="allready"> 

                <?php 
                    if(isset($admin_allready)) {echo $admin_allready;} 
                    if(isset($hospital_allready)) {echo $hospital_allready;} 
                    if(isset($user_allready)) {echo $user_allready;} 
                ?>

            </div>


            <!-- ADMIN -->
            <div class="admin" style="display: none;border: 0.5px solid lightgray ; margin-top: 20px ; padding: 15px ; border-radius: 10px ; margin-bottom: 0px">

                <div class="form-field d-flex align-items-center"> <i class="far fa-address-card"></i> <input style="height: 40px;font-size: 15px;color: black" type="contact" name="a_aadhar" id="a_aadhar" placeholder="Admin Aadhar Number" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <div class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="a_city" id="a_city" placeholder="City" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <!-- error -->
                <div class="error" style="text-align: left;" id="adminempty"> 

                    <?php if(isset($empty)) {echo $empty;} ?>

                 </div>

                <button type="submit" name="admin_submit" value="admin" style="width: 100%;align-items: left ;margin-top: 4px" class="btn btn-success">Admin Register</button>
                
            </div>






            <!-- HOSPITAL -->
            <div class="hospital" style="display: none;border: 0.5px solid lightgray ; margin-top: 20px ; padding: 15px ; border-radius: 10px ; margin-bottom: 0px">
                

                <table width="100%">
                    <tr>
                        <td width="65%">
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"> <i class="fas fa-clinic-medical"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_name" id="h_name" placeholder="Hospital Name" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>

                        <td width="35%">
                            <div class="form-field d-flex align-items-center"> <i class="fas fa-phone"></i> <input style="height: 40px;font-size: 15px;color: black" type="contact" name="h_e_contact" id="h_e_contact" placeholder="Emergency Number" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>
                    </tr>
                </table>

                <table width="100%">
                    <tr>
                        <td >
                            <div style="margin-right: 10px" class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px" type="text" name="h_state" id="h_state" placeholder="State" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>

                        <td >
                            <div class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_city" id="h_city" placeholder="City" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>

                        <td >
                            <div style="margin-left: 10px" class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_district" id="h_district" placeholder="District" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>
                    </tr>
                </table>

                <div class="form-field d-flex align-items-center"> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_add_num" id="h_add_num" placeholder="Hospital Number / Address" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <div class="form-field d-flex align-items-center"> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_add_lacality" id="h_add_lacality" placeholder="Locality" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <table width="100%">
                    <tr>
                        <td >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_add_landmark" id="h_add_landmark" placeholder="Landmark" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td >
                            
                            <div class="form-field d-flex align-items-center">  <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_add_pin" id="h_add_pin" placeholder="PIN" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                    </tr>
                </table>

                <div class="form-field d-flex align-items-center"> <i class="fas fa-info-circle"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="h_des" id="h_des" placeholder="Basic Information Regarding Your Hospital" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <!-- error -->
                <div class="error" style="text-align: left;" id="hospitalempty"> 

                    <?php if(isset($empty)) {echo $empty;} ?>

                 </div>    


                <button type="submit" name="hospital_submit" value="hospital" style="width: 100%;align-items: left ;margin-top: 4px" class="btn btn-success">Hospital Register</button>

            </div>





            <!-- USER -->
            <div class="user" style="display: none;border: 0.5px solid lightgray ; margin-top: 20px ; padding: 15px ; border-radius: 10px ; margin-bottom: 0px">
                
                <div class="form-field d-flex align-items-center"> <i class="far fa-address-card"></i> <input style="height: 40px;font-size: 15px;color: black" type="number" name="u_aadhar" id="u_aadhar" placeholder="Aadhar Number" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <table width="100%">
                    <tr>
                        <td >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"> <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_bg" id="u_bg" placeholder="Blood Group" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td >
                            
                            <div class="form-field d-flex align-items-center"> <i class="fas fa-user-graduate"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_qua" id="u_qua" placeholder="Qualification" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                    </tr>

                    <tr>
                        <td >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center"> <i class="fas fa-phone"></i> <input style="height: 40px;font-size: 15px;color: black" type="number" name="u_alt_contact" id="u_alt_contact" placeholder="Alternate Number" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td >
                            
                            <div style="background-color: lightgray" class="form-field d-flex align-items-center"> <i class="fas fa-phone"></i> <input style="height: 40px;font-size: 15px;color: black;" type="contact" name="u_contact" id="txtSecond" placeholder="User Number" autocomplete="off" disabled> </div>

                        </td>
                    </tr>
                </table>


                <table width="100%">
                    <tr>
                        <td >
                            <div style="margin-right: 10px" class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px" type="text" name="u_state" id="u_state" placeholder="State" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>

                        <td >
                            <div class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_city" id="u_city" placeholder="City" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>

                        <td >
                            <div style="margin-left: 10px" class="form-field d-flex align-items-center"> <i class="fas fa-map-marker-alt"></i> <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_district" id="u_district" placeholder="District" autocomplete="off" ONCLICK="ShowAndHide()"> </div>
                        </td>
                    </tr>
                </table>

                <div class="form-field d-flex align-items-center"> <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_add_number" id="u_add_number" placeholder="House / Door / Flat No." autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <div class="form-field d-flex align-items-center">  <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_add_locality" id="u_add_locality" placeholder="Lacality" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                <table width="100%">
                    <tr>
                        <td >
                            
                            <div style="margin-right: 20px" class="form-field d-flex align-items-center">  <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_add_landmark" id="u_add_landmark" placeholder="Landmark" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                        <td >
                            
                            <div class="form-field d-flex align-items-center">  <input style="height: 40px;font-size: 15px;color: black" type="text" name="u_add_pin" id="u_add_pin" placeholder="PIN" autocomplete="off" ONCLICK="ShowAndHide()"> </div>

                        </td>
                    </tr>
                </table>


                <!-- error -->
                <div class="error" style="text-align: left;" id="userempty"> 

                    <?php if(isset($empty)) {echo $empty;} ?>

                 </div>    

                <button type="submit" name="user_submit" value="user" style="width: 100%;align-items: left ;margin-top: 4px" class="btn btn-success">User Register</button>

            </div>

        </form> 

    </div>  
     
</center>


        <!-- SCRIPT -->
        <script>
            function ShowAndHide() {

                var a = document.getElementById('passnotsame');
                a.style.display = 'none';

                var b = document.getElementById('adminempty');
                b.style.display = 'none';

                var c = document.getElementById('hospitalempty');
                c.style.display = 'none';

                var d = document.getElementById('userempty');
                d.style.display = 'none';

                var e = document.getElementById('allready');
                e.style.display = 'none';
            }
        </script>



        <script>

            $('document').ready(function(){
                $('button.ad').click(function(){
                    $('div.hospital').hide();
                    $('div.user').hide();
                    $('div.admin').animate({height:'show'});
                });
            });

            $('document').ready(function(){
                $('button.ho').click(function(){
                    $('div.admin').hide();
                    $('div.user').hide();
                    $('div.hospital').animate({height:'show'});
                });
            });

            $('document').ready(function(){
                $('button.us').click(function(){
                    $('div.hospital').hide();
                    $('div.admin').hide();
                    $('div.user').animate({height:'show'});
                });
            });

        </script>   




        <script type="text/javascript">
  

          $(document).ready(function() {
            $('#txtFirst').keyup(function(e) {
                var txtVal = $(this).val();
                $('#txtSecond').val(txtVal);
            });
            
            $('#txtSecond').keyup(function(e) {
                var txtVal = $(this).val();
                $('#txtFirst').val(txtVal);
            });
        });


        </script>

    


</body>
</html>


