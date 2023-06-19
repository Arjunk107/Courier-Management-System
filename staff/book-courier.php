<?php
    ob_start();
    require 'header-staff.php';
    include('../connection.php');
    
    $email = $_SESSION['staff_login'];
  
    if(isset($_POST['submit']))
    {
        $date=date('y,m,d');
        $R_stationcode=$_POST['R_stationcode'];
        $sender_name=$_POST['sender_name'];
        $sender_email=$_POST['sender_email'];
        $sender_contact=$_POST['sender_contact'];
        $sender_housename=$_POST['sender_housename'];
        $sender_streetname=$_POST['sender_streetname'];
        $sender_city=$_POST['sender_city'];
        $sender_district=$_POST['sender_district'];
        $sender_state=$_POST['sender_state'];
        $sender_pincode=$_POST['sender_pincode'];
        $receiver_name=$_POST['receiver_name'];
        $receiver_contact=$_POST['receiver_contact'];
        $receiver_scontact=$_POST['receiver_scontact'];
        $receiver_housename=$_POST['receiver_housename'];
        $receiver_streetname=$_POST['receiver_streetname'];
        $receiver_city=$_POST['receiver_city'];
        $receiver_district=$_POST['receiver_district'];
        $receiver_state=$_POST['receiver_state'];
        $receiver_pincode=$_POST['receiver_pincode'];
        $declaration=$_POST['declaration'];
        $weight=$_POST['weight'];
        $category=$_POST['category'];
        $mot=$_POST['mot'];
        $status=$_POST['status'];
    
        $input_errors=array();
         
        if(empty($date))
        {
            $input_errors['date'] = " Date field is empty";
        }
        if(empty($stationcode))
        {
            $input_errors['S_stationcode'] = " stationcode field is empty";
        }
        if(empty($sender_name))
        {
            $input_errors['sender_name'] = " Sender name field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_name)) === false) 
        {
            $input_errors['sender_name'] = 'sender name is invalid';
        } 
       
        if(empty($sender_email))
        {
            $input_errors['sender_email'] = "Sender Email is empty"; 
        }
        if(empty($sender_contact))
        {
            $input_errors['sender_contact'] = " Phone Number field is empty";
        }
        else if(strlen($sender_contact)<10)
        {
            $input_errors['sender_contact'] = " Phone Number should have 10 digits";  
        }
        else if( !preg_match("/^[6-9]\d{9}$/",$sender_contact))
        {
            $input_errors['sender_contact'] = " Phone Number is Invalid!!";
        }
        if(empty($sender_housename))
        {
            $input_errors['sender_housename'] = " Sender housename field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_housename)) === false) 
        {
            $input_errors['sender_housename'] = 'sender housename is invalid';
        } 
        if(empty($sender_streetname))
        {
            $input_errors['sender_streetname'] = " Sender streetname field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_streetname)) === false) 
        {
            $input_errors['sender_streetname'] = 'sender streetname is invalid';
        } 
        if(empty($sender_city))
        {
            $input_errors['sender_city'] = " Sender city field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_city)) === false) 
        {
            $input_errors['sender_city'] = 'sender city is invalid';
        }  
        if(empty($sender_district))
        {
            $input_errors['sender_district'] = " Sender district field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_district)) === false) 
        {
            $input_errors['sender_district'] = 'sender district is invalid';
        } 
        if(empty($sender_state))
        {
            $input_errors['sender_state'] = " Sender state field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_district)) === false) 
        {
            $input_errors['sender_district'] = 'sender district is invalid';
        } 
        if(empty($sender_pincode))
        {
            $input_errors['sender_pincode'] = " Sender pincode field is empty";
        }
        if(empty($receiver_name))
        {
            $input_errors['receiver_name'] = " Receiver name field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $sender_district)) === false) 
        {
            $input_errors['sender_district'] = 'sender district is invalid';
        } 
        if(empty($receiver_contact))
        {
            $input_errors['receiver_contact'] = " Phone Number field is empty";
        }
        elseif(strlen($receiver_contact)<10)
        {
            $input_errors['receiver_contact'] = " Phone Number should have 10 digits";  
        }
        elseif(!preg_match("/^[6-9]\d{9}$/",$receiver_contact))
        {
            $input_errors['receiver_contact'] = " Phone Number is Invalid!!!";
        }        
        if(empty($receiver_housename))
        {
            $input_errors['receiver_housename'] = " receiver housename field is empty";
        }
        if (ctype_alpha(str_replace(' ', '', $receiver_housename)) === false) 
        {
            $input_errors['receiver_housename'] = 'receiver housename is invalid';
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
        if(empty($declaration))
        {
            $input_errors['declaration'] = " declaration field is empty";
        }
        
        if(empty($category))
        {
            $input_errors['category'] = " category field is empty";
        }
        if(empty($mot))
        {
            $input_errors['mot'] = " mot field is empty";
        }
        if(empty($status))
        {
            $input_errors['status'] = " status field is empty";
        }
        
        if(count($input_errors) == 1)
        {
            echo 'hi';
            $fresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
            while($row=mysqli_fetch_assoc($fresult))
            {
                $S_stationcode=$row['stationcode'];
                $result=mysqli_query($connect,"INSERT INTO courier (email,S_stationcode,date,sender_name,sender_email,sender_contact,sender_housename, sender_streetname,sender_city,sender_district,sender_state,sender_pincode,receiver_name,receiver_contact,receiver_scontact,receiver_housename,receiver_streetname,receiver_city,receiver_district,receiver_state,receiver_pincode,R_stationcode,declaration,weight,category,mot,status)
                                                             VALUES('$email','$S_stationcode','$date','$sender_name','$sender_email','$sender_contact','$sender_housename','$sender_streetname','$sender_city','$sender_district','$sender_state','$sender_pincode','$receiver_name','$receiver_contact','$receiver_scontact','$receiver_housename','$receiver_streetname','$receiver_city','$receiver_district','$receiver_state','$receiver_pincode','$R_stationcode','$declaration','$weight','$category','$mot','$status')");
            }
            if($result)
            {
                $success = 'Registration Successfully Happend!';
                header('Location:bill.php');
            } 
            else
            {
                $error = 'Something Went Wrong!';
            }
        }
        else
        {
                $errormsg = "Something went wrong";
        }
    }
?>

<html>
<head>
    <link href="../css/formstyle.css" rel="stylesheet">
</head>
<body style="background-color:#FFFFE0">
<div class="container-fluid col-lg-12 px-1 py-5 mx-auto">
    <div class="row  d-flex justify-content-center">
        <div class="col-xl-9 col-lg-8 col-md-12 col-11 text-center">
            <h3 class="text-muted">Book Courier</h3>
            <div style="margin-left:auto;margin-right:auto;" class="card justify-content-center">
                <form method="POST" class="form-card row  gx-3 gy-2 align-items-center needs-validation" action="">
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

                    <?php
                        if(isset($errormsg))
                        {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                        <?= $errormsg ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                        } 

                    ?>
                    

                        


                     <h2>Sender</h2>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_name" >Full name<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_name" name="sender_name" placeholder="Enter the sender name">
                            <?php 
                                if(isset($input_errors['sender_name']))
                                    {
                                        echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_name'].'</span>';
                                    }
                            ?>
                        </div>

                   

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_email">Email<span class="text-danger"> *</span></label> 
                            <input type="email" id="sender_email" name="sender_email" placeholder="Enter Email address of sender"> 
                            <?php
                                if(isset($input_errors['sender_email']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_email'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_contact">Phone number<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_contact" name="sender_contact" placeholder="Enter Phone number of sender"> 
                            <?php
                                if(isset($input_errors['sender_contact']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_contact'].'</span>';
                                }
                              
                            
                            ?>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_housename">House Name<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_housename" name="sender_housename" placeholder="Enter House name of sender"> 
                            <?php
                                if(isset($input_errors['sender_housename']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_housename'].'</span>';
                                }
                            ?>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_streetname">Street Name<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_streetname" name="sender_streetname" placeholder="Enter Street name of sender"> 
                            <?php
                                if(isset($input_errors['sender_streetname']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_streetname'].'</span>';
                                }
                                
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_city">City<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_city" name="sender_city" placeholder="Enter City of sender"> 
                            <?php
                                if(isset($input_errors['sender_city']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_city'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_district">District<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_district" name="sender_district" placeholder="Enter Distict of sender"> 
                            <?php
                                if(isset($input_errors['sender_district']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_district'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_state">State<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_state" name="sender_state" placeholder="Enter state of sender"> 
                            <?php
                                if(isset($input_errors['sender_state']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_state'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_pincode">Pincode<span class="text-danger"> *</span></label> 
                            <input type="number" id="sender_pincode" name="sender_pincode" placeholder="Enter Pincode of sender"> 
                            <?php
                                if(isset($input_errors['sender_pincode']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['sender_pincode'].'</span>';
                                }
                            ?>
                        </div>


                        <h2 class="text-left">receiver</h2>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="receiver_name">Full Name<span class="text-danger"> *</span></label> 
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

                                if(isset($input_errors['receiver_contact']) )
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
                            <label class="form-control-label px-3" for="receiver_housename">House Name<span class="text-danger"> *</span></label> 
                            <input type="text" id="receiver_housename" name="receiver_housename" placeholder="Enter house name of receiver"> 
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
                                        


                        <h2>Package details</h2>
                        
                    
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="declaration">Declaration<span class="text-danger"> *</span></label> 
                            <input type="text" id="declaration" name="declaration" placeholder="Enter declaration"> 
                            <?php
                                if(isset($input_errors['declaration']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['declaration'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="weight">weight per KG</label> 
                            <input type="text" id="weight" name="weight" placeholder="Enter weight"> 
                            <?php
                                if(isset($input_errors['weight']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['weight'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="col-md-4">
                        <label class="form-control-label px-3" for="category">category<span class="text-danger"> *</span></lable>
                        <select class="form-control" id="category" name="category">
                            <option value="normal">normal</option>
                            <option value="pro-premium">Pro-premium</option>
                            
                        </select>
                            <?php
                                if(isset($input_errors['category']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['category'].'</span>';

                                }
                            ?>
                        </div>

                        <div class="form-group col-md-4">
                        <label class="form-control-label px-3 " for="mot">Mode of transportation<span class="text-danger"> *</span></lable>
                        <select class="form-control" id="mot" name="mot">
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
                       
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="R_stationcode" >stationcode</label> 
                                <select id="R_stationcode" name="R_stationcode">
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
                                        if(isset($input_errors['R_stationcode']))
                                        {
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['R_stationcode'].'</span>';
                                        }
                                    ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label px-3" for=" status ">status</label> 
                            <select  id="status" name="status">
                            <option value="Received">Received</option>
                            </select>
                            <?php
                                if(isset($input_errors['status']))
                                {
                                    echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['status'].'</span>';
                                }
                            ?>
                        </div>

                        <div class="text-center mt-5">
                           
                        <?php
                         if(isset($_POST['submit']))
                         {
                        $sedmail=$_POST['sender_email'];
                        
                         }
                           ?>
                        <button type="submit" name="submit" >Submit</button>                                
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>