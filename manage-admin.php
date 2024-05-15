<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1 class="row mb-4">Manage Admin</h1>
    
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; // Displaying Session Message
                    unset($_SESSION['add']); // Removing Session Message
                }
    
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
    
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
    
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
    
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>
            
            <!-- Button to Add Admin -->
            <a href="add-admin.php" class="btn btn-primary col-sm-1 row mb-4">Add Admin</a>
    
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
    
                
                <?php 
                    //Query to Get all Admin
                    $sql = "SELECT * FROM tbl_admin";
                    //Execute the Query
                    $res = mysqli_query($conn, $sql);
    
                    //CHeck whether the Query is Executed of Not
                    if($res==TRUE)
                    {
                        // Count Rows to CHeck whether we have data in database or not
                        $count = mysqli_num_rows($res); // Function to get all the rows in database
    
                        $sn=1; //Create a Variable and Assign the value
    
                        //CHeck the num of rows
                        if($count>0)
                        {
                            //WE HAve data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Using While loop to get all the data from database.
                                //And while loop will run as long as we have data in database
    
                                //Get individual DAta
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];
    
                                //Display the Values in our Table
                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update-password.php?id=<?php echo $id; ?>" class="btn btn-primary col-sm-2.5">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>update-admin.php?id=<?php echo $id; ?>" class="btn btn-secondary col-sm-2.5">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>delete-admin.php?id=<?php echo $id; ?>" class="btn btn-danger col-sm-2.5">Delete Admin</a>
                                    </td>
                                </tr>
    
                                <?php
    
                            }
                        }
                        else
                        {
                            //We Do not Have Data in Database
                        }
                    }
    
                ?>
    
    
                
            </table>
    
        </div>
    </div>
    <!-- Main Content Setion Ends -->
    
    <?php include('partials/footer.php'); ?>
</body>
</html>
