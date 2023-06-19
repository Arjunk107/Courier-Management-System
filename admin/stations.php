<?php

     require 'header-admin.php';
     include('../connection.php');

     if(isset($_POST['add_station']))
     {
        $stationcode=$_POST['stationcode'];
        $stationplace=$_POST['stationplace'];
        $city=$_POST['city'];
        $statep=$_POST['statep'];
        $phnumber=$_POST['phnumber'];
        $secphnumber=$_POST['secphnumber'];

        $input_errors = array();

        if(empty($stationcode))
        {
            $input_errors['stationcode'] = "station code feild is required!";
        }
        if(empty($stationplace))
        {
            $input_errors['stationplace'] = "station place field is required!";
        }
        if (ctype_alpha(str_replace(' ', '', $stationplace)) === false) 
        {
            $input_errors['stationplace'] = 'stationplace is invalid';
        } 
        if(empty($city))
        {
            $input_errors['city'] = "city field is requied!";
        }
        if (ctype_alpha(str_replace(' ', '', $city)) === false) 
        {
            $input_errors['city'] = 'city is invalid';
        } 
        if(empty($statep))
        {
            $input_errors['statep'] = "state field is required!";
        }
        if (ctype_alpha(str_replace(' ', '', $statep)) === false) 
        {
            $input_errors['statep'] = 'state is invalid';
        } 
        if(empty($phnumber))
        {
            $input_errors['phnumber'] = "phone number field is required!";
        }
        elseif(strlen($phnumber)<10)
        {
            $input_errors['phnumber'] = "phone Number should have 10 digits!";   
        }
        elseif(!preg_match("/^[6-9]\d$/",$phnumber))
        {
            $input_errors['phnumber'] = "phone Number is Invalid!";   
        }
        if(strlen($secphnumber)<10)
        {
            $input_errors['secphnumber'] = "phone Number should have 10 digits!";   
        }
        elseif(!preg_match("/^[6-9]\d$/",$secphnumber))
        {
            $input_errors['secphnumber'] = "phone Number is Invalid!";   
        }

        if(count($input_errors) == 0)
        {

            $result = mysqli_query($connect,"INSERT INTO station (stationcode,stationplace,city,statep,phnumber,secphnumber) VALUES ('$stationcode','$stationplace','$city','$statep', '$phnumber','$secphnumber') ");  
            if($result)
            {
                $success = 'Registration Successfully Happend!';
            } 
            else
            {
                $error = 'Something Went Wrong!';
            }
        }
        else
        {
            $errormsg = "something went wrong";
        }

     }
?>
<html>
<head>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#FFFFE0">
<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4 text-center">Register Stations</h1>
                        <form method="POST" class="stationreg" novalidate="" autocomplete="off" action="">

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
                                if(isset($errormsg)){
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $errormsg ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="stationcode">Station code</label>
                                <input id="stationcode" type="text" class="form-control" name="stationcode" value=""
                                    placeholder="Please Enter Station Code" required autofocus>
                                <?php 
                                    if(isset($input_errors['stationcode']))
                                    {
                                        echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['stationcode'].'</span>';
                                    }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="stationplace">Station PLace</label>
                                <input id="stationplace" type="text" class="form-control" name="stationplace" value="" placeholder="Enter the staion place" requied autodfocus>
                                
                                <?php
                                    if(isset($input_errors['stationplace']))
                                    {
                                        echo '<span style="display: block;color:red; margin-top: 10px;">'.$input_errors['stationplace'].'</span>';
                                    }
                                ?>
                            </div>    

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="city">City</label>
                                <input id="city" type="text" class="form-control" name="city" values="" placeholder="Enter the city" required autofocus>

                                <?php
                                    if(isset($input_errors['city']))
                                    {
                                        echo'<span style="display:block; color:red ; margin-top:10px;">'.$input_errors['city'].'</span>';
                                    }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="statep">State</label>
                                <input id="statep" type="text" class="form-control" name="statep" placeholder="Enter the state" required autofocus>

                                <?php
                                    if(isset($input_errors['statep']))
                                    { 
                                        echo '<span style="display:block; color:red; margin-top:10px;">'.$input_errors['statep'].'</span>';

                                    }
                                ?>
                            </div>
                                
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="phnumber">phone number</label>
                                <input id="phnumber" type="text" class="form-control" name="phnumber" placeholder="Enter the phone nunmber" required autofocus>

                                <?php
                                    if(isset($input_errors['phnumber']))
                                    {
                                        echo '<span style="display:block; color:red; margin-top:10px;">'.$input_errors['phnumber'].'</span>';

                                    }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="secphnumber">secondary phone number</label>
                                <input id="secphnumber" type="text" class="form-control" name="secphnumber" placeholder="Enter the secondary phone nunmber" required autofocus>

                                <?php
                                    if(isset($input_errors['secphnumber']))
                                    {
                                        
                                        echo '<span style="display:block; color:red; margin-top:10px;">'.$input_errors['secphnumber'].'</span>';

                                    }
                                ?>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" name="add_station" class="btn btn-dark ms-auto">
                                    Add station
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>
                <div class="text-center mt-5 mb-3 text-muted">
                    Copyright &copy; Professional Couriers
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>