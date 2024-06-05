<?php 
include('config/constants.php'); 
include('login-check.php');
?>

<html>
<head>
    <title>Service Requests - Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-user.php">Users</a></li>
                <li><a href="manage-section.php">Section</a></li>
                <li><a href="manage-customer.php">Customers</a></li>
                <li><a href="manage-product.php">Product</a></li>
                <li><a href="manage-request.php">TS Requests</a></li>
                <li><a href="manage-it-request.php">IT Requests</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section Ends -->