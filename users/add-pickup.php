<?php
    require 'header-user.php';
    include('../connection.php');

    $email=$_SESSION['user_login'];

    if(isset($_POST['submit']))
    {
        $date=date('y-m-d');
        $pickups=$_POST['pickups'];
        $sname=$_POST['sender_name'];

        $fresult=mysqli_query($connect,"SELECT * FROM `user` WHERE companyemail='$email'");
        $row=mysqli_fetch_assoc($fresult);
        $id=$row['userid'];
        $staffname=$row['fullname'];

        $result=mysqli_query($connect,"INSERT INTO  pickups(userid,staffname,date,sname,no_pickups,pstatus) values('$id','$staffname','$date','$sname','$pickups','pending')");

        if($result)
        {
            $success="Added successfully";
        }
        else
        {
            $error="Error";
        }
    }
?>

<html>
    <head>   
         <link href="../css/formstyle.css" rel="stylesheet">
    </head>
    <body style="background-color:#FFFFE0">
    <div class="container-fluid col-lg-12 px-1 py-5 mx-auto">
    <div class="row  d-flex justify-content-center">
        <div class="col-xl-9 col-lg-8 col-md-12 col-11 text-center">
            <h3 class="text-muted">Add Pickup</h3>
            <div style="margin-left:auto;margin-right:auto;" class="card justify-content-center">
                <form method="POST" class="form-card row  gx-3 gy-2 align-items-center needs-validation" >
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
                <div class="col-md-4">
                            <label style="margin-right:-2px;" class="form-control-label px-3" for="date" >Date<span class="text-danger"> *</span></label> 
                            <?php
                            $sdate=date('d-m-y');
                            ?>
                            <p> <?php echo $sdate; ?></p>
                    </div>
                        
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="sender_name">Name of Sender<span class="text-danger"> *</span></label> 
                            <input type="text" id="sender_name" name="sender_name" placeholder="Enter name of sender"> 
                            <?php
                                // if(isset($input_errors['receiver_name']))
                                // {
                                //     echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_name'].'</span>';
                                // }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-control-label px-3" for="pickups">Number of pickup's<span class="text-danger"> *</span></label> 
                            <input type="text" id="pickups" name="pickups" placeholder="Enter number of pickups"> 
                            <?php
                                // if(isset($input_errors['receiver_contact']))
                                // {
                                //     echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['receiver_contact'].'</span>';
                                // }
                            ?>
                        </div>


                        <div class="text-center mt-5">
                        <button type="submit" name="submit">Submit</button>                                
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>
