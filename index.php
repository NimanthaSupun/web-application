<?php include('partials-front/menu.php'); ?>

        <div class="row" >
            
            <div class="col-2">
                <h1 style="color: aliceblue;">Buy All Your Sports Wear<br> In One Place!</h1>
                <p style="color: aliceblue;"> Lorem ipsum dolor sit amet consectetur adipisicing elit.Ullam animi<br>omnis ab illum, at repellendus.</p>
                <a href="shop.php" class="btn">Explore Now &#8594;</a>
            </div>

            <div class="col-2">
                <img src="images/image1.png">
            </div>
        </div>
    </div>
</div>

<!-- categories -->
<div class="categories">
    <div class="small-container">

        <div class="row">
            <?php
            
                //create SQL Query to display categories from data base
                $sql = "SELECT * FROM tbl_category WHERE featured='yes' AND active='yes' LIMIT 3";
                //execute the query 
                $res = mysqli_query($conn, $sql);
                //count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Category Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id , title, image name
                        $id = $row['id'];
                        $title = $row['title'];
                        $sub_title=$row['sub_title'];
                        $image = $row['image'];

            ?>

            <div class="col-3" onclick="window.location.href='<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $id; ?>'">
                <div>
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
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image; ?>">
                            <?php
                        }
                    ?>
                </div>
                <div class="ca-text">
                        <h5><?php echo $title; ?></h5>
                    </div>

            </div>

                    <?php
                        }
                    }
                    else
                    {
                        //category not Available
                        echo "<div class='danger'>Category not Available</div>";
                    }
                
                ?>
        </div>


    </div> 
</div>

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

    <h2 class="title">Latest Products</h2>
        <div class="row">
            <?php

            //getting products from database that are latest 
            $sql3 = "SELECT * FROM tbl_product WHERE active='yes' ORDER BY id DESC LIMIT 8";

            //execute the query
            $res3 = mysqli_query($conn, $sql3);
            //count rows to check whether the product is available or not
            $count3 = mysqli_num_rows($res3);

            //check whether product available or not
            if($count3>0)
            {
                //product Available
                while($row=mysqli_fetch_assoc($res3))
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
  

<!-- Offer -->
<div class="offer">
    <div class="small-container">
        <div class="row">
            <div class="col-2">
                <img src="images/exclusive.png" class="offer-img">
            </div>
            <div class="col-2">
            <p>Exclusively Available on RedStore</p>
            <h1>Smart Band 4</h1>
            <small>The Mi Smart Band 4 features a 39.9% larger
            (than mi band 3) AMOLED color full-touch display width 
            adjustable brightness, so everything is clear as can 
            be.</small><br>
            <a href="" class="btn">Buy Now &#8594;</a>
            </div>
        </div>
    </div>
</div>
<!-- testimonial -->
<div class="testimonial">
    <div class="small-container">
        <div class="row">
           <div class="col-3">
           <span class="material-icons-outlined">person</span>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, iste hic? Exercitationem saepe, 
                provident distinctio delectus ipsum tempora officiis? Reprehenderit nihil praesentium aliquid animi 
                vitae amet quas eligendi corporis aliquam.</p>
                <div class="star">
                    <span class="material-icons-outlined">star</span>
                    <span class="material-icons-outlined">star</span>
                    <span class="material-icons-outlined">star</span>
                    <span class="material-icons-outlined">star</span>
                    <span class="material-icons-outlined">star</span>
                </div>
                <img
                src="images/user-1.png">
                <h3>Sean </h3>
             </div>  

             <div class="col-3">
             <span class="material-icons-outlined">person</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, iste hic? Exercitationem saepe, 
                    provident distinctio delectus ipsum tempora officiis? Reprehenderit nihil praesentium aliquid animi 
                    vitae amet quas eligendi corporis aliquam.</p>
                    <div class="star">
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                    </div>
                    <img
                    src="images/user-2.png">
                    <h3>Sean </h3>
                 </div> 
                 <div class="col-3">
                 <span class="material-icons-outlined">person</span>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, iste hic? Exercitationem saepe, 
                        provident distinctio delectus ipsum tempora officiis? Reprehenderit nihil praesentium aliquid animi 
                        vitae amet quas eligendi corporis aliquam.</p>
                        <div class="star">
                            <span class="material-icons-outlined">star</span>
                            <span class="material-icons-outlined">star</span>
                            <span class="material-icons-outlined">star</span>
                            <span class="material-icons-outlined">star</span>
                            <span class="material-icons-outlined">star</span>
                        </div>
                        <img
                        src="images/user-3.png">
                        <h3>Sean </h3>
             </div>   
        </div>
    </div>
</div>
<!-- Brands -->
<div class="brands">
    <div class="small-container">
        <div class="row">
            <div class="col-5">
                <img src="images/Yonex logo 2.png">
            </div>
            <div class="col-5">
                <img src="images/Nike logo.png">
            </div>
            <div class="col-5">
                <img src="images/adidas-logo.png">
            </div>
            <div class="col-5">
                <img src="images/kookaburra logo.png">
            </div>
            <div class="col-5">
                <img src="images/puma logo.png">
            </div>
        </div>
    </div>
</div>



<?php include('partials-front/footer.php'); ?>