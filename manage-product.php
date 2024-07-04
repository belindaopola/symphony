<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h2 class="row mb-4">Manage Product</h2>
    
            <!-- Button to Add Admin -->
            <a href="<?php echo SITEURL; ?>add-product.php" class="btn btn-primary col-sm-1.2 row mb-4">Add Product/Service</a>

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Create a SQL Query to Get all the product
                    $sql = "SELECT * FROM tbl_product";

                    //Execute the qUery
                    $res = mysqli_query($conn, $sql);

                    //Count Rows to check whether we have products or not
                    $count = mysqli_num_rows($res);

                    //Create Serial Number VAriable and Set Default VAlue as 1
                    $sn=1;

                    if($count>0)
                    {
                        //We have product in Database
                        //Get the products from Database and Display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the values from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-product.php?id=<?php echo $id; ?>" class="btn btn-secondary col-sm-2.5">Update product</a>
                                    <a href="<?php echo SITEURL; ?>delete-product.php?id=<?php echo $id; ?>" class="btn btn-danger col-sm-2.5">Delete product</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //product not Added in Database
                        echo "<tr> <td colspan='7' class='error'> product not Added Yet. </td> </tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    
    <?php include('partials/footer.php'); ?>
    

