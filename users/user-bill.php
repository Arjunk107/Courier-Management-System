<?php
require 'header-user.php';
include('../connection.php');
?>
<html>

<head>
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
        
        <div class="row" style="padding:10px;border:2px solid black;border-radius:5px">
        <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
            <div class="form-group">
                <label for="booking_id">Booking Id</label>
                <input style="margin-top:10px" type="text" class="form-control" id="booking_id" name="booking_id"
                    placeholder="Enter Booking id">
            </div>

            <button style="margin-top:10px"  type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <?php
            if(isset($_POST['submit']))
            {
                $booking_id=$_POST['booking_id'];
              
                $result=mysqli_query($connect,"SELECT * FROM `usercourier` WHERE booking_id='$booking_id'");
                if(!empty($result))
                {

               
                while($row=mysqli_fetch_assoc($result))
                {

               
            
        ?>
    <div class="main"  style="padding:10px;border:2px solid black;border-radius:5px;margin-top:10px">
    <h1>The Professional Courier</h1>

        <div class="row"  style="">
              <h3>Booking Id : <?= $row['booking_id'] ?></h3>
      
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">To</h5>
                        <p class="card-text">Name : <?=  $row['receiver_name']?> <br> Phone Number :
                            <?=  $row['receiver_contact'];  ?><br>Alternative Phone Number :
                            <?=  $row['receiver_scontact']; ?></p>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">To address</h5>
                        <p class="card-text"><?=  $row['receiver_companyname']?>
                            <br><?=  $row['receiver_streetname'];  ?><br> <?=  $row['receiver_city']; ?>
                            <br><?= $row['receiver_district']; ?> <br><?= $row['receiver_state']; ?> <br> Pincode :
                            <?= $row['receiver_pincode']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row"
            style="margin-top:20px;margin-bottom:20px;">
            <div class="col-sm">
                <p class="font-weight-bold">Category :<?=$row['category'] ?></p>
            </div>
            <div class="col-sm">
                <p class="font-weight-bold">Mode Of Transportation :<?=$row['mot'] ?></p>
            </div>
            <?php
                 
                 $email=$_SESSION['user_login'];
                $fresult=mysqli_query($connect,"SELECT * FROM `user` WHERE companyemail='$email'");
                $frow=mysqli_fetch_assoc($fresult);
                $id=$frow['userid'];
                $ustate=$frow['state'];
                $rstate=$row['receiver_state'];
                $category=$row['category'];
                $mot=$row['mot'];
                $priceresult= mysqli_query($connect,"SELECT * FROM `price` WHERE from_add='$ustate' AND to_add='$rstate' AND category='$category' AND mot='$mot'");
                $prirow=mysqli_fetch_assoc($priceresult);
                $pr=$prirow['price'];
                $pricresultadd=mysqli_query($connect,"UPDATE `usercourier` SET price='$pr' WHERE user_id='$id'");

            ?>
            <div class="col-sm">
                <p class="font-weight-bold" style="color:black">Price : Rs<?= $pr ?> /-</p>
            </div>
        </div>
        </div>
        <a href="user-bill.php" type="button" style="margin-top:10px;margin-left:500px" class="btn btn-success">Print</a>
    </div>
        <?php
            }
              }
              else{
                echo "<script>alert('Booking id invalid')</script>";
              }
            }
        ?>
        

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</html>