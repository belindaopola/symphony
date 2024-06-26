<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper" style="width:100%">
        <h1 class="row mb-4">IT Services</h1>
        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Displaying Session Message
                unset($_SESSION['add']); // Removing Session Message
            }

            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <!-- Button to Add New CRS -->
        <a href="add-it-request.php" class="btn btn-primary col-sm-1 row mb-4">New CSR</a>

        <table class="tbl-full">
            <tr>
                <th>CSR Ref.</th>
                <th>Request Date</th>
                <th>Customer Name</th>
                <th>Title</th>
                <th>Quotation</th>
                <th>Customer PO</th>
                <th>Costing Sheet</th>
                <th>Currency</th>
                <th>Price</th>
                <th>VAT</th>
                <th>Total</th>
                <th>Status</th>
                <th>Salesperson</th>
                <th>Actions</th>
            </tr>

            <?php 
                // Get all the requests from the database with joins
                $sql = "
                    SELECT * FROM tbl_it_request
                    JOIN 
                        tbl_customer ON tbl_it_request.customer_name = tbl_customer.id
                    JOIN 
                        tbl_product ON tbl_it_request.title = tbl_product.id
                    JOIN 
                        tbl_user ON tbl_it_request.sales_person = tbl_user.id
                    ORDER BY 
                        tbl_it_request.id ASC
                ";
                // Execute Query
                $res = mysqli_query($conn, $sql);
                // Count the Rows
                $count = mysqli_num_rows($res);

                $sn = 1; // Create a Serial Number and set its initial value as 1

                if($count > 0) {
                    // Request Available
                    while($row = mysqli_fetch_assoc($res)) {
                        // Get all the request details
                        $id = $row['id'];
                        $request_date = $row['request_date'];
                        $customer_name = $row['customer_name'];
                        $title = $row['title'];
                        $quotation = $row['quotation'];
                        $customer_po = $row['customer_po'];
                        $costing_sheet = $row['costing_sheet'];
                        $currency = $row['currency'];
                        $price = $row['price'];
                        $vat = $row['vat'];
                        $total = $row['total'];
                        $status = $row['status'];
                        $salesperson = $row['user_name'];
                        ?>

                        <tr>
                            <td><?php echo "IT" . date("Y") . "/" . sprintf('%03d', $sn++); ?></td> <!-- Modify to pick the request_date not current year-->
                            <td><?php echo $request_date; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php
                                    // Check whether quotation attachment is available or not
                                    if ($quotation != "") {
                                        // Display quotation image
                                        ?>
                                        <a href="<?php echo SITEURL; ?>uploads/files_it/quotation/<?php echo $quotation; ?>" target="_blank">View Quotation</a>
                                    <?php
                                    } else {
                                        echo "<div class='error'>Please attach quotation.</div>";
                                    }
                                ?>
                            </td>

                            <td>
                                <?php
                                    // Check whether purchase order attachment is available or not
                                    if ($customer_po != "") {
                                        // Display purchase order image
                                        ?>
                                        <a href="<?php echo SITEURL; ?>uploads/files_it/po/<?php echo $customer_po; ?>" target="_blank">View Purchase Order</a>
                                    <?php
                                    } else {
                                        echo "<div class='error'>Please attach purchase order.</div>";
                                    }
                                ?>
                            </td>

                            <td>
                                <?php
                                    // Check whether costing sheet attachment is available or not
                                    if ($costing_sheet != "") {
                                        // Display costing sheet image
                                        ?>
                                        <a href="<?php echo SITEURL; ?>uploads/files_it/costing/<?php echo $costing_sheet; ?>" target="_blank">View Costing Sheet</a>
                                    <?php
                                    } else {
                                        echo "<div class='error'>Please attach costing sheet.</div>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $currency; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $vat; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $salesperson; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-it-request.php?id=<?php echo $id; ?>" class="btn btn-secondary col-sm-2.5">Update request</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // Request not Available
                    echo "<tr><td colspan='14' class='error'>No request available</td></tr>";
                }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
