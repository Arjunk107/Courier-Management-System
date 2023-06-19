<?php

require 'header.php';
include ( 'connection.php' );




?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color:#FFFFE0">

    <div class="container">
        <div style="margin-top:25px;">
            <form method="POST" novalidate="" autocomplete="off" action="">
                <input type="search" name="searchval" id="searchval" class="form-control rounded" placeholder="Search"
                    aria-label="Search" aria-describedby="search-addon" />
                <button style="margin-right:auto;margin-left:auto;" type="submit" name="submit"
                    class="btn btn-outline-success "><i class="fa fa-search"></i>search</button>
        </div>
        </form>
        <div style="margin-top:25px;" class="card">
            <div class="card-header">
                Track Your Product

            </div>


            <?php
    if(isset($_POST['submit']))
{
    
    $searchval=$_POST['searchval'];
    
?>
            <div class="card-body">
                <h5 class="card-title">Booking ID :<?= $searchval ?></h5>

                <div style="margin-top:5px;" class="progress">
                    <?php
    
        $bresult = mysqli_query($connect,"SELECT count(booking_id) as bkkid FROM `courier` where booking_id=$searchval"); 
        $broow = mysqli_fetch_assoc($bresult);
        $bkkid = $broow['bkkid'];
        if($bkkid !=0 )
        {
            $result = mysqli_query($connect,"SELECT * FROM `courier` where booking_id=$searchval"); 
            $firstAmount =0;
            ?>

                    <?php
            while($row = mysqli_fetch_assoc($result))
            {
                 $tracking = mysqli_query($connect,"SELECT * FROM `tracking` where Booking_id=$searchval");
                 while($row = mysqli_fetch_assoc($tracking))
                 {
                    $firstAmount=1;
                    echo"<script>console.log('$searchval------fgfdnhbv')</script>";

                    if($row['S_status']=='Delivered')
                    {
                        if($row['R_status']=='received')
                        {
                            $delveryStatus =  mysqli_query($connect,"SELECT * FROM `delivery` where booking_id=$searchval");
                            $kk=1;
                            while($row = mysqli_fetch_assoc($delveryStatus))
                            {
                                $kk=2;
                   
                                if($row['dstatus']=='delivered')
                                {
                                    echo"<script>console.log('$searchval---hhe')</script>";

                                    ?>

                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    <?php
                                }
                                else{
                                    echo"<script>console.log('$searchval')</script>";

                                    ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                    <?php
                                }
                                
                            }
                            if($kk==1)
                            {
                                echo"<script>console.log('$searchval')</script>";

                                ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                    <?php
                            }

                        }
                        else{
                            echo"<script>console.log('$searchval')</script>";

                            ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>
                    <?php
                        }
                    }
                    else{
                        echo"<script>console.log('$searchval')</script>";

                        ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:5%;"></div>

                    <?php
                        
                    }
                 } 
                
                
            }
            if($firstAmount==0)
            {
                ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:5%;"></div>

                    <?php   

            }
        }
        else
        {
            echo"<script>alert('Invalid Booking Id')</script>";
        }
    }
        
        
   

 
    
    ?>

                </div>
                <div style="margin-top:15px;width:100%;" class="row">
                    <div  class="col">
                        <p>Received</p>
                    </div>
                    <div  class="col">
                        <p style="margin-left:100px">Shipped</p>
                    </div>
                    <div class="col">
                        <p style="float:right">reached</p>
                    </div>
                    <div class="col">
                        <p style="float:right">Delivered</p>
                    </div>
                </div>
                <p>Date:</p>
                <div style="margin-top:15px;">
                    <?php
                 $searchval=null;
                 $tdrow=null;
                    if(isset($_POST['submit']))
                    {
                       
                    $searchval=$_POST['searchval'];
                    }
                    
                    
                $daterslt=mysqli_query($connect,"SELECT * FROM `courier` WHERE booking_id='$searchval'");
                $drow=mysqli_fetch_assoc($daterslt);
                if($searchval != null)
                {

                
                ?>
                    <div style="width:100%" class="row">
                        <div class="col">
                            <p><?= $drow['date'] ?></p>
                        </div>
                        <?php
                }
                $sdaterslt=mysqli_query($connect,"SELECT * FROM `tracking` WHERE booking_id='$searchval'");
                while($sdrow=mysqli_fetch_assoc($sdaterslt))
                {
                $sdate=$sdrow['S_date'];
                $rdate= $sdrow['R_date']; 
                
                ?>
                        <div class="col">
                            <p style="margin-left:100px"><?=  $sdate ?></p>
                        </div>
                        <div class="col">
                            <p style="float:right"><?= $rdate ?></p>
                        </div>
                        <?php
                }
                $tdaterslt=mysqli_query($connect,"SELECT * FROM `delivery` WHERE booking_id='$searchval'");
                $tdrow=mysqli_fetch_assoc($tdaterslt);
                if($tdrow != null)
                {

                $d_date=$tdrow['date'];
                ?>
                        <div class="col">
                            <p style="float:right" ><?= $d_date ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?><p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            More details
                        </a>
                    </p>
                <div class="collapse" id="collapseExample">
                    <?php
                    $mdetails=mysqli_query($connect,"SELECT * FROM `courier` WHERE booking_id='$searchval'");
                    while($mdrow=mysqli_fetch_assoc($mdetails))
                    {

                    ?>
                    <div class="card card-body">

                        <div class="row">
                            <div class="col-sm">
                                <h2>Sender details</h2>
                                <p> sender name:<?= $mdrow['sender_name'] ?> <br> sender
                                    contact:<?= $mdrow['sender_contact']?> <br>sender
                                    email:<?= $mdrow['sender_email'] ?><br> sender address:<br>
                                    <?= $mdrow['sender_housename'] ?>,<br> <?= $mdrow['sender_streetname']  ?>,<br>
                                    <?= $mdrow['sender_city'] ?>,<br> <?= $mdrow['sender_district']  ?>,<br>
                                    <?= $mdrow['sender_state']  ?>,<br>Pincode : <?= $mdrow['sender_pincode']  ?></p>
                            </div>
                            <div class="col-sm">
                                <h2>Receiver details</h2>
                                <p> Receiver name:<?= $mdrow['receiver_name'] ?> <br> Receiver
                                    contact:<?= $mdrow['receiver_contact']?> <br>Receiver Secondary
                                    contact:<?= $mdrow['receiver_scontact'] ?><br> Receiver address:<br>
                                    <?= $mdrow['receiver_housename'] ?>,<br> <?= $mdrow['receiver_streetname']  ?>,<br>
                                    <?= $mdrow['receiver_city'] ?>,<br> <?= $mdrow['receiver_district']  ?>,<br>
                                    <?= $mdrow['receiver_state']  ?>,<br>Pincode : <?= $mdrow['receiver_pincode']  ?>
                                </p>

                            </div>
                            <div class="col-sm">
                            </div>
                        </div>

                    </div>
                    <?php
                    }
                    ?>
                </div>
                </div>
                
                

            </div>

        </div>



    </div>
</body>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</html>