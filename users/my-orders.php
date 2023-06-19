<?php
require 'header-user.php';
include ('../connection.php');
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">
</head>

<body style="background-color:#FFFFE0">

 
<div class="table-style">
        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">date</th>
                    <th scope="col">Booking Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Secondary Contact</th>
                    <th scope="col">Receiver Address</th>
                    <th scope="col">Category</th>
                    <th scope="col">Mode of transportation</th>
                    <th scope="col">Status</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
    <?php
    $email=$_SESSION['user_login'];
    $fresult=mysqli_query($connect,"SELECT * FROM `user` WHERE companyemail='$email'");
    $no=1;
    while($frow=mysqli_fetch_assoc($fresult))
    {
        $id=$frow['userid'];
    
    $count=0;
      $result=mysqli_query($connect,"SELECT * FROM `usercourier` where user_id='$id'");
      while($row=mysqli_fetch_assoc($result))
      {
        $count++;
        ?>
            <tr class="active-row">
                    <td><?=$no?></td>
                    <td><?=$row['date']?></td>
                    <td><?=$row['booking_id']?></td>
                    <td><?=$row['user_id']?></td>
                    <td><?=$row['receiver_name']?></td>
                    <td><?=$row['receiver_contact']?></td>
                    <td><?=$row['receiver_scontact']?></td>
                    <td><?=$row['receiver_companyname'],", </br>",$row['receiver_streetname'],", </br>",$row['receiver_city'],", </br>",$row['receiver_district'],", </br>",$row['receiver_state'],", </br>",$row['receiver_pincode']?></td>
                    <td><?=$row['category']?></td>
                    <td><?=$row['mot']?></td>
                    <td><?=$row['status']?></td>

                <?php
                $no++;
                $bkid=$row['booking_id'];
                $priresult=mysqli_query($connect,"SELECT * FROM `usercourier` INNER join `user` on usercourier.user_id=user.userid where user_id='$id' AND booking_id='$bkid'");
                while($prow=mysqli_fetch_assoc($priresult))
                {
                  $ustate=$prow['state']; 
                  $rstate=$prow['receiver_state'];
                  $category=$prow['category'];
                  $mot=$prow['mot'];

                    $priceresult= mysqli_query($connect,"SELECT * FROM `price` WHERE from_add='$ustate' AND to_add='$rstate' AND category='$category' AND mot='$mot'");
while($prirow=mysqli_fetch_assoc($priceresult))
                    {
                                            $pr=$prirow['price'];

                    }
                ?>
                    <td><?=$pr?></td>
                    
            </tr>
    <?php
      }
      }

    $totprices=mysqli_query($connect,"SELECT SUM(price) as totalprice FROM `usercourier` where user_id='$id'");
    $pricesum = mysqli_fetch_assoc($totprices);
    ?>
    <div style="border:2px solid black;margin-top:10px;padding:10px" class="row"> 
    <div class="col">
    <h2>Total price this month:<?php echo "Rs".$pricesum['totalprice']."/-"; ?></h2>
    </div>
<?php
    $totcourier=mysqli_query($connect,"SELECT count(booking_id) as totalcourier FROM `usercourier` where user_id='$id'");
    $couriertot = mysqli_fetch_assoc($totcourier);

?>
    <div class="col">
    <h2>Total Courier this month:<?php echo $couriertot['totalcourier']?></h2>
    </div>
    </div>
<?php
    }
    ?>

    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>