<?php
ob_start();
require 'header-staff.php';
include ('../connection.php');

if(isset($_POST['accepting']))
{
    $booking_id=$_POST['booking_id'];
    $status=$_POST['status'];


    $fresult = mysqli_query($connect,"UPDATE `usercourier` SET  status='$status' WHERE booking_id='$booking_id'");
    if($fresult)
    {
        $success='Successfully updated';
        header('Location:qr.php?bkid='.$booking_id);
    }
    else
    {
        $error='somethong wrong';
    }
}

?>

<html>
<head>
<link href="../css/table.css" rel="stylesheet">
</head>
<body style="background-color:#FFFFE0">
<div class="table-style">
        <table class="styled-table">
                            <?php 
                                if(isset($success)){
                                    ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" style="width:500px;margin-left:500px"role="alert">
                                <?= $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">date</th>
                    <th scope="col">Booking Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Contact</th>
                    <th scope="col">Receiver Address</th>
                    <th scope="col">Category</th>
                    <th scope="col">Mode of transportation</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <?php 
                $no=1;
                  $result=mysqli_query($connect,"SELECT * FROM `usercourier` INNER JOIN `staff` ON usercourier.S_stationcode=staff.stationcode WHERE status='pending' and staff.position='office'");
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
                    <td><?=$row['receiver_companyname'],", </br>",$row['receiver_streetname'],", </br>",$row['receiver_city'],", </br>",$row['receiver_district'],", </br>",$row['receiver_state'],", </br>",$row['receiver_pincode']?></td>
                    <td><?=$row['category']?></td>
                    <td><?=$row['mot']?></td>
                    <td><?=$row['status']?></td>
                    <?php 
                    $no++
                    ?>
                    <td>
                        <div class="btn-group">
                            <button type="button" id="popup_btn" class="btn btn-success " data-toggle="modal"
                                data-target="#popups"> Received </button>
                        
                            
                        </div>    
                    </td>
                </tr>

                <?php 
                  }
                  ?>


            </tbody>
        </table>
    </div>


    
    <div class="modal fade" id="popups" tabindex="-1" role="dialog" aria-labelledby="exampleLabel"
        aria-hidden="true">
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleLabel">Accept Courier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="accept-user-courier.php">
                <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-2 text-muted" for="booking_id">booking Id:</label>
                            <select class="form-control" id="status" name="status">
                            <?php
                            $bkresult=mysqli_query($connect,"SELECT * FROM `usercourier` INNER JOIN `staff` ON usercourier.S_stationcode=staff.stationcode WHERE status='pending' and staff.position='office'");
                            while($Bkrow = mysqli_fetch_assoc($bkresult))
                            {


                            ?>
                            <option value="<?= $Bkrow['booking_id']?>"><?= $Bkrow['booking_id'] ?></option>
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


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<html>