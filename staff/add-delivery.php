<?php

    require 'header-staff.php';
    include ('../connection.php');

    $email = $_SESSION['staff_login'];

    if(isset($_POST['delivery']))
    {
        $booking_id=$_POST['booking_id'];
        $date=date('y-m-d');
        $count=0;
        $newresult=mysqli_query($connect,"SELECT * FROM `staff` WHERE email = '$email'");
        while($row =  mysqli_fetch_assoc($newresult))
        {
            $Staff_id=$row['Staff_id'];
            $station_code=$row['stationcode'];
        
            $bookingresult=mysqli_query($connect,"SELECT * FROM courier WHERE booking_id='$booking_id' AND R_stationcode='$station_code'");
            
            while($srow=mysqli_fetch_assoc($bookingresult))
            {
            $booking_idd=$srow['booking_id'];
            $st_code=$srow['R_stationcode'];
            $rname=$srow['receiver_name'];
            if($booking_idd == $booking_id)
            {
                $result=mysqli_query($connect,"INSERT INTO `delivery` (booking_id,Staff_id,stationcode,receiver_name,date,dstatus) VALUES ('$booking_id','$Staff_id','$station_code','$rname','$date','pending')");
            
                if($result)
                {
                    $success='successfully added';
                }
                else
                {
                    $error='Something went Wrong';
                }
            }
            else
            {
                $errormsg="Invalid Booking id";
            }
            }
        }

        
    }

?>

<html>
    <head>

    </head>
<body style="background-color:#FFFFE0">

    <section class="h-100 mt-5">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Add delivery </h1>
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
                                    <label class="mb-2 text-muted" for="booking_id">Booking Id</label>
                                    <input id="booking_id" type="text" class="form-control" name="booking_id" value=""
                                        placeholder="Please Enter Booking Id" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="Date">Date</label>
                                    <?php
                                    $cdate=date('d-m-y');
                                    ?>
                                    <p><?php echo $cdate; ?></p>
                                </div>
                            

                                <div class="text-center mt-5">
                                    <button type="submit" name="delivery" class="btn btn-dark ms-auto">
                                        submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>


</html>