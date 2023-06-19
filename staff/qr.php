<?php
session_start();
include('../connection.php');
$email=$_SESSION['staff_login'];
$stresult=mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
$strow=mysqli_fetch_assoc($stresult);
$stcode=$strow['stationcode'];
$bkresult=mysqli_query($connect,"SELECT MAX(booking_id) as bkid FROM `usercourier` WHERE S_stationcode='$stcode'");
$bkrow=mysqli_fetch_assoc($bkresult);
$bkid=$bkrow['bkid'];



include ("phpqrcode/qrlib.php");

$PNG_TEMP_DIR = 'temp/';
if(!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

    $filname = $PNG_TEMP_DIR . 'test.png';

    $result=mysqli_query($connect,"SELECT * FROM `usercourier` WHERE booking_id='$bkid'");
    $row=mysqli_fetch_assoc($result);
        $codeString = "Booking id : ".$row['booking_id'] . "\n" ;
        $codeString .= "User Id : ". $row['user_id'] . "\n";
        $codeString .= "name : ". $row['receiver_name'] . "\n";
        $codeString .= "Address :" .$row['receiver_companyname'] . "\n";
        $codeString .= $row['receiver_streetname'] . "\n";
        $codeString .= $row['receiver_city'] . "\n";
        $codeString .= $row['receiver_district'] . "\n";
        $codeString .= $row['receiver_state'] . "\n";
        $codeString .= $row['receiver_pincode'] ."\n";
        $codeString .= "Category : ".$row['category'] ."\n";
        $codeString .= "Mode of transportation : ".$row['mot'] ;


        $filname = $PNG_TEMP_DIR . 'test' .
        md5($codeString) . '.png';

        QRcode::png($codeString,$filname);
        echo '<img style="width:200px;margin-left:500px"  src="'.$PNG_TEMP_DIR.basename($filname) . '"/><hr/>';

?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    </head>
    <body>
    <a href="accept-user-courier.php" class="btn btn-info" style="margin-left:500px"type="button">Print</a>
</body>
</html>

