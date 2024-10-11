<?php include('partials-front/menu.php'); ?>
    </div>
</div>

    <?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //get the category title based on category ID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the query
        $res = mysqli_query($conn, $sql);
        
        //get the value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }
    ?>

    <!-- ==========hero========== -->
    <section id="page-header">
        <h2>Super Value Deals</h2>
        <h3><?php echo $category_title; ?></h3>
        <p>Save more with coupons & up to 70% off!</p>
    </section>
    
        <!-- ==========products========== -->

        <div class="small-container">   
            <div class="row">

                <?php
                    //get the page number
                    if(isset($_GET['page'])) {
                        $page_no = $_GET['page'];
                    }
                    else{
                        $page_no = 1;
                    }
                    //rows per page
                    $rows_per_page = 16;
                    $start = ($page_no - 1) * $rows_per_page ;

                    //display product that are active
                    $sql = "SELECT * FROM tbl_product WHERE active = 'yes' AND category_id=$category_id LIMIT {$start}, {$rows_per_page}";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                    // get total number of rows
                    $total_rows_sql = "SELECT COUNT(*) AS total_rows FROM tbl_product WHERE active = 'yes' AND category_id = $category_id";
                    $total_rows_result = mysqli_query($conn, $total_rows_sql);
                    $total_rows_data = mysqli_fetch_assoc($total_rows_result);
                    $total_rows = $total_rows_data['total_rows'];

                    //last page number
                    $last_page_no = ceil($total_rows/$rows_per_page);

                    //check whether the product are available or not
                    if($count>0)
                    {
                        //product Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the values
                            $id=$row['id'];
                            $title=$row['title'];
                            $sub_title=$row['sub_title'];
                            $price=$row['price'];
                            $image=$row['image1'];

                ?>

                    <div class="col-4" onclick="window.location.href='<?php echo SITEURL; ?>sproduct.php?product_id=<?php echo $id; ?>'">
                        <div class="pro-img">
                            <?php
                                //check whether image available or not
                                if($image=="")
                                {
                                    //image not available
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $image; ?>">
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="des">
                            <h5><?php echo $title; ?></h5>
                            <div class="star">
                                <span class="material-icons-outlined">star</span>
                                <span class="material-icons-outlined">star</span>
                                <span class="material-icons-outlined">star</span>
                                <span class="material-icons-outlined">star</span>
                                <span class="material-icons-outlined">star</span>
                            </div>
                            <h4>$<?php echo $price; ?></h4>
                        </div>

                    </div> 
                    
                    <?php

                    }
                }
                else
                {
                    //product not available
                    echo "<div class='danger'>Products not found</div>";
                }
                ?>
                    
            </div>
        </div>


        <!-- ==========pagination========== -->
        <section id="pagination">

            <!-- first page  -->
            <a class="first_" href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $category_id; ?>&page=1">First</a>
            <!-- previous page  -->
            <?php 
                if($page_no <= 1){
                    ?>
                         <a><span class="material-icons-outlined">west</span></a>
                    <?php
                }else{
                    $prev_page_no = $page_no - 1;
                    ?>
                        <a href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $category_id; ?>&page=<?php echo $prev_page_no; ?>"><span class="material-icons-outlined">west</span></a>
                    <?php
                }
            ?>

                <!-- display current page number over all pages -->
            <a class="muted">Page <?php echo $page_no; ?> of <?php echo $last_page_no; ?></a>

            <!-- next page  -->
            <?php 
                if($page_no >= $last_page_no){
                    ?>
                         <a><span class="material-icons-outlined">east</span></a>
                    <?php
                }else{
                    $next_page_no = $page_no + 1;
                    ?>
                        <a href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $category_id; ?>&page=<?php echo $next_page_no; ?>"><span class="material-icons-outlined">east</span></a>
                    <?php
                }
            ?>
            <!-- last page  -->
            <a class="last_" href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $category_id; ?>&page=<?php echo $last_page_no; ?>">Last</a>

        </section>


<?php include('partials-front/footer.php'); ?>  