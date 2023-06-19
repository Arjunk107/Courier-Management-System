<?php

require 'header-admin.php';
include ('../connection.php');
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</head>
<link href="../css/table.css" rel="stylesheet">

<body style="background-color:#FFFFE0">
    <div class="container">
        <div style="margin-top:25px;border:2px black solid ;padding:20px;border-radius:15px;background-color:white">
            <form method="POST" novalidate="" autocomplete="off" action="">
                <input type="search" name="search" id="search" class="form-control rounded" placeholder="Enter the station code"
                    aria-label="Search" aria-describedby="search-addon" />
                <button style="margin-right:auto;margin-left:auto;MARGIN-TOP:10PX" type="submit" name="submit"
                    class="btn btn-outline-success "><i class="fa fa-search"></i>search</button>

            </form>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">Station code</th>
                    <th scope="col">Station Place</th>
                    <th scope="col">city</th>
                    <th scope="col">State</th>
                    <th scope="col">Phone Number</th>     
                    <th scope="col">secondary Phone Number</th>
                    <th scope="col">Total Non credit Couriers per month</th>
                    <th scope="col">Total credit Couriers per month</th>
                </tr>
            </thead>
            <tbody>
                <?php
        if(isset($_POST['submit']))
        {
            $search=$_POST['search'];

            $ifresult=mysqli_query($connect,"SELECT count(stationcode) as ifcount FROM `station` WHERE stationcode='$search'");
            $ifrow = mysqli_fetch_assoc($ifresult);
            $countt=$ifrow['ifcount'];
            if($countt !=0 )
            {
                $result=mysqli_query($connect,"SELECT * FROM `station` WHERE stationcode='$search'");

            while($row=mysqli_fetch_assoc($result))
            {
                ?>
                <tr class="active-row">
                    <td><?=$row['stationcode']?></td>
                    <td><?=$row['stationplace']?></td>
                    <td><?=$row['city']?></td>
                    <td><?=$row['statep']?></td>
                    <td><?=$row['phnumber']?></td>
                    <td><?=$row['secphnumber']?></td>
                   
                    <?php
                 $totresult = mysqli_query($connect,"SELECT count(booking_id) as count FROM `courier` WHERE S_stationcode='$search'");
                 $totrow = mysqli_fetch_assoc($totresult);
                 $total = $totrow['count'];    

                 $totcresult = mysqli_query($connect,"SELECT count(booking_id) as ccount FROM `usercourier` WHERE S_stationcode='$search'");
                 $totcrow = mysqli_fetch_assoc($totcresult);
                 $ctotal = $totcrow['ccount']; 
            }
        }
        ?>
                    <td><?=$total?></td>
                    <td><?=$ctotal?></td>

            </tbody>
        </table>

        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                <?php

        if(isset($_POST['submit']))
        {
            $search=$_POST['search'];
            $no=1;
            $result=mysqli_query($connect,"SELECT * FROM `staff` INNER JOIN `station` ON staff.stationcode=station.stationcode WHERE staff.stationcode='$search'");
            while($row=mysqli_fetch_assoc($result))
            {
                ?>
                <tr class="active-row">
                    <td><?=$no?></td>
                    <td><?=$row['fullname']?></td>
                    <td><?=$row['position']?></td>
                    <td><?=$row['phonenumber']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['housename'],", </br>",$row['streetname'],", </br>",$row['city'],", </br>",$row['district'],", </br>",$row['state'],", </br>",$row['pincode']?>
                    </td>

                    <?php
                    $no++;
            }
        }

    }
    else
    {
        echo "<script>alert('Invalid Stationcode')</script>";
    }
        ?>
            </tbody>
        </table>
       
    </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</html>