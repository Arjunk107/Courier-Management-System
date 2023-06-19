<?php
require 'header-staff.php';
include ('../connection.php');

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
                    <th scope="col">Booking Id</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Address</th>
                    <th scope="col">Sender stationcode</th>
                    <th scope="col">Category</th>
                    <th scope="col">Mode of transportation</th>
                    <th scope="col">Status</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $result=mysqli_query($connect,"SELECT * FROM `usercourier` WHERE status='received'");
                    $no=1;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tr class="active-row">
                        <td><?=$no?></td>
                        <td><?=$row['date']?></td>
                        <td><?=$row['booking_id']?></td>
                        <td><?=$row['user_id']?></td>
                        <td><?=$row['receiver_name']?></td>
                        <td><?=$row['receiver_contact']?></td>
                        <td><?=$row['receiver_scontact']?></td>
                        <td><?=$row['receiver_companyname'],", </br>",$row['receiver_streetname'],", </br>",$row['receiver_city'],", </br>",$row['receiver_district'],", </br>",$row['receiver_state'],", </br>",$row['receiver_pincode']?>
                        </td>
                        <td><?=$row['S_stationcode']?></td>
                        <td><?=$row['category']?></td>
                        <td><?=$row['mot']?></td>
                        <td><?=$row['status']?></td>
                    </tr>
                    <?php
                    $no++;
                    }
                ?>




            </tbody>
        </table>
    </div>
</body>

</html>            