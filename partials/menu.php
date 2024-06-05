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
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-admin.php">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-user.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-section.php">Section</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-customer.php">Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="manage-product.php">Product</a></li>
                <!-- Requests Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Requests
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="manage-request.php">TS Requests</a></li>
                        <li><a class="dropdown-item" href="manage-it-request.php">IT Requests</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section Ends -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
