<?php 

    require_once 'header-admin.php';
    include('../connection.php');

    if(isset($_POST['staff_register'])){

        $fullname = $_POST['fullname'];
        $stationcode = $_POST['stationcode'];
        $position = $_POST['position'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phnumber = $_POST['phnumber'];
        $housename = $_POST['housename'];
        $streetname = $_POST['streetname'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $input_errors = array();

      
        if(empty($fullname)){
            $input_errors['fullname'] = "Full Name Field Is Required!";
        }
        if (ctype_alpha(str_replace(' ', '', $fullname)) === false) 
        {
            $input_errors['fullname'] = 'fullname is invalid';
        } 
        if(empty($email)){
            $input_errors['email'] = "Email Address Field Is Required!";
        }
        if(empty($position)){
            $input_errors['position'] = "position  Field Is Required!";
        }
        if(empty($stationcode)){
            $input_errors['stationcode'] = "station code Field Is Required!";
        }
        if(empty($phnumber)){
            $input_errors['phnumber'] = "phone Number is Field Is Required!";
        }
        elseif(strlen($phnumber)<10)
        {
            $input_errors['phnumber'] = "phone Number should have 10 digits!";   
        }
        elseif(!preg_match("/^[6-9]\d{9}$/",$phnumber))
        {
            $input_errors['phnumber'] = "phone Number is Invalid!";   
        }
        if(empty($housename))
        {
            $input_errors['housename'] = "house Name Field Is Required!";
        }
        if (ctype_alpha(str_replace(' ', '', $housename)) === false) 
        {
            $input_errors['housename'] = 'housename is invalid';
        } 
        if(empty($streetname)){
            $input_errors[''] = "Street name Field Is Required!";
        }
        if (ctype_alpha(str_replace(' ', '', $streetname)) === false) 
            {
                $input_errors['streetname'] = 'streetname  is invalid';
            } 
        if(empty($city))
        {
            $input_errors['city'] = "city  Field Is Required!";
        }
        if (ctype_alpha(str_replace(' ', '', $city)) === false) 
            {
                $input_errors['city'] = 'city is invalid';
            } 
        if(empty($state)){
            $input_errors['state'] = "State Field Is Required!";
        }
        if (ctype_alpha(str_replace(' ', '', $state)) === false) 
            {
                $input_errors['state'] = ' state is invalid';
            } 
        if(empty($district))
        {
            $input_errors['district'] = "District  Field Is Required!";
        }
        if (ctype_alpha(str_replace(' ', '', $district)) === false) 
        {
            $input_errors['district'] = 'district is invalid';
        } 
        if(empty($pincode)){
            $input_errors['pincode'] = "pincode Field Is Required!";
        }
        if(empty($password)){
            $input_errors['password'] = "Password Field Is Required!";
        }
        

        if(count($input_errors) == 0)
        {
            // $email_check = mysqli_query($connect, "SELECT * FROM `admin` WHERE `email` = '$email'");
            // $email_check_row = mysqli_num_rows($email_check);

                if(strlen($password) > 5)
                {    
                    $result = mysqli_query($connect, "INSERT INTO `staff`(fullname,stationcode,position,phnumber,email,housename,streetname,city,district,state,pincode,password) VALUES ('$fullname','$stationcode','$position','$phnumber','$email     ','$housename','$streetname','$city','$district','$state','$pincode','$password')");                    
                    if($result)
                    {
                        $success="registered Successfully";
                    }
                }
                    else
                {
                    $password_exits = "Password Need To Be More Than 5 Charaters!";
                }

           

        }
        else{
            $error="Something went Wrong";
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
                        <h1 class="fs-4 card-title fw-bold mb-4 text-center">Register Staff</h1>
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
                                <label class="mb-2 text-muted" for="fullname">Full Name</label>
                                <input id="fullname" type="text" class="form-control" name="fullname" value=""
                                    placeholder="Please Enter Full Name" required autofocus>
                                <?php 
                                        if(isset($input_errors['fullname'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['fullname'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="stationcode">Station code</label>
                                <select class="form-control" id="stationcode" name="stationcode">
                                    <option value="">select</option>
                                    <?php

                                            $result = mysqli_query($connect,"SELECT * FROM `station`");
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                    ?>
                                    <option value="<?= $row['stationcode'] ?>"><?= $row['stationcode'] ?></option>            
                                    <?php
                                        }
                                    ?>
                                </select>
                                <?php 
                                        if(isset($input_errors['stationcode']))
                                        {
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['stationcode'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="position">Position<label>
                                <select class="form-control" id="position" name="position">
                                    <option value="">select</option>
                                    <option value="office">Office</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                                <?php
                                    if(isset($input_errors['position']))
                                    {
                                        echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['position'].'</span>';
                                    }
                                ?>

                            </div>
                            

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value=""
                                    placeholder="Please Enter Email Address" required>
                                <?php 
                                        if(isset($input_errors['email'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['email'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="housename">House name</label>
                                <input id="housename" type="text" class="form-control" name="housename" value=""
                                    placeholder="Please Enter house name" required>
                            
                            <?php 
                                        if(isset($input_errors['housename'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['housename'].'</span>';
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
                                <label class="mb-2 text-muted" for="phnumber">Phone Number</label>
                                <input id="phnumber" type="text" class="form-control" name="phnumber" value="" placeholder="Please Enter phone Number" pattern="[6|7|8|9]{01}[0-9]{09}" required
                                    autofocus>
                                <?php 
                                        if(isset($input_errors['phnumber']))
                                        {
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
                                <button type="submit" name="staff_register" class="btn btn-dark ms-auto">
                                    Register staff
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