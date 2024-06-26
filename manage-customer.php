<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="row mb-4">Manage Customer</h1>
    
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
    
            <!-- Button to Add New Customer -->
            <a href="<?php echo SITEURL; ?>add-customer.php" class="btn btn-primary col-sm-1.2 row mb-4">Add Customer</a>
        
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
    
                <?php 
                    // Query to get all customers from the database
                    $sql = "SELECT * FROM tbl_customer";
    
                    // Execute query
                    $res = mysqli_query($conn, $sql);
    
                    // Check if there is any data in the database
                    if(mysqli_num_rows($res) > 0) {
                        // Loop through each row of data
                        $sn = 1; // Serial number counter
                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            $featured = $row['featured'];
                            $active = $row['active'];
    
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-customer.php?id=<?php echo $id; ?>" class="btn btn-secondary col-sm-2.5">Update Customer</a>
                                    <a href="<?php echo SITEURL; ?>delete-customer.php?id=<?php echo $id; ?>" class="btn btn-danger col-sm-2.5">Delete Customer</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // No data found in the database
                        ?>
                        <tr>
                            <td colspan="8"><div class="error">No Customers Added.</div></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    
    <?php include('partials/footer.php'); ?>


