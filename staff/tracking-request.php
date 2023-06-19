<?php
    require 'header-staff.php';
    include('../connection.php');


    $count=0;
    if(isset($_POST['tracking']))
    {
        $booking_id=$_POST['booking_id'];
        $R_date=$_POST['R_date'];
        $R_status=$_POST['R_status'];
        $D_date=$_POST['D_date'];

        $input_array=array();

        

        if(count($input_array) == 0)
        {
            $result=mysqli_query($connect,"UPDATE tracking SET R_date='$R_date',R_status='$R_status',D_date='$D_date' WHERE Booking_id='$booking_id'");

        }
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
            <table class="styled-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tracking id </th>
                        <th scope="col">Booking id </th>
                        <th scope="col">Sender stationcode</th>
                        <th scope="col">Sender date</th>    
                        <th scope="col">Sender status</th>
                        <th scope="col">Receiver stationcode</th>
                        <th scope="col">Receiver date</th>
                        <th scope="col">Receiver status</th>
                        <th scope="col">Delivery date</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $email=$_SESSION['staff_login'];
                    $stcresult=mysqli_query($connect,"SELECT * FROM `staff` WHERE email='$email'");
                    $stcrow=mysqli_fetch_assoc($stcresult);
                    $stcode=$stcrow['stationcode'];
                    $no=1;
                 
                        $result = mysqli_query($connect, "SELECT * FROM `tracking` INNER JOIN courier ON tracking.stationcode=courier.R_stationcode WHERE R_status='pending' AND tracking.Booking_id=courier.booking_id AND tracking.stationcode='$stcode'");
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                        ?>
                            <tr class="active-row">
                                <td><?=$no?></td>
                                <td><?=$row['tracking_id']?></td>
                                <td><?=$row['Booking_id']?></td>
                                <td><?=$row['S_stationcode']?></td>
                                <td><?=$row['S_date']?></td>
                                <td><?=$row['S_status']?></td>
                                <td><?=$row['stationcode']?></td>
                                <td><?=$row['R_date']?></td>
                                <td><?=$row['R_status']?></td>
                                <td><?=$row['D_date']?></td>
                                <td>
                                <div class="btn-group">
                                    <button type="button" id="popup_btn" class="btn btn-success " data-toggle="modal"
                                        data-target="#popups">
                                        Edit
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
    
                    

    <div class="modal fade" id="popups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Accept Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="tracking-request.php">
                <div class="modal-body">
                
                        <div class="form-group">
                            <label class="mb-2 text-muted" for="booking_id">Booking Id:</label>
                            <select id="booking_id" name="booking_id">
                                    <option value="">select</option>
                                    <?php

                                            $result = mysqli_query($connect,"SELECT * FROM `tracking` WHERE R_status='pending' AND  tracking.stationcode='$stcode' ");
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                    ?>
                                    <option value="<?= $row['Booking_id'] ?>"><?= $row['Booking_id'] ?></option>            
                                    <?php
                                        }
                                    ?>
                                </select>               
                                     </div>
                        <div class="form-group">
                            <label class="mb-2 text-muted" for="R_date">Date</label>
                            <input id="R_date" type="date" class="form-control" name="R_date" value=""
                                placeholder="Please Enter Received Date" required autofocus>
                        </div>

                        <div class="form-group">
                            <label class="mb-2 text-muted" for="R_status">Status</label>
                            <select class="form-control" id="R_status" name="R_status">
                                <option value="received">received</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="mb-2 text-muted" for="D_date">Expected Delivery Date</label>
                            <input id="D_date" type="date" class="form-control" name="D_date" value=""
                                placeholder="Please Enter Delivery Date" required autofocus>
                        </div>

                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="tracking" class="btn btn-primary">Save changes</button>
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