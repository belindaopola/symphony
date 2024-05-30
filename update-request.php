<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Update Request</h1>

        <?php 
            // Check whether ID is set or not
            if(isset($_GET['id'])) {
                // Get the request details
                $id = intval($_GET['id']); // Sanitize ID

                // SQL query to get the request details
                $sql = "SELECT * FROM tbl_request WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                if($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    if($count == 1) {
                        // Detail available
                        $row = mysqli_fetch_assoc($res);
                        $description = $row['description'];
                        $price = $row['price'];
                        $vat = $row['vat'];
                        $quotation = $row['quotation'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_po = $row['customer_po'];
                        $costing_sheet = $row['costing_sheet'];                    
                    } else {
                        // Redirect to Manage Request
                        header('location:' . SITEURL . 'manage-request.php');
                    }
                }
            } else {
                // Redirect to Manage Request Page
                header('location:' . SITEURL . 'manage-request.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <label for="customer_name" class="col-sm-2 col-form-label">Customer Name:</label>
                <div class="col-sm-3"> 
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>" class="form-control">
                </div>
            </div>  
            <div class="row mb-4">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-3"> 
                    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-3"> 
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="vat" class="col-sm-2 col-form-label">VAT:</label>
                <div class="col-sm-3"> 
                    <input type="number" id="vat" name="vat" value="<?php echo htmlspecialchars($vat); ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="quotation" class="col-sm-2 col-form-label">Quotation:</label>
                <div class="col-sm-3"> 
                    <input type="file" id="quotation" name="quotation" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="customer_po" class="col-sm-2 col-form-label">Customer PO:</label>
                <div class="col-sm-3"> 
                    <input type="file" id="customer_po" name="customer_po" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="costing_sheet" class="col-sm-2 col-form-label">Costing Sheet:</label>
                <div class="col-sm-3"> 
                    <input type="file" id="costing_sheet" name="costing_sheet" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="status" class="col-sm-2 col-form-label">Status:</label>
                <div class="col-sm-3"> 
                    <select name="status" class="form-control">
                        <option <?php if($status=="requested"){echo "selected";} ?> value="requested">Requested</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Request" class="btn btn-primary col-sm-1.2">      
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                // Retrieve and sanitize form data
                $id = intval($_POST['id']);
                $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = floatval($_POST['price']);
                $vat = floatval($_POST['vat']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);

                // Handle file uploads
                $quotation = $_FILES['quotation']['name'];
                $customer_po = $_FILES['customer_po']['name'];
                $costing_sheet = $_FILES['costing_sheet']['name'];

                // Upload paths
                $quotation_target = "uploads/quotation/" . basename($quotation);
                $customer_po_target = "uploads/po/" . basename($customer_po);
                $costing_sheet_target = "uploads/costing/" . basename($costing_sheet);

                // Upload files if new files are provided
                if($quotation && move_uploaded_file($_FILES['quotation']['tmp_name'], $quotation_target)) {
                    $quotation_sql = ", quotation='$quotation'";
                } else {
                
