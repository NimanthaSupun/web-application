<?php include('partials/menu.php'); ?>

            <!-- products table starts here -->
            <div class="form-container table-container">
                
                <div class="table">
                    <div class="table-header">
                        <h3>product Details</h3>
                        <?php
                            if(isset($_SESSION['add']))
                            {
                                echo $_SESSION['add'];
                                unset ($_SESSION['add']);
                            }

                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset ($_SESSION['update']);
                            }

                            if(isset($_SESSION['delete']))
                            {
                                echo $_SESSION['delete'];
                                unset ($_SESSION['delete']);
                            }
                        ?>
                        <a href="<?php echo SITEURL; ?>admin/add-product.php">
                            <input class="submit" type="button" name="submit" value="Add Product">
                        </a>
                    </div>

                    <div class="table-section">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Active</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                             <?php 
                                //get the page number
                                if(isset($_GET['page'])) {
                                    $page_no = $_GET['page'];
                                }
                                else{
                                    $page_no = 1;
                                }

                                //rows per page
                                $rows_per_page = 4;
                                $start = ($page_no - 1) * $rows_per_page ;

                                //create sql query to get all the product
                                $sql = "SELECT * FROM tbl_product ORDER BY id DESC LIMIT {$start}, {$rows_per_page} ";

                                //execute the query
                                $res = mysqli_query($conn, $sql);

                                //count row to check whether we have product or not
                                $count = mysqli_num_rows($res);

                                // get total number of rows
                                $total_rows_sql = "SELECT COUNT(*) AS total_rows FROM tbl_product ";
                                $total_rows_result = mysqli_query($conn, $total_rows_sql);
                                $total_rows_data = mysqli_fetch_assoc($total_rows_result);
                                $total_rows = $total_rows_data['total_rows'];

                                //last page number
                                $last_page_no = ceil($total_rows/$rows_per_page);

                                //create serial number variable
                               // Calculate the starting serial number based on the current page number
                                $start_sn = ($page_no - 1) * $rows_per_page + 1;

                                if($count>0)
                                {
                                    //we have product in database
                                    //get product from database and display
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the values from individual columns
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $price = $row['price'];
                                        $image1 = $row['image1'];
                                        $image2 = $row['image2'];
                                        $image3 = $row['image3'];
                                        $image4 = $row['image4'];
                                        $featured = $row['featured'];
                                        $active = $row['active'];

                             ?>

                                <tr>
                                    <td><?php echo $start_sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                            //check whether we have image or not
                                            if($image1=="")
                                            {
                                                //we do not have an image
                                                echo "<div class='danger'>Image not Added</div>";
                                            }
                                            else
                                            {
                                                //display the image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image1; ?>" >
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-product.php?id=<?php echo $id; ?>"><span class="material-icons-sharp edit">edit</span></a>
                                        <a href="delete-product.php?id=<?php echo $id; ?>&image1=<?php echo $image1; ?>&image2=<?php echo $image2; ?>&image3=<?php echo $image3; ?>&image4=<?php echo $image4; ?>">
                                            <span class="material-icons-sharp delete">delete</span>
                                        </a>

                                    </td>
                                </tr>

                                <?php
                                    }
                                }
                                else
                                {
                                    //product not added in database
                                    echo "<tr><td colspan ='7' class='danger'>product not added yet</td></tr>";
                                }
                                ?> 

                            </tbody>
                        </table>
                    </div>

                    <!-- pagination  -->
                    <div class="table-pagination">
                        <!-- first page  -->
                        <a href="<?php echo SITEURL; ?>admin/manage-products.php?page=1">First</a>
                        <!-- previous page  -->
                        <?php 
                            if($page_no <= 1){
                                ?>
                                    <a class="arrow"><span class="material-icons-sharp">west</span></a>
                                <?php
                            }else{
                                $prev_page_no = $page_no - 1;
                                ?>
                                    <a class="arrow" href="<?php echo SITEURL; ?>admin/manage-products.php?page=<?php echo $prev_page_no; ?>"><span class="material-icons-sharp">west</span></a>
                                <?php
                            }
                        ?>

                            <!-- display current page number over all pages -->
                        <a class="muted">Page <?php echo $page_no; ?> of <?php echo $last_page_no; ?></a>

                        <!-- next page  -->
                        <?php 
                            if($page_no >= $last_page_no){
                                ?>
                                    <a class="arrow"><span class="material-icons-sharp">east</span></a>
                                <?php
                            }else{
                                $next_page_no = $page_no + 1;
                                ?>
                                    <a class="arrow" href="<?php echo SITEURL; ?>admin/manage-products.php?page=<?php echo $next_page_no; ?>"><span class="material-icons-sharp">east</span></a>
                                <?php
                            }
                        ?>
                        <!-- last page  -->
                        <a href="<?php echo SITEURL; ?>admin/manage-products.php?page=<?php echo $last_page_no; ?>">Last</a>
                    </div>

                </div>
           

            </div>
    
<?php include('partials/footer.php'); ?>