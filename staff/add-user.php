<?php 

    require 'header-staff.php';
    include('../connection.php');

    $email = $_SESSION['staff_login'];
    
    if(isset($_POST['user_register']))
    {
        $companyname = $_POST['companyname'];
        $companyemail = $_POST['companyemail'];
        $password = $_POST['password'];
        $phnumber = $_POST['phnumber'];
        $streetname = $_POST['streetname'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $fullname = $_POST['fullname'];

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $input_errors = array();

        if(empty($companyname)){
            $input_errors['companyname'] = "company Name Field Is Required!";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $companyname) )
        {  
            $input_errors['companyname'] = " companyname  is Invalid ";
        } 
        if(empty($companyemail)){
            $input_errors['companyemail'] = "Email Address Field Is Required!";
        }
        if(empty($phnumber)){
            $input_errors['phnumber'] = "phone Number Field Is Required!";
        }
        elseif(strlen($phnumber)<10)
        {
            $input_errors['phnumber'] = "phone Number should have 10 digits!";   
        }
        elseif(!preg_match("/^[6-9]\d{9}$/",$phnumber))
        {
            $input_errors['phnumber'] = "phone Number is Invalid!";   
        }
        if(empty($streetname)){
            $input_errors['streetname'] = "Street name Field Is Required!";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $streetname) )
        {  
            $input_errors['streetname'] = " streetname  is Invalid ";
        } 
        if(empty($city)){
            $input_errors['city'] = "city  Field Is Required!";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $city) )
        {  
            $input_errors['city'] = " city  is Invalid ";
        } 
        if(empty($state)){
            $input_errors['state'] = "Contact Number Field Is Required!";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $state) )
        {  
            $input_errors['state'] = " state  is Invalid ";
        } 
        if(empty($district)){
            $input_errors['district'] = "District  Field Is Required!";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $district) )
        {  
            $input_errors['district'] = " district  is Invalid ";
        } 
        if(empty($pincode)){
            $input_errors['pincode'] = "pincode Field Is Required!";
        }
        elseif(strlen($pincode) != 6)
        {
            $input_errors['pincode'] = "pincode is Invalid";
        }
        if(empty($password)){
            $input_errors['password'] = "Password Field Is Required!";
        }
        

        $fresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email = '$email'");

        while ($row = mysqli_fetch_assoc($fresult)) 
        {
            $stationcode = $row['stationcode'];

           if(count($input_errors) == 0)
            {
                if(strlen($password) > 5)
                {    
                    $result = mysqli_query($connect, " INSERT INTO `user`(stationcode,companyname,phnumber,companyemail,streetname,city,district,state,pincode,fullname,password) VALUES ('$stationcode','$companyname','$phnumber','$companyemail','$streetname','$city','$district','$state','$pincode','$fullname','$password')");                    
                    if($result)
                    {
                        $success="Registered Successfully";
                    }
                }
                    else
                {
                    $password_exits = "Password Need To Be More Than 5 Charaters!";
                }
            } 
            else
            {
                $error="Something went Wrong";
            }
        }
        
    }

?>


<html>
<head>
<link href="../css/style.css" rel="StyleSheet">
    <link href="../css/bootstrap.min.css" rel="StyleSheet">   
</head>
<body style="background-color:#FFFFE0">
<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4 text-center">Register User</h1>
                        <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">

                            <?php 
                                if(isset($success)){
                                    ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

                            <?php 
                                if(isset($error)){
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

                            <?php 
                                if(isset($email_exits)){
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $email_exits ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

                            <?php 
                                if(isset($password_exits)){
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $password_exits ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="companyname">Company Name</label>
                                <input id="companyname" type="text" class="form-control" name="companyname" value=""
                                    placeholder="Please Enter company Name" required autofocus>
                                <?php 
                                        if(isset($input_errors['companyname'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['companyname'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="companyemail">E-Mail Address</label>
                                <input id="companyemail" type="email" class="form-control" name="companyemail" value=""
                                    placeholder="Please Enter Email Address" required>
                                <?php 
                                        if(isset($input_errors['companyemail'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['companyemail'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="streetname">Street name</label>
                                <input id="streetname" type="text" class="form-control" name="streetname" value=""
                                    placeholder="Please Enter street name" required>
                                <?php 
                                        if(isset($input_errors['streetname'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['streetname'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="city">City</label>
                                <input id="city" type="text" class="form-control" name="city" value=""
                                    placeholder="Please Enter city name" required>
                                <?php 
                                        if(isset($input_errors['city'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['city'].'</span>';
                                        }
                                    ?>
                            </div>
                            
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="district">District</label>
                                <input id="district" type="text" class="form-control" name="district" value=""
                                    placeholder="Please Enter district name" required>
                                <?php 
                                        if(isset($input_errors['district'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['district'].'</span>';
                                        }
                                    ?>
                            </div>
                            

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="state">State</label>
                                <input id="state" type="text" class="form-control" name="state" value=""
                                    placeholder="Please Enter state name" required>
                                <?php 
                                        if(isset($input_errors['state'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['city'].'</span>';
                                        }
                                    ?>
                            </div>
                            
                            <div class="mb-3">
                                
                                <label class="mb-2 text-muted" for="pincode">Pincode</label>
                                <input id="pincode" type="text" class="form-control" name="pincode" value=""
                                    placeholder="Please Enter pincode" required>
                                <?php 
                                        if(isset($input_errors['pincode'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['pincode'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="fullname">Delivery Boy</label>
                                <select class="form-control" id="fullname" name="fullname">
                                    <option value="">select</option>
                                    <?php

                                            $fresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email = '$email'");

                                            while ($row = mysqli_fetch_assoc($fresult)) 
                                            {
                                            $stationcode = $row['stationcode'];

                                            $result = mysqli_query($connect,"SELECT * FROM `staff` WHERE stationcode='$stationcode' AND position='delivery'");
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                    ?>
                                    <option value="<?= $row['fullname'] ?>"><?= $row['fullname'] ?></option>            
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php 
                                        if(isset($input_errors['fullname']))
                                        {
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['fullname'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="phnumber">Phone Number</label>
                                <input id="phnumber" type="text" class="form-control" name="phnumber" value=""
                                    placeholder="Please Enter phone Number" pattern="01[3|5|6|7|8|9][0-9]{8}" required
                                    autofocus>
                                <?php 
                                        if(isset($input_errors['phnumber'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['phnumber'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password"
                                    placeholder="Please Enter Password" required>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                                <?php 
                                        if(isset($input_errors['password'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['password'].'</span>';
                                        }
                                    ?>
                            </div>


                            <div class="text-center mt-5">
                                <button type="submit" name="user_register" class="btn btn-dark ms-auto">
                                    Register user
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-5 mb-3 text-muted">
                    Copyright &copy; 2022 Courier Management System
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
