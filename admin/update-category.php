<?php
ob_start();
 include('partials/menu.php');
  ?>
            <!-- update category form starts here -->
            <div class="form-container">
                <h2>Edit category</h2>
                <p>Edit through below fields </p>

                <?php
        
                    //check whether the id is set or not
                    if(isset($_GET['id']))
                    {
                        //get the id and other details
                        $id = $_GET['id'];
                        //create sql query to get all other details
                        $sql = "SELECT * FROM tbl_category WHERE id=$id";

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
                            $current_image = $row['image'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            

                        }
                        else
                        {
                            //redirect to manage category with session message
                            $_SESSION['no-category-found'] = "<div class='danger'>Category not Found</div>";
                            //redirect to manage category
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }
                    }
                    else
                    {
                        //redirect to manage category
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="<?php echo $title; ?>" id="title" placeholder="Category Title">
                        </div>
                        <div class="column">
                            <label for="sub-title">Sub Title</label>
                            <input type="text" name="sub_title" value="<?php echo $sub_title; ?>" id="sub-title" placeholder="Category sub title">
                        </div>  
                    </div>


                    <div class="row">
                        <div class="column">
                            <label for="active">Active</label>
                            <label for=""><input type="radio" <?php if($active=="yes"){echo "checked";} ?>  name="active" id="active" value="yes">Yes</label>
                            <label for=""><input type="radio" <?php if($active=="no"){echo "checked";} ?> name="active" id="active" value="no">No</label>
                        </div>

                        <div class="column">
                            <label for="active">Featured</label>
                            <label for=""><input type="radio" <?php if($featured=="yes"){echo "checked";} ?> name="featured" id="featured" value="yes">Yes</label>
                            <label for=""><input type="radio" <?php if($featured=="no"){echo "checked";} ?> name="featured" id="featured" value="no">No</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" placeholder="Category Description"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                    <!-- //image update -->
                    <label for="category-images">Category Image</label>
                    <div class="row">
                       <div class="img-column">

                        <div class="column">
                            <div class="form-element">
                                <input type="file" name="image" id="file-1" accept="image/*">
                                <label for="file-1" id="file-1-preview">
                                 <?php
                                    if($current_image=="")
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
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" >
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
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input class="submit" type="submit" name="submit" value="Save Changes">
                    </div>
                   </div>
                    
                </form>


                <?php
                    if(isset($_POST['submit']))
                    {
                        //echo "clicked";product
                        //1.get all values from our form

                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $sub_title = $_POST['sub_title'];
                        $description = $_POST['description'];
                        $current_image = $_POST['current_image'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];

                        //2.updating new image if selected
                        //check whether the image is selected or not
                        if(isset($_FILES['image']['name']))
                        {
                            //get the image details
                            $image = $_FILES['image']['name'];

                            //check whether the image is avaliable or not
                            if($image != "")
                            {
                                //image avaliable

                                // A.upload the new image

                                //auto rename our image
                                //get the exetention of out image(jpg, png, gif, etc) e.g. product1.jpg
                                $ext = end(explode('.',$image));
                                //rename the image
                                $image ="category_".rand(000, 999).'.'.$ext; //e.g. product_Category_875.jpg

                                $source_path =$_FILES['image']['tmp_name']; 

                                $destination_path ="../images/category/".$image;

                                //finally upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //check whether the image is uploaded or not
                                //and if the image is not uploaded then we will stop the process and redirect with error message
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload']="<div class='danger'>Failed to upload image</div>";
                                    //redirect to add category page
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    //stop the process
                                    die();   
                                }

                                // B.remove the current image if avaliable
                                if($current_image !="")
                                {
                                    $remove_path = "../images/category/".$current_image;
                                    $remove = unlink($remove_path);
                
                                    //check whether the image is removed or not
                                    //if failed to remove display message and stop the process
                                    if($remove==false)
                                    {
                                        //Failed to remove the image
                                        $_SESSION['failed-remove']="<div class='danger'>Failed to remove current image</div>";
                                        header('location:'.SITEURL.'admin/manage-category.php');
                                        die();//stop the process
                                    }
                                }
                            
                            }
                            else
                            {
                                $image = $current_image;
                            }
                        }
                        else
                        {
                            $image = $current_image;
                        }

                        //3.update the database
                        $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        sub_title = '$sub_title',
                        description = '$description',
                        image = '$image',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                        ";
                        //execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //4.redirect to manage category with message
                        //check whether executed or not
                        if($res2==true)
                        {
                            //category update
                            $_SESSION['update'] = "<div class='success'>Category updated Succsessfully</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }
                        else
                        {
                            //failed to update category
                            $_SESSION['update'] = "<div class='danger'>Failed to update category</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }

                    }
                    ob_end_flush();
                    ?>

        </div>

    </div>
    


<?php include('partials/footer.php'); ?>