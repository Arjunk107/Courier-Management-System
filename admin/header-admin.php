<?php

// require_once '../connection.php';
session_start();

if(!isset($_SESSION['admin_login'])){
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
<style>
    #navs{
        font-family: 'Philosopher', sans-serif;
        color:white;
    }
    #navs:hover
    {
        color:black;
        font-size:17px;
    }
</style>
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
          if(isset($_SESSION['admin_login'])){
            ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="profile.php">Admin Profile</a>
                    </li>

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
                        <a id="navs" class="nav-link" style="color:white;" aria-current="page" href="indexadmin.php">Home</a>
                        <?php 
            if(isset($_SESSION['admin_login'])){
              ?>
                        <a id="navs" class="nav-link" style="color:white;" href="add-staff.php">Add Staff</a>
                        <a id="navs" class="nav-link" style="color:white;" href="view-courier-admin.php">View Courier</a>
                        <a id="navs" class="nav-link" style="color:white;" href="accept-user.php">Accept Users</a>
                        <a id="navs" class="nav-link" style="color:white;" href="view-user.php">view Users</a>
                        <a id="navs" class="nav-link" style="color:white;" href="stations.php">Add Station</a>
                        <a id="navs" class="nav-link" style="color:white;" href="view-stations.php">View station</a>
                        <?php
            } 
          ?>
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>