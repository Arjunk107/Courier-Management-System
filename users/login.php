<?php 

	require_once '../connection.php';
	session_start();

	if(isset($_SESSION['user_login'])){

        header('location: indexuser.php');

    }

	if(isset($_POST['user_login'])){

        $companyemail = $_POST['companyemail'];
        $password = $_POST['password'];

		$input_errors = array();

		if(empty($companyemail))
        {
            $input_errors['companyemail'] = "Email Address Field Is Required!";
        } 
		if(empty($password))
        {
            $input_errors['password'] = "Password Field Is Required!";
        }

		if(count($input_errors) == 0)
        {

			$result = mysqli_query($connect, "SELECT * FROM `user` WHERE `companyemail` = '$companyemail'");
           
			if($result)
            {

				while($row = mysqli_fetch_assoc($result))
                {
                    if($password == $row['password'] && $row['status']  == 'accepted')
                    {

                        $_SESSION['user_login'] = $companyemail;
                        
                        header('location: indexuser.php');

                    } 
                    else
                    {

                        $error = 'Invalid Password!';
                    }
                }


			}	
            else
            {

				$error = 'This Email Is Invalid   !';
	
			}

		}

	}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User's Login Page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body style="background-color:#FFFFE0">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="../images/userlogo.png" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4 text-center">User Login</h1>
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
                                    <label class="mb-2 text-muted" for="companyemail">E-Mail Address</label>
                                    <input id="companyemail" type="email" class="form-control" name="companyemail"
                                        placeholder="Please Enter Email Address" required>
                                    <?php 
                                        if(isset($input_errors['companyemail'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['companyemail'].'</span>';
                                        }
                                    ?>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
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
                                        <a type="submit" class="btn btn-dark ms-auto" href="../index.php">Go Back</a>
                                    </label>
                                    </div>
                                    <!-- <div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Remember Me</label>
									</div> -->
                                    <button type="submit" class="btn btn-dark ms-auto" name="user_login">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>