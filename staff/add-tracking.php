<?php

    require 'header-staff.php';
    include('../connection.php');


    $email = $_SESSION['staff_login'];
    $count=0;
    if(isset($_POST['tracking']))
    {
        $Booking_id=$_POST['Booking_id'];
        
        $stationcode=$_POST['stationcode'];

        $checkbkid=mysqli_query($connect,"SELECT COUNT(*) as count FROM `tracking` WHERE Booking_id = $Booking_id");
        $data=mysqli_fetch_assoc($checkbkid);
        $count=$data['count'];
        echo $count;
        if($count == 0)
        {
            $newresult=mysqli_query($connect,"SELECT * FROM `courier` WHERE booking_id='$Booking_id'");
            while($row=mysqli_fetch_assoc($newresult))
            {
                $S_stationcode=$row['S_stationcode'];
                $S_date=date('y-m-d');
                $result=mysqli_query($connect,"INSERT INTO `tracking` (Booking_id,S_stationcode,S_date,S_status,stationcode,R_status) VALUES ('$Booking_id','$S_stationcode','$S_date','Delivered','$stationcode','pending')");
        
                if($result)
                {
                    $success="Tracking added Successfully";
                }
                else
                {
                    $error = "Booking id do not exist";
                }
            }
        }
        else
        {
            $error = 'Booking id already excist';
        }
        
    }

        
?>


<html>
    <body style="background-color:#FFFFE0">
<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4 text-center">Add Tracking </h1>
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
                                <label class="mb-2 text-muted" for="fullname">Booking Id</label>
                                <input id="Booking_id" type="text" class="form-control" name="Booking_id" value=""
                                    placeholder="Please Enter Booking Id" required autofocus>
                            </div>

                            <div class="mb-3">
                            <label style="margin-right:-2px;" class="form-control-label px-3" for="date" >Date<span class="text-danger"> *</span></label> 
                            <?php
                            $sdate=date('d-m-y');
                            ?>
                            <p> <?php echo $sdate; ?></p>
                            </div>
                           

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="stationcode">Station Code</label>
                                <select class="form-control" id="stationcode" name="stationcode">
                                    <option value="">select</option>
                                    <?php
                                        $result=mysqli_query($connect,"SELECT * FROM station");
                                        while($row = mysqli_fetch_assoc($result))
                                        {

            
                                    ?>
                                    <option value='<?=$row['stationcode']?>'><?= $row['stationcode'] ?></option>  

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        
                            <div class="text-center mt-5">
                                <button type="submit" name="tracking" class="btn btn-dark ms-auto">
                                     submit
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
