<?php
    require 'header-staff.php';
    include('../connection.php');


    if(isset($_POST['accepting']))
    {
        $id=$_POST['id'];
        $status=$_POST['status'];

        $result=mysqli_query($connect,"UPDATE `pickups` SET pstatus='$status' WHERE pickup_id='$id'");
        if($result)
        {
            $success='Updated successfully';
        }
        else{
            $error='Not Updated';
        }
    }
?>
<html>
    <head>
    <link href="../css/table.css" rel="stylesheet">
    </head>
    <body style="background-color:#FFFFE0"> 
    <div class="container">
                            <?php 
                                if(isset($success)){
                                    ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

                            <?php 
                                if(isset($error)){
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

     </div>                       
    <div class="table-style">
        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">date</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Address</th>
                    <th scope="col">Number of pickups</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $email=$_SESSION['staff_login'];
                $date=date('y-m-d');
                $fresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
                $frow= mysqli_fetch_assoc($fresult);
                $stname=$frow['fullname'];
                $ffresult= mysqli_query($connect," SELECT * FROM `pickups` INNER JOIN `user` ON pickups.userid=user.userid WHERE pstatus='pending' AND pickups.staffname='$stname' AND date='$date'");
                $no=1;
                while($row = mysqli_fetch_assoc($ffresult))

                {
                    
                  ?>
                <tr class="active-row">
                    <td><?=$no?></td>
                    <td><?=$row['pickup_id']?></td>
                    <td><?=$row['date']?></td>
                    <td><?=$row['sname']?></td>
                    <td><?=$row['phnumber']?></td>
                    <td><?=$row['companyname'],", </br>",$row['streetname'],", </br>",$row['city'],", </br>",$row['district'],", </br>",$row['state'],", </br>",$row['pincode']?>
                    </td>
                    <td><?=$row['no_pickups']?></td>
                    <td><?=$row['pstatus']?></td>
                    <td>
                    <div class="btn-group">
                        <button type="button" id="popup_btn" class="btn btn-success " data-toggle="modal" data-target="#popups"> Received </button>
                    </div>    
                    </td>
                </tr>

                <?php 
                $no++;
                  } 
                     
                   ?>


            </tbody>
        </table>
    </div>
    <div class="modal fade" id="popups" tabindex="-1" role="dialog" aria-labelledby="exampleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleLabel">Pickup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
                <div class="modal-body">

                <div class="form-group">
                            <label class="mb-2 text-muted" for="status">Pickup ID</label>
                            <select class="form-control" id="id" name="id">
                            <?php 
                  
                  $result = mysqli_query($connect, "SELECT * FROM `pickups` ");

                  while($row = mysqli_fetch_assoc($result))
                  {
                    ?>
                    
                                <option value="<?=$row['pickup_id'] ?>"><?=$row['pickup_id'] ?></option>
                            
                    <?php
                  }
                        ?>
                        </select>
                        </div>

                    
                <div class="form-group">
                            <label class="mb-2 text-muted" for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="received">received</option>
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

</html>

