<?php 

    require_once 'header-admin.php';

    $email = $_SESSION['admin_login'];

?>

<html>
<body style="background-color:#FFFFE0">

<div class="basic-price-table">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

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
                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert"><?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                                }
                            ?>

                <table class="table table-bordered table-striped table-hover mt-5 mb-5">
                    <thead>
                        <tr>
                            <td colspan="9">
                                <h3>Manage Users</h3>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">City Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                
                                $result = mysqli_query($connect, "CALL read_user()");

                                while($row = mysqli_fetch_assoc($result)){

                                ?>
                        <tr>
                            <td><?= $row['fullname'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>0<?= $row['contact'] ?></td>
                            <td><?= $row['city'] ?></td>
                            <td><a style="text-decoration: none;"
                                    href="delete.php?user-delete=<?= base64_encode($row['id']) ?>"
                                    onclick="return confirm('Are You Sure To Delete?')">Delete Account</a></td>

                        </tr>

                        <?php 
                                    
                                } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>