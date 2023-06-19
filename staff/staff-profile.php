<?php
   
    require 'header-staff.php';
    include ('../connection.php');

    $email = $_SESSION['staff_login'];

    if(isset($_POST['profile-submit']))
    {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phnumber = $_POST['phnumber'];
        $housename = $_POST['housename'];
        $streetname = $_POST['streetname'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];

        $result = mysqli_query($connect,"UPDATE `staff` SET `fullname`='$fullname',`email`='$email',`phnumber`='$phnumber',`housename`='$housename',`streetname`='$streetname',`city`='$city',`state`='$state',`pincode`='$pincode'");
    
            if($result){
                ?>

                <script type="text/javascript">
                alert("Profile Updated Succesfully");
                javascript: history.go(-1);
                </script>
            <?php
            }
            else{
                ?>
                <script type="text/javascript">
                alert("Profile not Updated");
                </script>
            <?php    
            }
    
    }
?>

<html>
<head>
<link href="../css/staff-profile.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background-color:#FFFFE0">
<div class="container">
    <div class="main-body">
    

        <?php

            $result=mysqli_query($connect,"SELECT * FROM `staff` WHERE `email`='$email'");

            while($row = mysqli_fetch_assoc($result)){

            
        ?>
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>
                        <?= $row['fullname'] ?>
                      </h4>
                      <p class="text-secondary mb-1"> <span id="boot-icon" class="bi bi-envelope" style="font-size: 24px; opacity: 0.2; -webkit-text-stroke-width: 0px;"></span><?= $row['stationcode'] ?></p>
                      <p class="text-secondary mb-1"> <span id="boot-icon" class="bi bi-envelope" style="font-size: 24px; opacity: 0.2; -webkit-text-stroke-width: 0px;"></span>Position:<?= $row['position'] ?></p>
                      <p class="text-secondary mb-1"> <span id="boot-icon" class="bi bi-envelope" style="font-size: 24px; opacity: 0.2; -webkit-text-stroke-width: 0px;"></span><?= $row['phonenumber'] ?></p>
                      <p class="text-secondary mb-1"><?= $row['email'] ?></p>
                      <p class="text-muted font-size-sm"><?=$row['housename'],", </br>",$row['streetname'],", </br>",$row['city'],", </br>",$row['district'],", </br>",$row['state'],", </br>",$row['pincode']?></p>

                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
                     <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="fullname" value="<?=$row['fullname']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="email" name="email" value="<?=$row['email']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="phnumber" value="<?=$row['phonenumber']?>">
                    </div>
                  </div>
                  <hr>
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Housename</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="housename" value="<?=$row['housename']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">street name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="streetname" value="<?=$row['streetname']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">City</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="city" value="<?=$row['city']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">District</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="district" value="<?=$row['district']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">State</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="state" value="<?=$row['state']?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Pincode</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="pincode" value="<?=$row['pincode']?>">
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn btn-dark ms-auto " name="profile-submit" type="submit" >
                        Submit
                      </button>
                    </div>
                  </div>
            </form>
                </div>
              </div>
            
              </div>



            </div>
          </div>
        <?php
            }
        ?>
        </div>
    </div>
</body>
</html>

