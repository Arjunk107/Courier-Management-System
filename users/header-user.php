<?php

require_once '../connection.php';
session_start();

if(!isset($_SESSION['user_login'])){
    header('location: login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management System</title>
    <!-- css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
        <img src="../images/logoo.png" style="width:210px;height:70px" alt="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php 
          if(isset($_SESSION['user_login'])){
            ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="profile.php">My Profile</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="changepassword.php">Change Password</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                    </li>
                    <?php
          } else {
            ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <?php
          }
        ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="nav">
                        <a style="color:white" class="nav-link" aria-current="page" href="indexuser.php">Home</a>
                        <?php 
            if(isset($_SESSION['user_login'])){
              ?>
                        <a style="color:white" class="nav-link" href="book-user-courier.php">Book Courier</a>
                        <a style="color:white" class="nav-link" href="my-orders.php">My Orders</a>
                        <a style="color:white" class="nav-link" href="user-bill.php">Bills</a>
                        <?php
            } 
          ?>
                        <a style="color:white"class="nav-link" href="add-pickup.php">Add Pickup</a>
                        <a style="color:white"class="nav-link" href="complaint.php">Complaints</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>