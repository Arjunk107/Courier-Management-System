<?php 
  require_once 'connection.php';
  session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management System</title>
    <!-- css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
<style>
    #navss{
        font-family: 'Philosopher', sans-serif;
        color:white;
    }
    #navss:hover
    {
        color:black;
        font-size:17px;
    }

      body {
        
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
      }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
        <img src="images/logoo.png" style="width:210px;height:70px" alt="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin/login.php">Admin Login</a>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="staff/login.php">staff Login</a>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="users/login.php">User Login</a>
                    </li>
                    
   
                </ul>
            </div>
        </div>
    </nav>

    <div class="bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="nav">
                        <a id="navss" class="nav-link" style="color:white;" aria-current="page" href="index.php">Home</a>
                        <a id="navss"class="nav-link" style="color:white;" href="prices.php">Pricing</a>
                        <a id="navss"class="nav-link" style="color:white;" href="view-tracking.php">Tracking</a>
                        <a id="navss"class="nav-link" style="color:white;" href="about.php">About Us</a>
                        <a id="navss"class="nav-link" style="color:white;" href="add-complaint.php">Complaint Box</a>                      
                    </nav>
                </div>
            </div>
        </div>
    </div>