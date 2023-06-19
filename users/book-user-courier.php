<?php

    require 'header-user.php';
    include('../connection.php');
    
    $companyemail = $_SESSION['user_login'];

    
    if(isset($_POST['submit']))
    {
        $email = $_SESSION['user_login'];
        $date=date('y-m-d');
        $receiver_name=$_POST['receiver_name'];
        $receiver_contact=$_POST['receiver_contact'];
        $receiver_scontact=$_POST['receiver_scontact'];
        $receiver_companyname=$_POST['receiver_companyname'];
        $receiver_streetname=$_POST['receiver_streetname'];
        $receiver_city=$_POST['receiver_city'];
        $receiver_district=$_POST['receiver_district'];
        $receiver_state=$_POST['receiver_state'];
        $receiver_pincode=$_POST['receiver_pincode'];
        $category=$_POST['category'];
        $mot=$_POST['mot'];
        $status='pending';

        

        $input_errors=array();


            if(empty($receiver_name))
            {
                $input_errors['receiver_name'] = " receiver name field is empty";
            }
            if (ctype_alpha(str_replace(' ', '', $receiver_name)) === false) 
            {
                $input_errors['receiver_name'] = 'receiver name  is invalid';
            }
            if(empty($receiver_contact))
            {
                $input_errors['receiver_contact'] = " receiver contact field is empty";
            }
            elseif(strlen($receiver_contact)<10)
            {
            $input_errors['receiver_contact'] = " Phone Number should have 10 digits";  
            }
            elseif(!preg_match("/^[6-9]\d{9}$/",$receiver_contact))
            {
            $input_errors['receiver_contact'] = " Phone Number is Invalid!!!";
            }
            if(empty($receiver_companyname))
            {
                $input_errors['receiver_companyname'] = " receiver companyname/housename field is empty";
            }
            if (ctype_alpha(str_replace(' ', '', $receiver_companyname)) === false) 
            {
                $input_errors['receiver_companyname'] = 'receiver companyname  is invalid';
            }
            if(empty($receiver_streetname))
            {
                $input_errors['receiver_streetname'] = " receiver streetname field is empty";
            }
            if (ctype_alpha(str_replace(' ', '', $receiver_streetname)) === false) 
            {
                $input_errors['receiver_streetname'] = 'receiver streetname is invalid';
            }
            if(empty($receiver_city))
            {
                $input_errors['receiver_city'] = " receiver city field is empty";
            }
            if (ctype_alpha(str_replace(' ', '', $receiver_city)) === false) 
            {
                $input_errors['receiver_city'] = 'receiver city is invalid';
            } 
            if(empty($receiver_district))
            {
                $input_errors['receiver_district'] = " receiver district field is empty";
            }
            if (ctype_alpha(str_replace(' ', '', $receiver_district)) === false) 
            {
                $input_errors['receiver_district'] = 'receiver district is invalid';
            }  
            if(empty($receiver_state))
            {
                $input_errors['receiver_state'] = " receiver state field is empty";
            }
            if (ctype_alpha(str_replace(' ', '', $receiver_state)) === false) 
            {
                $input_errors['receiver_state'] = 'receiver state is invalid';
            } 
            if(empty($receiver_pincode))
            {
                $input_errors['receiver_pincode'] = " receiver pincodefield is empty";
            }
            if(strlen($receiver_pincode) != 6)
            {
                $input_errors['receiver_pincode'] = " receiver pincode is invalid";
            }
            if(empty($category))
            {
                $input_errors['category'] = " category field is empty";
            }
            if(empty($mot))
            {
                $input_errors['mot'] = " mot field is empty";
            }
             

            $fresult = mysqli_query($connect,"SELECT * FROM `user` WHERE companyemail = '$companyemail'");

            while($row = mysqli_fetch_assoc($fresult))
            {
                $userid = $row['userid'];
                $S_stationcode = $row['stationcode'];
                $ustate = $row['state'];

                $priceresult= mysqli_query($connect,"SELECT * FROM `price` WHERE from_add='$ustate' AND to_add='$receiver_state' AND category='$category' AND mot='$mot'");
                $prirow=mysqli_fetch_assoc($priceresult);
                $pr=$prirow['price'];
            }    
                if(count($input_errors) == 0)
                {

                    
                        $result=mysqli_query($connect,"INSERT INTO usercourier (user_id,date,receiver_name,receiver_contact,receiver_scontact,receiver_companyname,receiver_streetname,receiver_city,receiver_district,receiver_state,receiver_pincode,S_stationcode,category,mot,price,status)
                                                                    VALUES('$userid','$date','$receiver_name','$receiver_contact','$receiver_scontact','$receiver_companyname','$receiver_streetname','$receiver_city','$receiver_district','$receiver_state','$receiver_pincode','$S_stationcode','$category','$mot','$pr','$status')");
                        

                    if($result)
                    {
                        $success = 'Booking Successfull';
                    } 
                    else
                    {
                        $error = 'Something Went Wrong!';
                    }
                }
                else
                {
                     $error = "Something went wrong";
                }
            
        
            
        }

?>

<html>
<head>
    <link href="../css/formstyle.css" rel="stylesheet">
<body style="background-color:#FFFFE0">
<div class="container-fluid col-lg-12 px-1 py-5 mx-auto">
    <div class="row  d-flex justify-content-center">
        <div class="col-xl-9 col-lg-8 col-md-12 col-11 text-center">
            <h3 class="text-muted">Book Courier</h3>
            <div style="margin-left:auto;margin-right:auto;" class="card justify-content-center">
                <form method="POST" class="form-card row  gx-3 gy-2 align-items-center needs-validation" >
                    <?php 
                        if(isset($success))
                        {
                    ?>
                    
                    <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                        <?= $success ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                    

                        <div class="col-md-4">
                            <label style="margin-right:-2px;" class="form-control-label px-3" for="date" >Date<span class="text-danger"> *</span></label> 
                            <?php
                            $sdate=date('d-m-y');
                            ?>
                            <p> <?php echo $sdate; ?></p>
                    </div>
                        
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_name">Name<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_name" name="receiver_name" placeholder="Enter name of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_name']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_name'].'</span>';
                                }
                            ?>
                        </div>
                       

                        

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_contact">Phone number<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_contact" name="receiver_contact" placeholder="Enter phone number of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_contact']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_contact'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_scontact">Alternative Number</label> 
                            <input type="text" id="receiver_scontact" name="receiver_scontact" placeholder="Enter alternative number of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_scontact']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_scontact'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_companyname">Company Name/house name<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_companyname" name="receiver_companyname" placeholder="Enter company name of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_housename']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_housename'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_streetname">Street Name<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_streetname" name="receiver_streetname" placeholder="Enter street name of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_streetname']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_streetname'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_city">City<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_city" name="receiver_city" placeholder="Enter city of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_city']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_city'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_district">District<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_district" name="receiver_district" placeholder="Enter district of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_district']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_district'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_state">State<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_state" name="receiver_state" placeholder="Enter state of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_state']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_state'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_pincode">Pincode<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_pincode" name="receiver_pincode" placeholder="Enter pincode of receiver"> 
                            <?php
                                if(isset($input_errors['receiver_pincode']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_pincode'].'</span>';
                                }
                            ?>
                        </div>
                                        

                    

                        <div class="col-md-4">
                        <label class="form-control-label px-3" for="category">category<span class="text-danger"> *</span></lable>
                        <select id="category" name="category">
                            <option value="normal">normal</option>
                            <option value="propremium">Pro-premium</option>
                            
                        </select>
                            <?php
                                if(isset($input_errors['category']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['category'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                        <label class="form-control-label px-3" for="mot">Mode of transportation<span class="text-danger"> *</span></lable>
                        <select id="mot" name="mot">
                            <option value="ground">ground</option>
                            <option value="air">Air</option>
                            
                        </select>
                            <?php
                                if(isset($input_errors['mot']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['mot'].'</span>';
                                }
                            ?>
                        </div>

                       

                        <div class="text-center mt-5">
                        <button type="submit" name="submit">Submit</button>                                
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>
