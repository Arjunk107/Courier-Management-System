<?php

require_once '../connection.php';
session_start();

if(!isset($_SESSION['staff_login'])){
    header('location: login.php');
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management System</title>
    <!-- css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
        <img src="../images/logoo.png" style="width:210px;height:70px" alt="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php 
          if(isset($_SESSION['staff_login'])){
            ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="staff-profile.php">staff Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                    </li>
                    <?php
          } else {
            ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register-staff.php">Register</a>
                    </li>
                    <?php
          }
        ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="nav">
                    <a id="admin-nav" style="color:white;" class="nav-link" href="add-user.php">Add user</a>
                        <?php 

                        $email=$_SESSION['staff_login'];

                        $result=mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
                        while($row=mysqli_fetch_assoc($result))
                        {

                            $posti = $row['position'];
                            $stcode = $row['stationcode'];
                            if($posti == 'office')
                            {
                                if(isset($_SESSION['staff_login'])){
                                    ?>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="book-courier.php">Book Courier</a>
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" style="color:white;" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                View Courier
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" type="button" href="view-courier.php">View Courier</a>
                                <a class="dropdown-item" type="button" href="view-user-courier.php">View user
                                    Courier</a>
                            </div>
                        </div>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="accept-user-courier.php">
                            User Courier Request
                            <?php
$fresult=mysqli_query($connect,"SELECT * FROM `user` INNER JOIN `staff` ON user.stationcode=staff.stationcode");
while($frow=mysqli_fetch_assoc($fresult))
{
    $uid=$frow['userid'];

    $sresult=mysqli_query($connect,"SELECT * FROM `usercourier` WHERE user_id='$uid'");
    while($srow=mysqli_fetch_assoc($sresult))
    {
        $sttatus=$srow['status'];
        if($sttatus=='pending')
        {
            ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
            <?php
        }
    } 
}

?>
                        </a>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="add-tracking.php">Tracking</a>
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" style="color:white;" type="button" id="navbarDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tracking request </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">


<?php
$email=$_SESSION['staff_login'];
$stcresult=mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
$stcrow=mysqli_fetch_assoc($stcresult);
$stcode=$stcrow['stationcode'];
    $tresult=mysqli_query($connect,"SELECT COUNT(Booking_id) as ccount FROM `tracking` WHERE stationcode='$stcode' AND R_status='pending'");
    $trow=mysqli_fetch_assoc($tresult);
   $count=$trow['ccount'];
?>

                                <a class="dropdown-item bg-dark" style="color:white;" href="tracking-request.php">
                                    <p style="color:white;font-weight: normal;">Pending<span
                                            class="badge bg-light text-dark "><?php echo $count; ?></span></p>
                                </a>
                                <a class="dropdown-item bg-dark" style="color:white;"
                                    href="tracking-request-received.php">
                                    <p style="color:white;font-weight: normal;">Received</p>
                                </a>

                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" style="color:white;" type="button" id="navbarDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Complaints </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                      
                                <a class="dropdown-item bg-dark" style="color:white;" href="view-complaint.php"> <p style="color:white;font-weight: normal;">View complaints</p> </a>
                                <a class="dropdown-item bg-dark" style="color:white;" href="view-user-complaint.php"><p style="color:white;font-weight: normal;">View User complaints</p> </a>
                            </div>
                        </div>   
                                
                                
                                
                                <?php
                                  } 
                                
                            }
                        
                            else
                            {
                                if(isset($_SESSION['staff_login']))
                                {
                                    ?>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="add-delivery.php">Add Delivery</a>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="delivery.php">Delivery</a>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="delivery-details.php">Delivery Details</a>

<?php

 $email=$_SESSION['staff_login'];
 $date=date('y-m-d');
 $fresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
 $frow= mysqli_fetch_assoc($fresult);
 $stname=$frow['fullname'];
 $ffresult= mysqli_query($connect," SELECT COUNT(*) AS pcount FROM `pickups` INNER JOIN `user` ON pickups.userid=user.userid WHERE pstatus='pending' AND pickups.staffname='$stname' AND date='$date'");
$dtt=mysqli_fetch_assoc($ffresult);


?>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="view-pickup.php">Pickup Details
                        <span class="badge bg-light text-dark "><?php echo $dtt['pcount'] ?></span></a>
                        <a id="admin-nav" style="color:white;" class="nav-link" href="pickup.php">Pickup Today</a>
                        <?php
                                } 
                                        
                            }
                        }
                        ?>


                    </nav>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>