<?php include('config/constants.php'); ?>

<html>
    <head>
        <title>Login - Product Request System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center mb-4">Login</h1>
          
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
            <div class="row mb-4">
               <label for="inputUsername" class="col-sm-3 col-form-label">Username:</label>
               <div class="col-sm-6">
                    <input type="text" class="form-control"  name="username" required>
               </div>
            </div>
            <div class="row mb-4">
               <label for="inputPassword" class="col-sm-3 col-form-label">Password:</label>
               <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" required>
               </div>
            </div>
            <input type="submit" name="submit" value="Login" class="btn btn-primary col-sm-1.5">            
            </form>
            <!-- Login Form Ends Here -->

            <p class="text-center" style="margin-top:40">Created By - <a href="www.maradesigns.co.ke">Belinda Opola</a></p>
        </div>

    </body>
</html>

<?php 

    // Check whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        // Process for Login
        // 1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // 2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the Query
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            // Redirect to HOme Page/Dashboard
            header('location:'.SITEURL.'/');
        }
        else
        {
            // User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            // Redirect to HOme Page/Dashboard
            header('location:'.SITEURL.'login.php');
        }


    }

?>