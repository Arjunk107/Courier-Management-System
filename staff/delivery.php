<?php
    require 'header-staff.php';
    include('../connection.php');

    if(isset($_POST['delivering']))
    {
        $bookingid=$_POST['booking_id'];
        $status=$_POST['dstatus'];
        $result=mysqli_query($connect,"UPDATE `delivery` SET dstatus='$status' WHERE booking_id='$bookingid'");
    }
    if(isset($_POST['reasoning']))
    {
        $bookingid=$_POST['booking_id'];
        $reason=$_POST['reason'];
        $result=mysqli_query($connect,"UPDATE `delivery` SET reason='$reason' WHERE booking_id='$bookingid'");
    }

?>
<html>

<head>
    <link href="../css/table.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#FFFFE0">

    <div class="container">
        <div class="table-style">
            <table style="margin-left:auto;margin-right:auto;width:75%;" class="styled-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Booking id </th>
                        <th scope="col">Receiver name</th>
                        <th scope="col">Receiver Address</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            $date = date('y-m-d');
                            $result = mysqli_query($connect, "SELECT * FROM `delivery` INNER JOIN `staff` ON delivery.Staff_id=staff.Staff_id INNER JOIN `courier`ON delivery.booking_id=courier.booking_id AND delivery.dstatus='pending' WHERE delivery.date='$date'");
                            $no=1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                    <tr class="active-row">
                    <td><?=$no?></td>
                        <td><?=$row['booking_id']?></td>
                        <td><?=$row['receiver_name']?></td>
                        <td><?=$row['receiver_housename'],", </br>",$row['receiver_streetname'],", </br>",$row['receiver_city'],", </br>",$row['receiver_district'],", </br>",$row['receiver_state'],", </br>",$row['receiver_pincode']?>
                        </td>
                        <td><?=$row['date']?></td>
                        <td><?=$row ['dstatus']?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" id="popup_btn" class="btn btn-success " data-toggle="modal"
                                    data-target="#popups">
                                    Delivered
                                </button>
                                <button type="button" id="popup_btn" class="btn btn-danger " data-toggle="modal"
                                    data-target="#popup">
                                    Not Delivered
                                </button>
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

        <div class="modal fade" id="popups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delivery Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="mb-2 text-muted" for="booking_id">Booking Id</label>
                                <select id="booking_id" name="booking_id">
                                    <option value="">select</option>
                                    <?php

                                        $email = $_SESSION['staff_login'];
                                        $idresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
                                        $idrow=mysqli_fetch_assoc($idresult);
                                        $id=$idrow['Staff_id'];
                                        $stcode=$idrow['stationcode'];

                                            $result = mysqli_query($connect,"SELECT * FROM `delivery` WHERE dstatus='pending' AND  stationcode='$stcode' AND Staff_id='$id'");
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                    ?>
                                    <option value="<?= $row['booking_id'] ?>"><?= $row['booking_id'] ?></option>
                                    <?php
                                        }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 text-muted" for="dstatus">Status</label>
                                    <select name="dstatus" id="dstatus" class="form-control">
                                        <option value="delivered">Delivered</option>
                                    </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="delivering" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delivery Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="mb-2 text-muted" for="booking_id">Booking Id</label>
                                <select id="booking_id" name="booking_id">
                                    <option value="">select</option>
                                    <?php

                                        $email = $_SESSION['staff_login'];
                                        $idresult = mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
                                        $idrow=mysqli_fetch_assoc($idresult);
                                        $id=$idrow['Staff_id'];
                                        $stcode=$idrow['stationcode'];

                                            $result = mysqli_query($connect,"SELECT * FROM `delivery` WHERE dstatus='pending' AND  stationcode='$stcode' AND Staff_id='$id'");
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                    ?>
                                    <option value="<?= $row['booking_id'] ?>"><?= $row['booking_id'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 text-muted" for="reason">Reason</label>
                                <select class="form-control"name="reason" id="resaon">
                                 <option value="dc">Door Closed</option>
                                <option value="ai">Address Invalid</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="reasoning" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>