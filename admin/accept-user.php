<?php

require 'header-admin.php';
include ('../connection.php');

if(isset($_POST['accepting']))
{
    $id=$_POST['id'];
    $values=$_POST['status'];
    $result=mysqli_query($connect,"UPDATE `user` SET status='$values' WHERE userid='$id'");
}

?>

<html>
    <head>
    <link href="../css/table.css" rel="stylesheet">
    </head>
    <body style="background-color:#FFFFE0">
    <table class="styled-table">
      <thead>
        <tr>
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
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php 
                  
                  $result = mysqli_query($connect, "SELECT * FROM `user` WHERE status='pending'");
                $no=1;
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
              <td>
                        <div class="btn-group">
                            <button type="button" id="popup_btn" class="btn btn-success " data-toggle="modal"
                                data-target="#popups">
                                Accept
                            </button>
                        
                        </div>    
                    </td>
              <?php 
                      $no++;
                    } ?> 
            </tr>
            
        </tbody>          
      </table>
      </div>
      <div class="modal fade" id="popups" tabindex="-1" role="dialog" aria-labelledby="exampleLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleLabel">Accept User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="accept-user.php">
                <div class="modal-body">

                <div class="form-group">
                            <label class="mb-2 text-muted" for="status">User ID</label>
                            <select class="form-control" id="id" name="id">
                            <?php 
                  
                  $result = mysqli_query($connect, "SELECT * FROM `user` WHERE status='pending'");

                  while($row = mysqli_fetch_assoc($result))
                  {
                    ?>
                    
                                <option value="<?=$row['userid'] ?>"><?=$row['userid'] ?></option>
                            
                    <?php
                  }
                        ?>
                        </select>
                        </div>
               
                    
                <div class="form-group">
                            <label class="mb-2 text-muted" for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="accepted">accept</option>
                            </select>
                        </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="accepting" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </html>