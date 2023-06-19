<?php
session_start();
include('../connection.php');
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="htt'ps://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Philosopher&display=swap"
        rel="stylesheet">
    <style>
    blockquote,
    h1 {
        font-family: 'Berkshire Swash', cursive;
        font-family: 'Philosopher', sans-serif;
    }
    </style>


</head>

<body style="background-color:#FFFFE0">
    <div class="container" style="padding-top:20px">
        <blockquote class="blockquote text-center">
            <p class="mb-0 display-3">Bill </p>
        </blockquote>
        <?php
            $count=0;
$email = $_SESSION['staff_login'];
$resultid=mysqli_query($connect,"SELECT MAX(booking_id) as idd FROM `courier`");
$idd=mysqli_fetch_assoc($resultid);
$id= $idd['idd'];
$result=mysqli_query($connect,"SELECT * FROM `courier` WHERE email='$email' AND booking_id=$id");
while($row=mysqli_fetch_assoc($result))
{
$wei=$row['weight'];
if($wei == 0)
{
    $count=0;
}
elseif($wei == 1 && $wei < 1.5)
{
    $count=100;
}
elseif($wei >= 1.5 && $wei < 2)
{
    $count=150;
}
elseif($wei >= 2 && $wei < 2.5 )
{
    $count=200;
}
elseif($wei >= 2.5 && $wei < 3 )
{
    $count=250;
}
elseif($wei >= 3 && $wei < 3.5 )
{
    $count=300;
}
elseif($wei >= 3.5 && $wei < 4)
{
    $count=350;
}

  ?>
        <h1>Booking Id : <?= $row['booking_id'] ?></h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">From</h5>
                        <p class="card-text">Name : <?=  $row['sender_name']?> <br> Email :
                            <?=  $row['sender_email'];  ?><br> Phone Number : <?=  $row['sender_contact']; ?></p>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">From Address</h5>
                        <p class="card-text"><?=  $row['sender_housename']?> <br><?=  $row['sender_streetname'];  ?><br>
                            <?=  $row['sender_city']; ?> <br><?= $row['sender_district']; ?>
                            <br><?= $row['sender_state']; ?> <br> Pincode : <?= $row['sender_pincode']; ?></p>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">To</h5>
                        <p class="card-text">Name : <?=  $row['receiver_name']?> <br> Phone Number :
                            <?=  $row['receiver_contact'];  ?><br>Alternative Phone Number :
                            <?=  $row['receiver_scontact']; ?></p>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form address</h5>
                        <p class="card-text"><?=  $row['receiver_housename']?>
                            <br><?=  $row['receiver_streetname'];  ?><br> <?=  $row['receiver_city']; ?>
                            <br><?= $row['receiver_district']; ?> <br><?= $row['receiver_state']; ?> <br> Pincode :
                            <?= $row['receiver_pincode']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row"
            style="margin-top:20px;margin-bottom:20px;border:2px black solid;background-color:white;border-radius:5px;padding:20px">
            <div class="col-sm">
                <p class="font-weight-bold">Category :<?=$row['category'] ?></p>
            </div>
            <div class="col-sm">
                <p class="font-weight-bold">Mode Of Transportation :<?=$row['mot'] ?></p>
            </div>
            <div class="col-sm">
                <?php
                
    $sstate=$row['sender_state'];
    $rstate=$row['receiver_state'];
    $category=$row['category'];
    $mot=$row['mot'];
    $pricerslt= mysqli_query($connect,"SELECT * FROM `price` WHERE from_add='$sstate' AND to_add='$rstate' AND category='$category' AND mot='$mot'");
    while($prow=mysqli_fetch_assoc($pricerslt))
    {

    $pr=$prow['price'];
    $price=$pr+$count;
    ?>
                <p class="font-weight-bold" style="color:black">Price : Rs<?= $price ?> /-</p>
                
                <?php
      }
      ?>
            </div>
        </div>  
        <a href="book-courier.php" type="button" class="btn btn-success">Print</a>
    </div>
    <?php
}

include ("phpqrcode/qrlib.php");

$PNG_TEMP_DIR = 'temp/';
if(!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

    $filname = $PNG_TEMP_DIR . 'test.png';

    $qrresult=mysqli_query($connect,"SELECT * FROM `courier` WHERE email='$email' AND booking_id=$id");
    $qrrow=mysqli_fetch_assoc($qrresult);
        $codeString = "Booking id : ".$qrrow['booking_id'] . "\n" ;
        $codeString .= "Sender name : ". $qrrow['sender_name'] . "\n";
        $codeString .= "Sender Address :" .$qrrow['sender_housename'] . "\n";
        $codeString .= $qrrow['sender_streetname'] . "\n";
        $codeString .= $qrrow['sender_city'] . "\n";
        $codeString .= $qrrow['sender_district'] . "\n";
        $codeString .= $qrrow['sender_state'] . "\n";
        $codeString .= $qrrow['sender_pincode'] ."\n";
        $codeString .= "Receiver name : ". $qrrow['receiver_name'] . "\n";
        $codeString .= "Receiver Address :" .$qrrow['receiver_housename'] . "\n";
        $codeString .= $qrrow['receiver_streetname'] . "\n";
        $codeString .= $qrrow['receiver_city'] . "\n";
        $codeString .= $qrrow['receiver_district'] . "\n";
        $codeString .= $qrrow['receiver_state'] . "\n";
        $codeString .= $qrrow['receiver_pincode'] ."\n";
        $codeString .= "Category : ".$qrrow['category'] ."\n";
        $codeString .= "Mode of transportation : ".$qrrow['mot'] ;


        $filname = $PNG_TEMP_DIR . 'test' .
        md5($codeString) . '.png';

        QRcode::png($codeString,$filname);
        echo '<img style="width:200px;margin-left:500px"  src="'.$PNG_TEMP_DIR.basename($filname) . '"/><hr/>';
    
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</html>