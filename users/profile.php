<?php 

    require_once 'header-user.php';
    include ('../connection.php');

    $email = $_SESSION['user_login'];

    if(isset($_POST['profile-submit'])){

        $fullname = $_POST['fullname'];
        $contact = $_POST['contact'];
        
        
        $city = $_POST['city'];
        $user_email = $_POST['email'];

        $result = mysqli_query($connect, "UPDATE `user` SET `fullname`='$fullname',`contact`='$contact',`city`='$city',`email`='$user_email' WHERE `email` = '$email'");

        if($result){
            ?>

<script type="text/javascript">
alert('Profile Updated Successfully!');
javascript: history.go(-1);
</script>

<?php
        } else{
            ?>
<script type="text/javascript">
alert('Profile Update Not Successful!');
</script>
<?php
        }

    }

?>


<!-- profile form -->

<html>
<head>
<link href="../css/user-profile.css" rel="stylesheet">
</head>
<body style="background-color:#FFFFE0">
        <section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">

<!-- profile details of user -->

<?php
$result=mysqli_query($connect,"SELECT * FROM `user` WHERE companyemail='$email'");

while($row=mysqli_fetch_assoc($result))
{

    ?>
    <h3 class="dark-color" ><?php echo $row['companyname'];?></h3>
    
    <div class="row about-list">
        <div class="col-md-6">
            <div class="media">
                <label>Street name</label>
                <p><?php echo $row['streetname']; ?></p>
            </div>
            <div class="media">
                <label>City</label>
                <p><?php echo $row['city']; ?></p>
            </div>
            <div class="media">
                <label>District</label>
                <p><?php echo $row['district']; ?></p>
            </div>
            <div class="media">
                <label>Pincode</label>
                <p><?php echo $row['pincode']; ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="media">
                <label>E-mail</label>
                <p><?php echo $row['companyemail']; ?></p>
            </div>
            <div class="media">
                <label>Phone</label>
                <p><?php echo $row['phnumber']; ?></p>
            </div>
        </div>
    </div>
            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                        </div>
                    </div>
                </div>
                <div  style="widht:75%;"class="counter">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">

                                <?php
                                $id = $row['userid'];
                                $totalcount=mysqli_query($connect,"SELECT COUNT(*) as total FROM `usercourier` WHERE user_id='$id'");
                                $data=mysqli_fetch_assoc($totalcount);

                                ?>
                                <h6 class="count h2" data-to="500" data-speed="500">
                                    <?php 
                                        echo $data['total'];

                                     ?>
                                </h6> 
                                <p class="m-0px font-w-600">Total Couriers</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
        <?php
        $id = $row['userid'];
        $totalstacou=mysqli_query($connect,"SELECT COUNT(*) as totalst FROM `usercourier` WHERE user_id='$id' AND status='pending'");
        $datas=mysqli_fetch_assoc($totalstacou);

        ?>                                
                                <h6 class="count h2" data-to="150" data-speed="150">
                                    <?php
                                        echo $datas['totalst'];
                                    ?>
                                </h6>
                                <p class="m-0px font-w-600">Pending couriers</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
<?php
$date = date('m');
$year = '20'.date('y');
$startYear = $year.'-'.$date.'-'.'1';
$endDate = $year.'-'.$date.'-'.'31';
$totalDateCount = mysqli_query($connect,"SELECT COUNT(*) as totalstt FROM `usercourier` WHERE date between '$startYear' and '$endDate' AND user_id='$id'");
$dateCount = mysqli_fetch_assoc($totalDateCount);
?>
                                <h6 class="count h2" data-to="850" data-speed="850">
                                    <?php
                                        echo $dateCount['totalstt'];
                                    ?>
                                </h6>
                                <p class="m-0px font-w-600">In this month</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
<?php
$date = date('m');
$year = '20'.date('y');
$startYear = $year.'-'.$date.'-'.'1';
$endDate = $year.'-'.$date.'-'.'31';
$totalpricesum = mysqli_query($connect,"SELECT SUM(price) as totalprice FROM `usercourier` WHERE date between '$startYear' and '$endDate' AND user_id='$id'");
$pricesum = mysqli_fetch_assoc($totalpricesum);
?>
                                <h6 class="count h2">
                                <?php
                                        echo "Rs".$pricesum['totalprice']."/-";
                                    ?>
                                </h6>
                                <p class="m-0px font-w-600">Total price</p>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
}
?>
                           
                            
                
            </div>
        </section>
</body>
</html>        
