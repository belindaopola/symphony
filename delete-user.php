<?php 
    // Include Constants Page
    include('config/constants.php');

    //echo "Delete User Page";

    if(isset($_GET['id'])) 
    {
        // Process to Delete
        // echo "Process to Delete";

        // 1. Get ID 
        $id = $_GET['id'];

        // 2. Delete user from Database
        $sql = "DELETE FROM tbl_user WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed or not and set the session message respectively
        // 3. Redirect to Manage user with Session Message
        if($res==true)
        {
            // User Deleted
            $_SESSION['delete'] = "<div class='success'>User Deleted Successfully.</div>";
            header('location:'.SITEURL.'manage-user.php');
        }
        else
        {
            // Failed to Delete User
            $_SESSION['delete'] = "<div class='error'>Failed to Delete user.</div>";
            header('location:'.SITEURL.'manage-user.php');
        }
    }
    else
    {
        // Redirect to Manage user Page
        // echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'manage-user.php');
    }

?>