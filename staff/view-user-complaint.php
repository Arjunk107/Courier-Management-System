<?php
require 'header-staff.php';
include ('../connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST['complaining']))
{

echo'working';
    // $mail = new PHPMailer(true);
    // $mail->isSMTP();
    // $mail->host = 'smtp.gmail.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = 'arjunktcs107@gmail.com';
    // $mail->Password = 'ujbydzkdmefztach';
    // $mail->SMTPSecure = 'ssl';
    // $mail->Port = 465;

    // $mail->setForm('arjunktcs107@gmail.com');

    // $mail->addAddress($_POST['cmpmail']);

    // $mail->isHTML(true);

    // $mail->Subject = "Professional Couriers Complaint Reply";   
    // $mail->Body = $_POST['complaint'];

    // $mail->send();
    // echo 'Done';
    // echo "<script>alert('Sent Successfully');
    // document.location.href = 'view-user-complaint.php'</script>";
}

?>

<html>

<head>
    <link rel="stylesheet" href="complaint-card.css">
</head>

<body style="background-color:#FFFFE0">
    <div class="container">
        <div class="card-deck">
            <div class="card" style="margin-top:15px">
                <div class="card-body">

                    <?php
    $email=$_SESSION['staff_login'];

    $result=mysqli_query($connect,"SELECT * FROM `usercomplaint` INNER JOIN `user` ON usercomplaint.userid=user.userid INNER JOIN `staff` ON user.stationcode=staff.stationcode WHERE usercomplaint.status='pending' AND staff.email='$email'");
    while($row=mysqli_fetch_assoc($result))
    {
?>

                    <h5 class="card-title">Company Name : <?= $row['companyname']; ?></h5>
                    <p class="card-text"> Complainet Id : <?= $row['complaintid']; ?></p>
                    <p class="card-text"> Complainer Name:<?= $row['sname']; ?></p>
                    <p class="card-text"> Email adddress:<?= $row['email']; ?></p>
                    <p class="card-text"> Complaint:<?= $row['complaint']; ?></p>
                    <p class="card-text"> Phone number:<?= $row['phnumber']; ?></p>

                </div>
                <?php
    }

?>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">Reply</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Complaint Reply</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="">
                    <div class="modal-body">
                        <label class="d-block mb-4">
                            <span class="d-block mb-2">Complainer Email  : </span>
                            <input name="cmpmail" type="email" class="form-control" />
                        </label>
                        <label class="d-block mb-4">
                            <span class="d-block mb-2">Reply</span>
                            <textarea name="complaint" class="form-control" rows="3"
                                placeholder="Please describe your problem"></textarea>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="complaining">Save changes</button>
                    </div>
                </form>
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