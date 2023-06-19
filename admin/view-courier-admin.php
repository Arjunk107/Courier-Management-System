<?php


  require 'header-admin.php';
  include('../connection.php');




?>
<html>
  <head>
    <link href="../css/table.css" rel="stylesheet">
  </head>
  <body style="background-color:#FFFFE0">
  <form method="POST" novalidate="" autocomplete="off" action="">
                <input style="width:240px" type="date" name="date" id="search" class="form-control rounded" 
                    aria-label="Search" aria-describedby="search-addon" />
                <button style="margin-right:auto;margin-left:auto;MARGIN-TOP:10PX" type="submit" name="submit"
                    class="btn btn-outline-success "><i class="fa fa-search"></i>search</button>

            </form>
    <div class="table-style">  
    <table class="styled-table">
      <thead>
        <tr>
            <th scope="col">date</th>
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
                  if(isset($_POST['submit']))
                  {
                    $date=$_POST['date'];
                 
                  $result = mysqli_query($connect, "SELECT * FROM `courier` WHERE date='$date'");

                  while($row = mysqli_fetch_assoc($result)){

                  ?> 
          <tr class="active-row">
              <td><?=$row['date']?></td>
              <td><?=$row['sender_name']?></td>
              <td><?=$row['sender_email']?></td>
              <td><?=$row['sender_contact']?></td>
              <td><?=$row['sender_housename'],", </br>",$row['sender_streetname'],", </br>",$row['sender_city'],", </br>",$row['sender_district'],", </br>",$row['sender_state'],", </br>",$row['sender_pincode']?></td>
              <td><?=$row['receiver_name']?></td>
              <td><?=$row['receiver_contact']?></td>
              <td><?=$row['receiver_scontact']?></td>
              <td><?=$row['receiver_housename'],", </br>",$row['receiver_streetname'],", </br>",$row['receiver_city'],", </br>",$row['receiver_district'],", </br>",$row['receiver_state'],", </br>",$row['receiver_pincode']?></td>
              <td><?=$row['declaration']?></td>
              <td><?=$row['weight']?></td>
              <td><?=$row['category']?></td>
              <td><?=$row['mot']?></td>
              <td><?=$row['status']?></td>


              
          </tr>

          <?php 
                      
                  }  }?> 

          
      </tbody>          
    </table>
    </div>
  </body>
</html>
