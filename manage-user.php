<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="row mb-4">Manage Users</h1>
    
            <?php 
                // Display session messages
                $session_messages = ['add', 'remove', 'delete', 'no-section-found', 'update', 'upload', 'failed-remove'];
                foreach ($session_messages as $message) {
                    if(isset($_SESSION[$message])) {
                        echo $_SESSION[$message];
                        unset($_SESSION[$message]);
                    }
                }
            ?>
    
            <!-- Button to Add New User -->
            <a href="<?php echo SITEURL; ?>add-user.php" class="btn btn-primary col-sm-1.2 row mb-4">Add User</a>
        
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Department</th>
                </tr>
    
                <?php 
                    // Query to get all users from the database
                    $sql = "SELECT * FROM tbl_user";
    
                    // Execute query
                    $res = mysqli_query($conn, $sql);
    
                    // Check if there is any data in the database
                    if(mysqli_num_rows($res) > 0) {
                        // Loop through each row of data
                        $sn = 1; // Serial number counter
                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $role = $row['role'];
                            $department = $row['department'];
    
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $role; ?></td>
                                <td><?php echo $department; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-user.php?id=<?php echo $id; ?>" class="btn btn-secondary col-sm-2.5">Update User</a>
                                    <a href="<?php echo SITEURL; ?>delete-user.php?id=<?php echo $id; ?>" class="btn btn-danger col-sm-2.5">Delete User</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // No data found in the database
                        ?>
                        <tr>
                            <td colspan="8"><div class="error">No User Added.</div></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    
    <?php include('partials/footer.php'); ?>


