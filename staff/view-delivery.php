<?php


  require 'header-staff.php';
  include('../connection.php');


$email=$_SESSION['staff_login'];

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
                    <th scope="col">Date</th>
                    <th scope="col">Booking Id</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Sender email</th>
                    <th scope="col">Sender Contact</th>
                    <th scope="col">Sender Address</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Address</th>
                    <th scope="col">Declaration</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Category</th>
                    <th scope="col">Mode of transportation</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $ffresult= mysqli_query($connect," SELECT * FROM `delivery`");
                $no=1;
                while($row = mysqli_fetch_assoc($result))
                  {
                    
                  ?>
                <tr class="active-row">
                    <td><?=$no?></td>
                    <td><?=$row['date']?></td>
                    <td><?=$row['booking_id']?></td>
                    <td><?=$row['sender_name']?></td>
                    <td><?=$row['sender_email']?></td>
                    <td><?=$row['sender_contact']?></td>
                    <td><?=$row['sender_housename'],", </br>",$row['sender_streetname'],", </br>",$row['sender_city'],", </br>",$row['sender_district'],", </br>",$row['sender_state'],", </br>",$row['sender_pincode']?>
                    </td>
                    <td><?=$row['receiver_name']?></td>
                    <td><?=$row['receiver_contact']?></td>
                    <td><?=$row['receiver_scontact']?></td>
                    <td><?=$row['receiver_housename'],", </br>",$row['receiver_streetname'],", </br>",$row['receiver_city'],", </br>",$row['receiver_district'],", </br>",$row['receiver_state'],", </br>",$row['receiver_pincode']?>
                    </td>
                    <td><?=$row['declaration']?></td>
                    <td><?=$row['weight']?></td>
                    <td><?=$row['category']?></td>
                    <td><?=$row['mot']?></td>
                    <td><?="Rs",$row['price'],"/-"?></td>
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
            