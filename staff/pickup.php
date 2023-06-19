<?php
    require 'header-staff.php';
    include('../connection.php');


?>
<html>
    <head>
    <link href="../css/table.css" rel="stylesheet">
    </head>
    <body style="background-color:#FFFFE0"> 
    <div class="table-style">
        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">date</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Address</th>
                    <th scope="col">Number of pickups</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $email=$_SESSION['staff_login'];
                $fresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
                $date=date('y-m-d');
                echo $date;
                $no=1;
                while($frow= mysqli_fetch_assoc($fresult))
                {
                    $stname=$frow['fullname'];
              
                $ffresult= mysqli_query($connect," SELECT * FROM `pickups` INNER JOIN `user` ON pickups.userid=user.userid WHERE pstatus='received' AND pickups.staffname='$stname' AND date='$date'");
                while($row = mysqli_fetch_assoc($ffresult))

                {
                    
                  ?>
                <tr class="active-row">
                <td><?=$no?></td>
                    <td><?=$row['date']?></td>
                    <td><?=$row['sname']?></td>
                    <td><?=$row['phnumber']?></td>
                    <td><?=$row['companyname'],", </br>",$row['streetname'],", </br>",$row['city'],", </br>",$row['district'],", </br>",$row['state'],", </br>",$row['pincode']?>
                    </td>
                    <td><?=$row['no_pickups']?></td>
                    <td><?=$row['pstatus']?></td>
                </tr>

                <?php 
                $no++;
                  } 
                     } 
                   ?>


            </tbody>
        </table>
    </div>
   
</body>

</html>

