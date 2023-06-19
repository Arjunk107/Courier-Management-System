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
<div class="container" style="margin-top:15px;padding:15px;border:3px black solid;border-radius:5px;">
<form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
<input type="date" name="searchval" id="searchval" class="form-control rounded" placeholder="Search"
                    aria-label="Search" aria-describedby="search-addon" style="width:240px" />
                <button style="margin-right:auto;margin-left:auto;margin-top:7px;" type="submit" name="submit" class="btn btn-outline-success "><i
                        class="fa fa-search"></i>search</button>
 </div>                       
</form>
    <div class="table-style">
        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">date</th>
                    <th scope="col">Booking Id</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Sender email</th>
                    <th scope="col">Sender Contact</th>
                    <th scope="col">Sender Address</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Alternative Contact</th>
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
                if(isset($_POST['submit']))
                {
                    $date=$_POST['searchval'];

                  $ffresult= mysqli_query($connect," SELECT * FROM `staff` WHERE email='$email'");
                  while($frow=mysqli_fetch_assoc($ffresult))
                  {
                    $stcode = $frow['stationcode'];   

                    
                  
                  $result = mysqli_query($connect,"SELECT * FROM `courier`  WHERE S_stationcode ='$stcode' AND date='$date'");
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
                    <td>Rs 20/-</td>
                    <td><?=$row['status']?></td>



                </tr>

                <?php 
                $no++;
                  }    
                  } 
                }
                else
                {
                    $date=date('y-m-d');

                    $ffresult= mysqli_query($connect," SELECT * FROM `staff` WHERE email='$email'");
                    while($frow=mysqli_fetch_assoc($ffresult))
                    {
                      $stcode = $frow['stationcode'];
                    
                    $result = mysqli_query($connect,"SELECT * FROM `courier`  WHERE R_stationcode ='$stcode' AND date='$date'");
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                      $s_state=$row['sender_state'];
                      $r_state=$row['receiver_state'];
                      $cat=$row['category'];
                      $mot=$row['mot'];
                      $pricersl = mysqli_query($connect,"SELECT price as prtt FROM `price` WHERE from_add='$s_state' AND to_add='$r_state' AND category='$cat' AND mot='$mot'");
                      $prresult=mysqli_fetch_assoc($pricersl);

                    ?>
                  <tr class="active-row">
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
                      <td><?="Rs",$prresult['prtt'],"/-"?></td>
                      <td><?=$row['status']?></td>
                      
  
  
  
                  </tr>
  
                  <?php 
                    }    
                    } 
                }  
                  ?>


            </tbody>
        </table>
    </div>
</body>

</html>