<?php

require 'header-admin.php';
include ('../connection.php');

?>

<html>
    <head>
    <link href="../css/table.css" rel="stylesheet">
    </head>
    <body style="background-color:#FFFFE0">
    <table class="styled-table">
      <thead>
        <tr>
          <?php
          $no=1;
          ?>
            <th scope="col">No</th>
            <th scope="col">User ID</th>
            <th scope="col">Station code</th>
            <th scope="col">Company Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
            <th scope="col">Street Name</th>
            <th scope="col">City</th>
            <th scope="col">District</th>
            <th scope="col">State</th>
            <th scope="col">Pincode</th>
        </tr>
      </thead>
      <tbody>
          <?php 
                  
                  $result = mysqli_query($connect, "SELECT * FROM `user` WHERE status='accepted'");

                  while($row = mysqli_fetch_assoc($result))
                  {

                  ?> 
          <tr class="active-row">
              <td><?=$no?></td>
              <td><?=$row['userid']?></td>
              <td><?=$row['stationcode']?></td>
              <td><?=$row['companyname']?></td>
              <td><?=$row['phnumber']?></td>
              <td><?=$row['companyemail']?></td>
              <td><?=$row['streetname']?></td>
              <td><?=$row['city']?></td>
              <td><?=$row['district']?></td>
              <td><?=$row['state']?></td>
              <td><?=$row['pincode']?></td>

              <?php 
                      $no++;
                    } ?> 
            </tr>
            
        </tbody>          
      </table>
      </div>
    </body>
    

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </html>