<?php

    require_once '../connection.php';
    session_start();

    if(isset($_SESSION['staff_login']))
    {
        header('location: indexstaff.php');
    }

    if(isset($_POST['staff_login']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $input_errors = array();

        if(empty($email)){
            $input_errors['email'] = "Email Address Field Is Required!";
        } 
		if(empty($password)){
            $input_errors['password'] = "Password Field Is Required!";
        }

        if(count($input_errors) == 0)
        {
            $result = mysqli_query($connect,"SELECT * FROM `staff` WHERE `email` = '$email'");

            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                
                
                if($password == $row['password'])
                {
                    $_SESSION['staff_login'] = $email;

                    header('location: indexstaff.php');
                }
                else{

					$error = 'Invalid Password!';
				}

            }
            else
            {

				$error = 'This Email Is Invalid!';
            }
        }
    }

?>


    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Muhamad Nauval Azhar">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="This is a login page template based on Bootstrap 5">
        <title>staff Login Page</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    
    <body style="background-color:#FFFFE0">
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-sm-center h-100">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                        <div class="text-center my-5">
                            <img src="../images/adminlogo.png" alt="logo" width="100">
                        </div>
                        <div class="card shadow-lg">
                            <div class="card-body p-5">
                                <h1 class="fs-4 card-title fw-bold mb-4 text-center">Staff Login</h1>
                                <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
    
    
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
    
                                    <div class="mb-3">
                                        <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                            placeholder="Please Enter Email Address"
                                            value="<?= isset($email) ? $email : '' ?>" required autofocus>
                                        <?php 
                                            if(isset($input_errors['email'])){
                                                echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['email'].'</span>';
                                            }
                                        ?>
                                    </div>
    
                                    <div class="mb-3">
                                        <div class="mb-2 w-100">
                                            <label class="text-muted" for="password">Password</label>
                                            <!-- <a href="forgot.html" class="float-end">
                                                Forgot Password?
                                            </a> -->
                                        </div>
                                        <input id="password" type="password" name="password" class="form-control"
                                            name="password" placeholder="Please Enter Password" required>
                                        <?php 
                                            if(isset($input_errors['password'])){
                                                echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['password'].'</span>';
                                            }
                                        ?>
                                    </div>
    
                                    <div class="d-flex align-items-center">
                                    <div class="icheck-primary">
                  
                                    <label for="remember">
                                        <a type="submit" class="btn btn-dark ms-auto"  href="../index.php">Go Back</a>
                                     </label>
                                    </div>
                                        <button type="submit" class="btn btn-dark ms-auto" name="staff_login">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center mt-5 mb-3 text-muted">
                            Copyright &copy; The Professional Couriers
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <script src="../js/bootstrap.bundle.min.js"></script>
    
    </body>
    
    </html>    
