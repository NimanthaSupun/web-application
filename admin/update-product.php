<?php 
ob_start();
include('partials/menu.php'); 
?>

            <!-- add products form starts here -->
            <div class="form-container">
                <h2>Edit product</h2>
                <p>Edit through below fields </p>
                <?php 
                    //check whether the id set or not
                    if(isset($_GET['id']))
                    {
                        //get all the details
                        $id = $_GET['id'];

                        //SQL query to get the selected products
                        $sql2 = "SELECT * FROM tbl_product WHERE id=$id";
                        //execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //get the value based on query executed
                        $row2 = mysqli_fetch_assoc($res2);

                        //get the individual values of selected products
                        $title = $row2['title'];
                        $sub_title = $row2['sub_title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $discount = $row2['discount'];
                        $current_image1 = $row2['image1'];
                        $current_image2 = $row2['image2'];
                        $current_image3 = $row2['image3'];
                        $current_image4 = $row2['image4'];
                        $current_category = $row2['category_id'];
                        $featured = $row2['featured'];
                        $active = $row2['active'];

                    }
                    else
                    {   
                        //redirect to manage products page
                        header('location:'.SITEURL.'admin/manage-products.php');
                        
                        
                    }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="<?php echo $title; ?>" id="title" placeholder="Product Title" required>
                        </div>
                        <div class="column">
                            <label for="sub-title">Sub Title</label>
                            <input type="text" name="sub_title" value="<?php echo $sub_title; ?>" id="sub-title" placeholder="Product sub title">
                        </div>  
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="price">Price</label>
                            <input type="number" name="price" value="<?php echo $price; ?>" id="price" placeholder="Product Price" required>
                        </div>

                        <div class="column">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" value="<?php echo $discount; ?>" id="discount" placeholder="Discount Price">
                        </div>  
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="active">Active</label>
                            <label for=""><input type="radio" <?php if($active=="yes"){echo "checked";} ?>  name="active" id="active" value="yes">Yes</label>
                            <label for=""><input type="radio" <?php if($active=="no"){echo "checked";} ?>  name="active" id="active" value="no">No</label>
                        </div>

                        <div class="column">
                            <label for="featured">Featured</label>
                            <label for=""><input type="radio" <?php if($featured=="yes"){echo "checked";} ?> name="featured" id="featured" value="yes">Yes</label>
                            <label for=""><input type="radio" <?php if($featured=="no"){echo "checked";} ?> name="featured" id="featured" value="no">No</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="category">Category</label>
                            <select name="category" id="category">

                                <option value="0">Select Category 🡇</option>
                                <?php
                                    //query to get active categories
                                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                                    //execute the query
                                    $res = mysqli_query($conn, $sql);

                                    //count rows
                                    $count = mysqli_num_rows($res);

                                    //check whether the category available or not
                                    if($count>0)
                                    {
                                        //category available
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];
                                            
                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //category not available
                                        echo "<option value='0'>Category not Available</option>";
                                    }

                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" placeholder="Product Description"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                    <!-- //image upload  -->
                    <label for="product-images">Procuct Images</label>
                    <div class="row">
                       <div class="img-column">

                        <div class="column">
                            <div class="form-element">
                                <input type="file" name="image1" id="file-1" accept="image/*">
                                <label for="file-1" id="file-1-preview">
                                <?php
                                    if($current_image1=="")
                                    {
                                        //image not available
                                        ?>
                                        <img src="Transparent.png" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image1; ?>" >
                                        <?php
                                    }
                                 ?>
                                  <div>
                                    <span>+</span>
                                  </div>
                                </label>
                            </div>
                        </div>

                        <div class="column">
                            <div class="form-element">
                                <input type="file" name="image2" id="file-2" accept="image/*">
                                <label for="file-2" id="file-2-preview">
                                <?php
                                    if($current_image2=="")
                                    {
                                        //image not available
                                        ?>
                                        <img src="Transparent.png" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image2; ?>" >
                                        <?php
                                    }
                                 ?>
                                  <div>
                                    <span>+</span>
                                  </div>
                                </label>
                              </div>
                        </div>

                        <div class="column">
                            <div class="form-element">
                                <input type="file" name="image3" id="file-3" accept="image/*">
                                <label for="file-3" id="file-3-preview">
                                <?php
                                    if($current_image3=="")
                                    {
                                        //image not available
                                        ?>
                                        <img src="Transparent.png" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image3; ?>" >
                                        <?php
                                    }
                                 ?>
                                  <div>
                                    <span>+</span>
                                  </div>
                                </label>
                              </div>
                        </div>

                        <div class="column">
                            <div class="form-element">
                                <input type="file" name="image4" id="file-4" accept="image/*">
                                <label for="file-4" id="file-4-preview">
                                <?php
                                    if($current_image4=="")
                                    {
                                        //image not available
                                        ?>
                                        <img src="Transparent.png" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image4; ?>" >
                                        <?php
                                    }
                                 ?>
                                  <div>
                                    <span>+</span>
                                  </div>
                                </label>
                              </div>
                        </div>
                      </div>
                   </div>

                   <div class="row">
                    <div class="column">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image1" value="<?php echo $current_image1; ?>">
                        <input type="hidden" name="current_image2" value="<?php echo $current_image2; ?>">
                        <input type="hidden" name="current_image3" value="<?php echo $current_image3; ?>">
                        <input type="hidden" name="current_image4" value="<?php echo $current_image4; ?>">
                        <input class="submit" type="submit" name="submit" value="Save Chages">
                    </div>
                  </div>
                    
                </form>


                <?php

                    if(isset($_POST['submit']))
                    {
                        //1. get all the details from the form
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $sub_title = $_POST['sub_title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        // Check if discount is set, if not, set it to 0
                        if(isset($_POST['discount']) && $_POST['discount'] !== '') {
                            $discount = $_POST['discount'];
                        } else {
                            $discount = 0;
                        }
                        $current_image1 = $_POST['current_image1'];
                        $current_image2 = $_POST['current_image2'];
                        $current_image3 = $_POST['current_image3'];
                        $current_image4 = $_POST['current_image4'];
                        $category = $_POST['category'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];
                        //2. upload the images if selected

                        //check whether the image1 is selected or not
                        if(isset($_FILES['image1']['name']))
                        {
                            //get the image1 details
                            $image1 = $_FILES['image1']['name'];

                            //check whether the image1 is avaliable or not
                            if($image1 != "")
                            {
                                //image1 avaliable

                                // A.upload the new image1

                                //auto rename our image1
                                //get the exetention of out image1(jpg, png, gif, etc) e.g. product1.jpg
                                $ext = end(explode('.',$image1));
                                //rename the image1
                                $image1 ="product_".rand(000, 999).'.'.$ext; //e.g. product_875.jpg

                                $source_path =$_FILES['image1']['tmp_name']; 

                                $destination_path ="../images/product/".$image1;

                                //finally upload the image1
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //check whether the image1 is uploaded or not
                                //and if the image1 is not uploaded then we will stop the process and redirect with error message
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload']="<div class='danger'>Failed to upload image1</div>";
                                    //redirect to add product page
                                    header('location:'.SITEURL.'admin/manage-products.php');
                                    //stop the process
                                    die();   
                                }

                                // B.remove the current image1 if avaliable
                                if($current_image1 !="")
                                {
                                    $remove_path = "../images/product/".$current_image1;
                                    $remove = unlink($remove_path);
                
                                    //check whether the image1 is removed or not
                                    //if failed to remove display message and stop the process
                                    if($remove==false)
                                    {
                                        //Failed to remove the image1
                                        $_SESSION['failed-remove']="<div class='danger'>Failed to remove current image1</div>";
                                        header('location:'.SITEURL.'admin/manage-products.php');
                                        die();//stop the process
                                    }
                                }
                            
                            }
                            else
                            {
                                $image1 = $current_image1;
                            }
                        }
                        else
                        {
                            $image1 = $current_image1;
                        }


                         //check whether the image2 is selected or not
                         if(isset($_FILES['image2']['name']))
                         {
                             //get the image2 details
                             $image2 = $_FILES['image2']['name'];
 
                             //check whether the image2 is avaliable or not
                             if($image2 != "")
                             {
                                 //image2 avaliable
 
                                 // A.upload the new image2
 
                                 //auto rename our image2
                                 //get the exetention of out image2(jpg, png, gif, etc) e.g. product1.jpg
                                 $ext = end(explode('.',$image2));
                                 //rename the image2
                                 $image2 ="product_".rand(000, 999).'.'.$ext; //e.g. product_875.jpg
 
                                 $source_path =$_FILES['image2']['tmp_name']; 
 
                                 $destination_path ="../images/product/".$image2;
 
                                 //finally upload the image2
                                 $upload = move_uploaded_file($source_path, $destination_path);
 
                                 //check whether the image2 is uploaded or not
                                 //and if the image2 is not uploaded then we will stop the process and redirect with error message
                                 if($upload==false)
                                 {
                                     //set message
                                     $_SESSION['upload']="<div class='danger'>Failed to upload image2</div>";
                                     //redirect to add product page
                                     header('location:'.SITEURL.'admin/manage-products.php');
                                     //stop the process
                                     die();   
                                 }
 
                                 // B.remove the current image2 if avaliable
                                 if($current_image2 !="")
                                 {
                                     $remove_path = "../images/product/".$current_image2;
                                     $remove = unlink($remove_path);
                 
                                     //check whether the image2 is removed or not
                                     //if failed to remove display message and stop the process
                                     if($remove==false)
                                     {
                                         //Failed to remove the image2
                                         $_SESSION['failed-remove']="<div class='danger'>Failed to remove current image2</div>";
                                         header('location:'.SITEURL.'admin/manage-products.php');
                                         die();//stop the process
                                     }
                                 }
                             
                             }
                             else
                             {
                                 $image2 = $current_image2;
                             }
                         }
                         else
                         {
                             $image2 = $current_image2;
                         }


                          //check whether the image3 is selected or not
                        if(isset($_FILES['image3']['name']))
                        {
                            //get the image3 details
                            $image3 = $_FILES['image3']['name'];

                            //check whether the image3 is avaliable or not
                            if($image3 != "")
                            {
                                //image3 avaliable

                                // A.upload the new image3

                                //auto rename our image3
                                //get the exetention of out image3(jpg, png, gif, etc) e.g. product1.jpg
                                $ext = end(explode('.',$image3));
                                //rename the image3
                                $image3 ="product_".rand(000, 999).'.'.$ext; //e.g. product_875.jpg

                                $source_path =$_FILES['image3']['tmp_name']; 

                                $destination_path ="../images/product/".$image3;

                                //finally upload the image3
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //check whether the image3 is uploaded or not
                                //and if the image3 is not uploaded then we will stop the process and redirect with error message
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload']="<div class='danger'>Failed to upload image3</div>";
                                    //redirect to add product page
                                    header('location:'.SITEURL.'admin/manage-products.php');
                                    //stop the process
                                    die();   
                                }

                                // B.remove the current image3 if avaliable
                                if($current_image3 !="")
                                {
                                    $remove_path = "../images/product/".$current_image3;
                                    $remove = unlink($remove_path);
                
                                    //check whether the image3 is removed or not
                                    //if failed to remove display message and stop the process
                                    if($remove==false)
                                    {
                                        //Failed to remove the image3
                                        $_SESSION['failed-remove']="<div class='danger'>Failed to remove current image3</div>";
                                        header('location:'.SITEURL.'admin/manage-products.php');
                                        die();//stop the process
                                    }
                                }
                            
                            }
                            else
                            {
                                $image3 = $current_image3;
                            }
                        }
                        else
                        {
                            $image3 = $current_image3;
                        }


                         //check whether the image4 is selected or not
                         if(isset($_FILES['image4']['name']))
                         {
                             //get the image4 details
                             $image4 = $_FILES['image4']['name'];
 
                             //check whether the image4 is avaliable or not
                             if($image4 != "")
                             {
                                 //image4 avaliable
 
                                 // A.upload the new image4
 
                                 //auto rename our image4
                                 //get the exetention of out image4(jpg, png, gif, etc) e.g. product1.jpg
                                 $ext = end(explode('.',$image4));
                                 //rename the image4
                                 $image4 ="product_".rand(000, 999).'.'.$ext; //e.g. product_875.jpg
 
                                 $source_path =$_FILES['image4']['tmp_name']; 
 
                                 $destination_path ="../images/product/".$image4;
 
                                 //finally upload the image4
                                 $upload = move_uploaded_file($source_path, $destination_path);
 
                                 //check whether the image4 is uploaded or not
                                 //and if the image4 is not uploaded then we will stop the process and redirect with error message
                                 if($upload==false)
                                 {
                                     //set message
                                     $_SESSION['upload']="<div class='danger'>Failed to upload image4</div>";
                                     //redirect to add product page
                                     header('location:'.SITEURL.'admin/manage-products.php');
                                     //stop the process
                                     die();   
                                 }
 
                                 // B.remove the current image4 if avaliable
                                 if($current_image4 !="")
                                 {
                                     $remove_path = "../images/product/".$current_image4;
                                     $remove = unlink($remove_path);
                 
                                     //check whether the image4 is removed or not
                                     //if failed to remove display message and stop the process
                                     if($remove==false)
                                     {
                                         //Failed to remove the image4
                                         $_SESSION['failed-remove']="<div class='danger'>Failed to remove current image4</div>";
                                         header('location:'.SITEURL.'admin/manage-products.php');
                                         die();//stop the process
                                     }
                                 }
                             
                             }
                             else
                             {
                                 $image4 = $current_image4;
                             }
                         }
                         else
                         {
                             $image4 = $current_image4;
                         }


                        //4. update the product in database
                        $sql3 = "UPDATE tbl_product SET
                            title = '$title',
                            sub_title = '$sub_title',
                            description = '$description',
                            price = $price,
                            discount = $discount,
                            image1 = '$image1',
                            image2 = '$image2',
                            image3 = '$image3',
                            image4 = '$image4',
                            category_id = '$category',
                            featured = '$featured',
                            active = '$active'
                            WHERE id = $id
                        ";

                        //execute the SQL query
                        $res3 = mysqli_query($conn, $sql3);

                        // 5. redirect to manage product with session message
                        // check whether the query is executed or not 
                        if($res3==true)
                        {
                            //query executed and product updated
                            $_SESSION['update'] = "<div class='success'>product Updated Succsessfully</div>";
                            header('location:'.SITEURL.'admin/manage-products.php');
                        }
                        else
                        {
                            //failed to update product
                            $_SESSION['update'] = "<div class='danger'>Failed to Update product</div>";
                            header('location:'.SITEURL.'admin/manage-products.php');
                        }

                        
                    }
                    ob_end_flush();
                ?>

        </div>

    </div>
    

<?php include('partials/footer.php'); ?>