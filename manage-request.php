<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper" style="width:100%">
        <h4 class="row mb-4">Critical Power Services</h4>
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

        <!-- Button to Add New CSR -->
        <a href="add-request.php" class="btn btn-primary col-sm-1 row mb-4">New CSR</a>

        <div class="table-responsive" style="overflow: auto; max-height: 564px;">
        <table class="tbl-full" style="min-width: 1000px;">
            <tr>
                <th style="width: 130px;">CSR Ref.</th>
                <th style="width: 130px;">Request Date</th>
                <th style="width: 200px;">Customer Name</th>
                <th style="width: 200px;">Title</th>
                <th style="width: 150px;">Quotation</th>
                <th style="width: 150px;">Customer PO</th>
                <th style="width: 150px;">Costing Sheet</th>
                <th style="width: 100px;">Currency</th>
                <th style="width: 100px;">Price</th>
                <th style="width: 100px;">VAT</th>
                <th style="width: 100px;">Total</th>
                <th style="width: 150px;">Status</th>
                <th style="width: 120px;">Salesperson</th>
                <th style="width: 120px;">Actions</th>
            </tr>

            <?php 
                // Get all the requests from the database with joins
                $sql = "
                    SELECT * FROM tbl_request
                    JOIN 
                        tbl_customer ON tbl_request.customer_name = tbl_customer.id
                    JOIN 
                        tbl_product ON tbl_request.title = tbl_product.id
                    JOIN 
                        tbl_user ON tbl_request.sales_person = tbl_user.id
                    ORDER BY 
                        tbl_request.id ASC
                ";

                // Execute Query
                $res = mysqli_query($conn, $sql);

                // Check if query executed successfully
                if ($res == TRUE) {
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
                                <td><?php echo "TS" . date("Y", strtotime($request_date)) . "/" . sprintf('%03d', $sn++); ?></td> <!-- Modify to pick the request_date not current year-->
                                <td><?php echo $request_date; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                        // Check whether quotation attachment is available or not
                                        if ($quotation != "") {
                                            // Display quotation image
                                            ?>
                                            <a href="<?php echo SITEURL; ?>uploads/files_ts/quotation/<?php echo $quotation; ?>" target="_blank">View Quotation</a>
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
                                        <a href="<?php echo SITEURL; ?>uploads/files_ts/po/<?php echo $customer_po; ?>" target="_blank">View Purchase Order</a>
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
                                        <a href="<?php echo SITEURL; ?>uploads/files_ts/costing/<?php echo $costing_sheet; ?>" target="_blank">View Costing Sheet</a>
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
                                    <a href="<?php echo SITEURL; ?>update-request.php?id=<?php echo $id; ?>" class="btn btn-secondary col-sm-2.5">Update request</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        // Request not Available
                        echo "<tr><td colspan='14' class='error'>No request available</td></tr>";
                    }
                } else {
                    // SQL query failed
                    echo "<tr><td colspan='14' class='error'>Failed to retrieve data from the database</td></tr>";
                }
            ?>
        </table>
    </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
