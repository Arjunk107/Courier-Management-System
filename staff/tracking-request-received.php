<?php
    require 'header-staff.php';
    include('../connection.php');
$email=$_SESSION['staff_login'];
?>



<html>

<head>
    <link href="../css/table.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#FFFFE0">
    <div class="container">
        <div class="table-style">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tracking id </th>
                        <th scope="col">Booking id </th>
                        <th scope="col">Sender stationcode</th>
                        <th scope="col">Sender date</th>
                        <th scope="col">Sender status</th>
                        <th scope="col">Receiver stationcode</th>
                        <th scope="col">Receiver date</th>
                        <th scope="col">Receiver status</th>
                        <th scope="col">Delivery date</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    $fresult=mysqli_query($connect,"SELECT * FROM `staff` WHERE email ='$email'");
                    $no=1;
                    while($frow = mysqli_fetch_assoc($fresult))
                    {
                        $stcode=$frow['stationcode'];
                        $result = mysqli_query($connect, "SELECT * FROM `tracking` WHERE R_status='received' AND stationcode='$stcode' ORDER BY 'booking_id' ");

                    }

                    while($row = mysqli_fetch_assoc($result))
                    {
                         if($row['R_status'] == 'received')
                        {
                        ?>
                            <tr class="active-row">
                                <td><?=$no?></td>
                                <td><?=$row['tracking_id']?></td>
                                <td><?=$row['Booking_id']?></td>
                                <td><?=$row['S_stationcode']?></td>
                                <td><?=$row['S_date']?></td>
                                <td><?=$row['S_status']?></td>
                                <td><?=$row['stationcode']?></td>
                                <td><?=$row['R_date']?></td>
                                <td><?=$row['R_status']?></td>
                                <td><?=$row['D_date']?></td>
                            </tr>

                        <?php
                        $no++;
                    }
                }
            
                    ?>
                <tbody>