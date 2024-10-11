<?php 
ob_start();
include('partials/menu.php'); 
?>
            <!-- add products form starts here -->
            <div class="form-container">
                <h2>Add product</h2>
                <p>Fill all the required fields below</p>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Product Title" required>
                        </div>
                        <div class="column">
                            <label for="sub-title">Sub Title</label>
                            <input type="text" name="sub_title" id="sub-title" placeholder="Product sub title">
                        </div>  
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="price">Price</label>
                            <input type="number" name="price"  min="0" id="price" placeholder="Product Price" required>
                        </div>

                        <div class="column">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount"  min="0"  id="discount" placeholder="Discount Price">
                        </div>  
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="active">Active</label>
                            <label for=""><input type="radio" name="active" id="active" value="yes">Yes</label>
                            <label for=""><input type="radio" name="active" id="active" value="no">No</label>
                        </div>

                        <div class="column">
                            <label for="active">Featured</label>
                            <label for=""><input type="radio" name="featured" id="featured" value="yes">Yes</label>
                            <label for=""><input type="radio" name="featured" id="featured" value="no">No</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="category">Category</label>
                            <select name="category" id="category">

                                <option value="0">Select Category 🡇</option>
                                
                            <?php
                                //create PHP code to display categories from database
                                //1.Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                                //Executing Query
                                $res = mysqli_query($conn, $sql);

                                //Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //If count is greater than zero we have categories else we dont have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                         <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //we dont have categories
                                    ?>
                                         <option value="0">No Category found</option>
                                    <?php
                                }

                                //2.Display on dropdown
                            ?>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" placeholder="Product Description"></textarea>
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
                                  <img src="transparent.png" alt="">
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
                                    <img src="transparent.png" alt="">
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
                                    <img src="transparent.png" alt="">
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
                                    <img src="transparent.png" alt="">
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
                        <input class="submit" type="submit" name="submit" value="Add Product">
                    </div>
                </div>
                    

            </form>


            <?php

            //check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the product in database
                
                //1. get the data from form
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
                $category = $_POST['category'];
                //check whether the radio buttons are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "no";//settin default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "yes";//setting default value
                }


                //2. upload imagees if selected

                //image1 = main image
                //check whether the select image is clicked or not and upload the image only if selected
                if(isset($_FILES['image1']['name']))
                {
                    //get the details of the selected image
                    $image1 = $_FILES['image1']['name'];

                    //check whether the image is selected or not
                    if($image1 != "")
                    {
                        //image is selected
                        //A. rename the image
                        //get the extention of selected image
                        // $ext = end(explode('.',$image1));
                        $exploded = explode('.', $image1);
                        $ext = end($exploded);


                        //create new name for image
                        $image1 = "product_".rand(0000, 9999).".".$ext; 

                        //B. upload the image
                        //ext the source path and destination path

                        //source path is the current location of the image
                        $src = $_FILES['image1']['tmp_name'];

                        //destination path for the image to be uploaded
                        $dst = "../images/product/".$image1;

                        //finally upload the product image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image
                            //redirect to add product page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>" ;
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image1= "";//settin default value as blank
                }

                //image2
                //check whether the select image is clicked or not and upload the image only if selected
                if(isset($_FILES['image2']['name']))
                {
                    //get the details of the selected image
                    $image2 = $_FILES['image2']['name'];

                    //check whether the image is selected or not
                    if($image2 != "")
                    {
                        //image is selected
                        //A. rename the image
                        //get the extention of selected image
                        $ext = end(explode('.',$image2));

                        //create new name for image
                        $image2 = "product_".rand(0000, 9999).".".$ext; 

                        //B. upload the image
                        //ext the source path and destination path

                        //source path is the current location of the image
                        $src = $_FILES['image2']['tmp_name'];

                        //destination path for the image to be uploaded
                        $dst = "../images/product/".$image2;

                        //finally upload the product image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image
                            //redirect to add product page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>" ;
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image2= "";//settin default value as blank
                }


                //image3
                //check whether the select image is clicked or not and upload the image only if selected
                if(isset($_FILES['image3']['name']))
                {
                    //get the details of the selected image
                    $image3 = $_FILES['image3']['name'];

                    //check whether the image is selected or not
                    if($image3 != "")
                    {
                        //image is selected
                        //A. rename the image
                        //get the extention of selected image
                        $ext = end(explode('.',$image3));

                        //create new name for image
                        $image3 = "product_".rand(0000, 9999).".".$ext; 

                        //B. upload the image
                        //ext the source path and destination path

                        //source path is the current location of the image
                        $src = $_FILES['image3']['tmp_name'];

                        //destination path for the image to be uploaded
                        $dst = "../images/product/".$image3;

                        //finally upload the product image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image
                            //redirect to add product page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>" ;
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image3= "";//settin default value as blank
                }

                //image4
                //check whether the select image is clicked or not and upload the image only if selected
                if(isset($_FILES['image4']['name']))
                {
                    //get the details of the selected image
                    $image4 = $_FILES['image4']['name'];

                    //check whether the image is selected or not
                    if($image4 != "")
                    {
                        //image is selected
                        //A. rename the image
                        //get the extention of selected image
                        $ext = end(explode('.',$image4));

                        //create new name for image
                        $image4 = "product_".rand(0000, 9999).".".$ext; 

                        //B. upload the image
                        //ext the source path and destination path

                        //source path is the current location of the image
                        $src = $_FILES['image4']['tmp_name'];

                        //destination path for the image to be uploaded
                        $dst = "../images/product/".$image4;

                        //finally upload the product image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image
                            //redirect to add product page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>" ;
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image4= "";//settin default value as blank
                }


                //3. insert into database

                //create a SQL query to save or Add product
                //for numerical values we do not need to pass value inside quotes ''
                $sql2 = "INSERT INTO tbl_product SET
                    title = '$title',
                    sub_title = '$sub_title',
                    description = '$description',
                    price = $price,
                    discount = $discount,
                    image1 = '$image1',
                    image2 = '$image2',
                    image3 = '$image3',
                    image4 = '$image4',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether data is inserted or not
                //4. redirect with message to manage product page

                if($res2 == true)
                {
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>product Added successfully</div>" ;
                    header('location:'.SITEURL.'admin/manage-products.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='danger'>Failed to Add product</div>" ;
                    header('location:'.SITEURL.'admin/manage-products.php');
                }

            }
            ob_end_flush();
        ?>


        </div>

    </div>
    
<?php include('partials/footer.php'); ?>