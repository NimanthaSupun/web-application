<?php include('partials/dashboard-menu.php'); ?>

        <!-- MAIN SECTION STARTS HERE  -->
        <main>
            <h1>Dashboard</h1>

            <div class="insights">

                <!-- ====products==== -->
                <?php
                    //sql query
                    $sql = "SELECT * FROM tbl_product";
                    //execute query
                    $res = mysqli_query($conn, $sql);
                    //count rows
                    $count = mysqli_num_rows($res);
                ?>

                <div class="product" onclick="window.location.href='<?php echo SITEURL; ?>admin/manage-products.php'">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">

                        <div class="left">
                            <h2>products</h2>
                            <h3>Add product</h3>
                        </div>

                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <h3><?php echo $count; ?></h3>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted ">Last 24 Hours</small>
                </div>

                <!-- ====category==== -->
                <?php
                    //sql query
                    $sql2 = "SELECT * FROM tbl_category";
                    //execute query
                    $res2 = mysqli_query($conn, $sql2);
                    //count rows
                    $count2 = mysqli_num_rows($res2);
                ?>

                <div class="category" onclick="window.location.href='<?php echo SITEURL; ?>admin/manage-category.php'"> 
                    <span class="material-icons-sharp">bar_chart</span>
                    <div class="middle">

                        <div class="left">
                            <h2>Category</h2>
                            <h3>Add Category</h3>
                        </div>

                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <h3><?php echo $count2; ?></h3>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted ">Last 24 Hours</small>
                </div>

                <!-- ====income==== -->
                <div class="income">
                    <?php 
                            //Creat SQL Query to Get Total Revenue Generated
                            //Aggregate Function in SQL
                            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                            //Execute the Query
                            $res4 = mysqli_query($conn, $sql4);

                            //Get the VAlue
                            $row4 = mysqli_fetch_assoc($res4);
                            
                            //GEt the Total REvenue
                            $total_revenue = $row4['Total'];

                        ?>
                    <span class="material-icons-sharp">stacked_line_chart</span>
                    <div class="middle income-card">
                        <div class="left">
                            <h2>$<?php echo $total_revenue; ?></h2>
                            <h3>Total Income</h3>
                        </div>

                    </div>
                    <small class="text-muted ">Last 24 Hours</small>
                </div>

            </div>

            <!-- recent orders  -->
            <div class="recent-orders" >
                <h2>Recent orders</h2>
                <table>
                    <thead>
                        <th>Order</th>
                        <th>Produuct</th>
                        <th>Total</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                    <?php
                        //Get all the orders from database
                        $sql3 = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT 4"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count the Rows
                        $count3 = mysqli_num_rows($res3);

                        if($count3>0)
                        {
                            //Order Available
                            while($row3=mysqli_fetch_assoc($res3))
                            {
                                //Get all the order details
                                $id = $row3['id'];
                                $product = $row3['product'];
                                $total = $row3['total'];
                                $payment_method = $row3['payment_method'];
                                $status = $row3['status']; 
                                
                    ?>

                        <tr>
                            <td>OID<?php echo $id; ?></td>
                            <td><?php echo $product; ?></td>
                            <td><?php echo $total; ?></td>
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

                <a href="<?php echo SITEURL; ?>admin/manage-order.php">Show All</a>
            </div>
 
        </main>
        <!-- MAIN SECTION ENDS HERE  -->


        <!-- RIGHT SSECTION STARTS HERE  -->
        <div class="right">

            <!-- ==== top ==== -->
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Nimantha</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="profile-default.png" alt="">
                    </div>
                </div>
            </div>
            

            <!-- ==== Recent Updates ==== -->
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">

                    <div class="update">
                        <div class="profile-photo">
                            <img src="profile-default.png" alt="">
                        </div>
                        <div class="message">
                            <p><b>John Ferdo</b> received his order of asus tuf f15 gaming laptop</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>

                    <div class="update">
                        <div class="profile-photo">
                            <img src="profile-default.png" alt="">
                        </div>
                        <div class="message">
                            <p><b>John Ferdo</b> received his order of asus tuf f15 gaming laptop</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                        
                    </div>

                    <div class="update">
                        <div class="profile-photo">
                            <img src="profile-default.png" alt="">
                        </div>
                        <div class="message">
                            <p><b>John Ferdo</b> received his order of asus tuf f15 gaming laptop</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                        
                    </div>

                </div>
            </div>


            <!-- === sales Analytics === -->
            <div class="sales-analytics">
                <h2>Salse Analytics</h2>

                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">shopping_cart</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>ONLINE ORDERS</h3>
                            <small class="text-muted">last 24 Hours</small>
                        </div>
                        <h5 class="success">+37%</h5>
                        <h3>3849</h3>
                    </div>
                </div>

                <div class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp">local_mall</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>OFFLINE ORDERS</h3>
                            <small class="text-muted">last 24 Hours</small>
                        </div>
                        <h5 class="danger">-27%</h5>
                        <h3>1599</h3>
                    </div>
                </div>

                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">person</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>NEW CUSTOMERS</h3>
                            <small class="text-muted">last 24 Hours</small>
                        </div>
                        <h5 class="success">+30%</h5>
                        <h3>144</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>
    

<?php include('partials/footer.php'); ?>