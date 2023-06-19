<?php
require 'header-user.php';
include('../connection.php');

$email=$_SESSION['user_login'];
$fresult=mysqli_query($connect,"SELECT * FROM `user` WHERE companyemail='$email'");
while($frow=mysqli_fetch_assoc($fresult))
{
    $userid=$frow['userid'];

if(isset($_POST['submit']))
{
    $name=$_POST['sname'];
    $email=$_POST['email'];
    $complaint=$_POST['complaint'];

    $result=mysqli_query($connect,"INSERT INTO  `complaint`(userid,sname,email,complaint) VALUES('$userid','$name',' $email','$complaint')"); 
    
    if($result)
    {
        $success='complaint registered';
    }
    else
    {
        $error='something wrong';
    }
    
}
}
?>

<html>
    <head>

    </head>
    <body style="background-color:#FFFFE0">
      <div class="container-fluid col-lg-12 px-1 py-5 mx-auto">
    <div class="row  d-flex justify-content-center">
        <div class="col-xl-9 col-lg-8 col-md-12 col-11 text-center">
                <h1 class="text-muted">Complaint </h1>
                  <div class="col-md-7 col-lg-5 px-lg-2 col-xl-4 px-xl-0">
            <form method="POST" class="w-100 rounded p-4 border bg-white" style="margin-left:400px;margin-top:20px" action="" >
            <?php 
                        if(isset($success))
                        {
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
                
                <label class="d-block mb-4">
                <span class="d-block mb-2">Your Name</span>
                <input name="sname" type="text" class="form-control"/>
                </label>

                <label class="d-block mb-4">
                <span class="d-block mb-2">Email address</span>
                <input name="email" type="email" class="form-control"/>
                </label>



                <label class="d-block mb-4">
                <span class="d-block mb-2">Complaint</span>
                <textarea name="complaint"  class="form-control" rows="3" placeholder="Please describe your problem"
                ></textarea>
                </label>

                <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-primary px-3">Submit</button>
                </div>

            </form>
            </div>
        </div>
                    </div>
                    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</html>

