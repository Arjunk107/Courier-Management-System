<?php
require 'header-staff.php';
include ('../connection.php');
?>

<html>

<head>
    <link rel="stylesheet" href="complaint-card.css">
</head>

<body style="background-color:#FFFFE0">
    <div class="container">
        <div class="card-deck" style="margin-top:5px">
            <div class="card" style="margin-top:15px">
                <div class="card-body">

<?php
    $email=$_SESSION['staff_login'];

    $result=mysqli_query($connect,"SELECT * FROM `complaint`  INNER JOIN `courier` ON complaint.bookingid=courier.booking_id WHERE complaint.status='pending' AND courier.email='$email'");
    while($row=mysqli_fetch_assoc($result))
    {
?>
                
                    <h5 class="card-title text-center">Booking id : <?= $row['bookingid']; ?></h5>
                    <p class="card-text"> Complainer Name:<?= $row['cname']; ?></p>
                    <p class="card-text"> Email adddress:<?= $row['cemail']; ?></p>
                    <p class="card-text"> Complaint:<?= $row['complaint']; ?></p>
                    <p class="card-text"> Phone number:<?= $row['phnumber']; ?></p>

                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Reply</button>
                </div>
            </div>
        </div>
<?php
    }

?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Complaint Reply</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="d-block mb-4">
                <span class="d-block mb-2">Email address</span>
                <input name="bkingid" type="text" class="form-control"/>
                </label>
                <label class="d-block mb-4">    
                    <span class="d-block mb-2">Complaint</span>
                    <textarea name="complaint"  class="form-control" rows="3" placeholder="Please describe your problem"></textarea>
                </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
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