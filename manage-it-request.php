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
            ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Update Critical Power Request</h1>

        <?php 
        
            // Check whether id is set or not
            if(isset($_GET['id']))
            {
                // Get the request details
                $id = $_GET['id'];

                // SQL query to get the request details with joins for customer and salesperson names
                $sql = "SELECT ir.*, c.customer_name, p.title, u.user_name AS sales_person 
                        FROM tbl_request ir
                        JOIN tbl_customer c ON ir.customer_name = c.id
                        JOIN tbl_product p ON ir.title = p.id
                        JOIN tbl_user u ON ir.sales_person = u.id
                        WHERE ir.id = $id";
                // Execute query
                $res = mysqli_query($conn, $sql);
                // Count rows
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    // Details available
                    $row = mysqli_fetch_assoc($res);

                    $customer_name = $row['customer_name'];
                    $title=$row['title']; 
                    $description = $row['description'];
                    $currency = $row['currency'];
                    $price = $row['price'];
                    $vat = $row['vat'];
                    $quotation = $row['quotation'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_po = $row['customer_po'];
                    $costing_sheet = $row['costing_sheet'];
                    $sales_person = $row['sales_person'];
                }
                else
                {
                    // Detail not available
                    // Redirect to manage request
                    header('location:' . SITEURL . 'manage-it-request.php');
                }
            }
            else
            {
                // Redirect to manage request page
                header('location:' . SITEURL . 'manage-it-request.php');
            }
        
        ?>

        <form action="" method="POST">
            <div class="row mb-4">
                <label for="inputCustomerName" class="col-sm-2 col-form-label">Customer Name:</label>
                <div class="col-sm-3"> 
                    <select id="customer-name" name="customer_name" class="form-control">
                        <option value="">Select Customer</option>
                        <?php 
                            $sql2 = "SELECT id, customer_name FROM tbl_customer";
                            $res2 = mysqli_query($conn, $sql2);
                            while ($row = mysqli_fetch_assoc($res2)) {
                                $selected = $row['id'] == $customer_name ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['customer_name'] . "</option>";
                            }
                        ?>
                        <option value="new">Add New Customer</option>
                    </select>
                </div>
            </div>  
            <div class="row mb-4">
                <label for="inputDescription" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-3"> 
                <input type="text" id="description" name="description" value="<?php echo $description; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputquotation" class="col-sm-2 col-form-label">Quotation:</label>
                <div class="col-sm-3"> 
                <input type="file" id="quotation" name="quotation" value="<?php echo $quotation; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputPo" class="col-sm-2 col-form-label">Customer PO:</label>
                <div class="col-sm-3"> 
                <input type="file" id="customer_po" name="customer_po" value="<?php echo $customer_po; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputCostingsheet" class="col-sm-2 col-form-label">Costing Sheet:</label>
                <div class="col-sm-3"> 
                <input type="file" id="costing_sheet" name="costing_sheet" value="<?php echo $costing_sheet; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="currency" class="col-sm-2 col-form-label">Currency:</label>
                <div class="col-sm-3">
                    <select id="currency" name="currency" class="form-control">
                        <option value="USD" <?php if($currency == "USD"){echo "selected";} ?>>USD</option>
                        <option value="EUR" <?php if($currency == "EUR"){echo "selected";} ?>>EUR</option>
                        <option value="KES" <?php if($currency == "KES"){echo "selected";} ?>>KES</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputPrice" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-3"> 
                <input type="number" id="price" name="price" value="<?php echo $price; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputVAT" class="col-sm-2 col-form-label">VAT:</label>
                <div class="col-sm-3"> 
                <input type="number" id="vat" name="vat" value="<?php echo $vat; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="sales_person" class="col-sm-2 col-form-label">Sales Person:</label>
                <div class="col-sm-3">
                    <select id="sales_person" name="sales_person" class="form-control">
                        <option value="">Select Sales Person</option>
                        <?php 
                            $sql4 = "SELECT id, user_name FROM tbl_user";
                            $res4 = mysqli_query($conn, $sql4);
                            while ($row = mysqli_fetch_assoc($res4)) {
                                $selected = $row['id'] == $sales_person ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['user_name'] . "</option>";
                            }
                        ?>
                        <option value="new">Add New Sales Person</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputStatus" class="col-sm-2 col-form-label">Status:</label>
                <div class="col-sm-3"> 
                    <select name="status" class="form-control">
                        <option <?php if($status == "requested"){echo "selected";} ?> value="requested">requested</option>
                        <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status == "Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status == "Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <input type="submit" name="submit" value="Update request" class="btn btn-primary col-sm-1.2">      
        </form>

        <?php 
            // Check whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                // Get All the Values from Form
                $id = $_POST['id'];
                $description = $_POST['description'];
                $quotation = $_POST['quotation'];
                $customer_po = $_POST['customer_po'];
                $costing_sheet = $_POST['costing_sheet'];
                $currency = $_POST['currency'];
                $price = $_POST['price'];
                $vat = $_POST['vat'];
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $sales_person = $_POST['sales_person'];

                // Update the Values
                $sql2 = "UPDATE tbl_it_request SET 
                    description = '$description',
                    quotation = '$quotation',
                    customer_po = '$customer_po',
                    costing_sheet = '$costing_sheet',
                    currency = '$currency',
                    price = $price,
                    vat = $vat,
                    status = '$status',
                    customer_name = $customer_name,
                    sales_person = $sales_person
                    WHERE id = $id
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether update or not and redirect to manage request with message
                if($res2 == true)
                {
                    // Updated
                    $_SESSION['update'] = "<div class='success'>Request Updated Successfully.</div>";
                    header('location:' . SITEURL . 'manage-request.php');
                }
                else
                {
                    // Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Request.</div>";
                    header('location:' . SITEURL . 'manage-it-request.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

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
