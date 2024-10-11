<?php include('partials/menu.php'); ?>


            <!-- Category table starts here -->
            <div class="form-container table-container">
                
                <div class="table">
                    <div class="table-header">
                        <h3>Order Details</h3>
                        <?php 
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                        ?>
                        <div>
                            <select class="order-filter" name="" id="">
                                <option value="">Filter by 🡇</option>
                                <option value="">Delivered</option>
                                <option value="">canceled</option>
                                <option value="">Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-section order-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Order Date</th>
                                    <th>Cus.Name</th>
                                    <th>Method</th>
                                    <th>Status</th>
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
                                    $rows_per_page = 6;
                                    $start = ($page_no - 1) * $rows_per_page ;
                                    //Get all the orders from database
                                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT {$start}, {$rows_per_page} "; // DIsplay the Latest Order at First
                                    //Execute Query
                                    $res = mysqli_query($conn, $sql);
                                    //Count the Rows
                                    $count = mysqli_num_rows($res);

                                    // get total number of rows
                                    $total_rows_sql = "SELECT COUNT(*) AS total_rows FROM tbl_order";
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
                                        //Order Available
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //Get all the order details
                                            $id = $row['id'];
                                            $product = $row['product'];
                                            $qty = $row['qty'];
                                            $total = $row['total'];
                                            $order_date = $row['order_date'];
                                            $customer_name = $row['customer_name'];
                                            $payment_method = $row['payment_method'];
                                            $status = $row['status']; 
                                            
                                ?>

                                <tr>
                                    <td>OID<?php echo $id; ?></td>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $payment_method; ?></td>
                                    <td>
                                        <?php 
                                            // Ordered, On Delivery, Delivered, Cancelled

                                            if($status=="Ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="On Delivery")
                                            {
                                                echo "<label style='color: orange;'>$status</label>";
                                            }
                                            elseif($status=="Delivered")
                                            {
                                                echo "<label style='color: green;'>$status</label>";
                                            }
                                            elseif($status=="Cancelled")
                                            {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>"><span class="material-icons-sharp edit">edit</span></a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                        }
                                        else
                                        {
                                        //Order not Available
                                        echo "<tr><td colspan='9' class='danger'>Orders not Available</td></tr>";
                                        }
                                    ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- pagination  -->
                    <div class="table-pagination">
                        <!-- first page  -->
                        <a href="<?php echo SITEURL; ?>admin/manage-order.php?page=1">First</a>
                        <!-- previous page  -->
                        <?php 
                            if($page_no <= 1){
                                ?>
                                    <a class="arrow"><span class="material-icons-sharp">west</span></a>
                                <?php
                            }else{
                                $prev_page_no = $page_no - 1;
                                ?>
                                    <a class="arrow" href="<?php echo SITEURL; ?>admin/manage-order.php?page=<?php echo $prev_page_no; ?>"><span class="material-icons-sharp">west</span></a>
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
                                    <a class="arrow" href="<?php echo SITEURL; ?>admin/manage-order.php?page=<?php echo $next_page_no; ?>"><span class="material-icons-sharp">east</span></a>
                                <?php
                            }
                        ?>
                        <!-- last page  -->
                        <a href="<?php echo SITEURL; ?>admin/manage-order.php?page=<?php echo $last_page_no; ?>">Last</a>
                    </div>

                </div>

            </div>

    
<?php include('partials/footer.php'); ?>