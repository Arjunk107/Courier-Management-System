<?php

require 'header-user.php';
include ( '../connection.php' );




?>

<html>

<head>
    <link href="../css/tracking.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
        <div style="margin-top:25px;">
            <form method="POST" novalidate="" autocomplete="off" action="">
                <div style="width:100%;" class="searching">
                    <input style="width:90%; float:left;" type="search" name="searchval" id="searchval"
                        class="form-control rounded" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />
                    <button style="margin-left:20px" type="submit" name="submit" class="btn btn-outline-success "><i
                            class="fa fa-search"></i>search</button>
                </div>
        </div>
        </form>
        <div style="margin-top:25px;" class="card">
            <div class="card-header">
                Track Your Product
            </div>
            <div class="card-body"> 
                <h5 class="card-title">Booking ID : </h5>

                <div style="margin-top:5px;" class="progress">
                    <?php
    if(isset($_POST['submit']))
{
    
    $searchval=$_POST['searchval'];
    
    echo"<script>console.log('$searchval')</script>";
    
        $result = mysqli_query($connect,"SELECT * FROM `usercourier` where booking_id='$searchval'"); 
        if( $result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo"<script>console.log('hel')</script>";
                 $tracking = mysqli_query($connect,"SELECT * FROM `tracking` where Booking_id=$searchval");
                 while($row = mysqli_fetch_assoc($tracking))
                 {
                    if($row['S_status']=='Delivered')
                    {
                        if($row['R_status']=='received')
                        {
                            $delveryStatus =  mysqli_query($connect,"SELECT * FROM `delivery` where booking_id=$searchval");
                            $kk=1;
                            while($row = mysqli_fetch_assoc($delveryStatus))
                            {
                                $kk=2;
                                if($row['status']=='Delivered')
                                {
                                    ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    <?php
                                }
                                else{
                                    ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                    <?php
                                }
                                
                            }
                            if($kk==1)
                            {
                                ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                    <?php
                            }

                        }
                        else{
                            ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>
                    <?php
                        }
                    }
                    else{
                        ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>
                    <?php
                        
                    }
                 } 
                
                
            }
        }
        else
        {
            echo"heelo";
        }
    }
        
        
   

 
    
    ?>

                </div>
                <div style="display: flex; justify-content: space-between;margin-top:15px;">
                    <p style="margin-right: 17rem">Received</p>
                    <p style="margin-right: 18rem">Shipped</p>
                    <p style="margin-right: 4rem">reached</p>
                    <p style="margin-left: 15rem">Delivered</p>
                </div>
            </div>
        <div style="padding:20px;">
                <a style="width:10%;" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    more deatils
                </a>
            </p>
            <?php
             $searchval=$_POST['searchval'];
            $fresult=mysqli_query($connect,"SELECT * FROM `usercourier` WHERE booking_id=$searchval");
            while($row=mysqli_fetch_assoc($fresult))
            {
            ?>
            <div class="collapse" id="collapseExample">
            <div class="card card-body">
                    <p>hiiii</p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        </div>
        <p>
            


    </div>
</body>

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</html>