<?php include('partials-front/menu.php'); ?>
    </div>
</div>

    <!-- ==========Single product========== -->
    <section id="prodetails" class="section-p1">


            <?php
                
                //check whether the id is set or not
                if(isset($_GET['product_id']))
                {
                    //get the id and other details
                    $id = $_GET['product_id'];
                    //create sql query to get all other details
                    $sql = "SELECT * FROM tbl_product WHERE id=$id";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the rows to check whether the id is valid or not
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $sub_title = $row['sub_title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image1 = $row['image1'];
                        $image2 = $row['image2'];
                        $image3 = $row['image3'];
                        $image4 = $row['image4'];
                    }
                    else
                    {
                        //redirect to manage product with session message
                        // $_SESSION['no-product-found'] = "<div class='danger'>product not Found</div>";
                        //redirect to manage product
                        header('location:'.SITEURL.'index.php');
                    }
                }
                else
                {
                    //redirect to manage product
                    header('location:'.SITEURL.'index.php');
                }

            ?>


        <div class="single-pro-image">
            
            <div class="main-img-group">
                <?php
                    //check whether image available or not
                    if($image1=="")
                    {
                        //image not available
                        echo "<div class='error'>Image not available</div>";
                    }
                    else
                    {
                        //image available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $image1; ?>" id="MainImg" class="main-image">
                        <?php
                    }
                ?>
            </div>
            
            <div class="small-img-group">
                <div class="small-img-col">
                <?php
                    //check whether image available or not
                    if($image1=="")
                    {
                        //image not available
                        // echo "<div class='error'>Image not available</div>";
                    }
                    else
                    {
                        //image available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $image1; ?>" class="small-img">
                        <?php
                    }
                ?>
                </div>

                <div class="small-img-col">
                    <?php
                        //check whether image available or not
                        if($image2=="")
                        {
                            //image not available
                            // echo "<div class='error'>Image not available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/product/<?php echo $image2; ?>" class="small-img">
                            <?php
                        }
                    ?>
                </div>

                <div class="small-img-col">
                    <?php
                            //check whether image available or not
                            if($image3=="")
                            {
                                //image not available
                                // echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image3; ?>" class="small-img">
                                <?php
                            }
                        ?>
                </div>

                <div class="small-img-col">
                    <?php
                            //check whether image available or not
                            if($image4=="")
                            {
                                //image not available
                                // echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image4; ?>" class="small-img">
                                <?php
                            }
                        ?>
                </div>
            </div>
        </div>

        <div class="single-pro-details">
            <div class="product-details">
                <h6><?php echo $sub_title; ?></h6>
                <h4><?php echo $title; ?></h4>
                <h2>$<?php echo $price; ?></h2>
                <select id="size">
                    <option value="">Select Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select>
                <button class="normal submit-btn">Add to Cart</button>
                <button class="normal submit-btn" onclick="addToCart(<?php echo $id; ?>, '<?php echo $title; ?>', <?php echo $price; ?>)">Buy Now</button>
            </div>

            <div class="product-des">
                <h4>Product Details</h4>
                <span><?php echo $description; ?></span>
            </div>
        </div>


        

    </section>

    <!-- ==========featured producst========== -->
     <!-- product -->
<div class="small-container">
    <h2 class="title">Featured Products</h2>
    
    <div class="row">
        <?php

            //getting products from database that are active and featured
            $sql2 = "SELECT * FROM tbl_product WHERE active='yes' AND featured='yes' LIMIT 4";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count rows to check whether the product is available or not
            $count2 = mysqli_num_rows($res2);

            //check whether product available or not
            if($count2>0)
            {
                //product Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values
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
            echo "<div class='danger'>Featured products not Available</div>";
            }

        ?>
    </div>
</div>
  



    <script>
        // Function to add product to cart
        function addToCart(productId, productName, productPrice) {
            var size = document.getElementById("size").value;
            // var qty = document.getElementById("quantity").innerText;
            var url = "<?php echo SITEURL; ?>buynow.php?product_id=" + productId + "&size=" + size  + "&title=" + productName + "&price=" + productPrice;
            window.location.href = url;
        }

        //function tho change images
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function(){
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function(){
            MainImg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function(){
            MainImg.src = smallimg[3].src;
        }
    </script>

<?php include('partials-front/footer.php'); ?>

