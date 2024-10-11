<?php
ob_start();
 include('partials/menu.php');
  ?>
            <!-- add category -->
            <div class="form-container">
                <h2>Add category</h2>
                <p>Fill all the required fields below</p>
                
                <!-- add category form starts here -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Category Title">
                        </div>
                        <div class="column">
                            <label for="sub-title">Sub Title</label>
                            <input type="text" name="sub_title" id="sub-title" placeholder="Category sub title">
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
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" placeholder="Category Description"></textarea>
                        </div>
                    </div>

                    <!-- //image upload  -->
                    <label for="category-images">Category Image</label>
                    <div class="row">
                       <div class="img-column">

                        <div class="column">
                            <div class="form-element">
                                <input type="file" name="image" id="file-1" accept="image/*">
                                <label for="file-1" id="file-1-preview">
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
                        <input class="submit" type="submit" name="submit" value="Add Category">
                    </div>
                   </div>
                </form>
                <!-- add category form ends here -->


                <?php 
                    //check whether the submit button is clicked or not
                    if(isset($_POST['submit']))
                    {
                        //echo "clicked";

                        //1.get the value from category form
                        $title = $_POST['title'];
                        $sub_title = $_POST['sub_title'];
                        $description = $_POST['description'];

                        //for radio input types we need to check whether the button is selected or not
                        if(isset($_POST['featured']))
                        {
                            //get the value from the form
                            $featured = $_POST['featured'];
                        }
                        else
                        {
                            //set the default value
                            $featured = "no";
                        }


                        if(isset($_POST['active']))
                        {
                            //get the value from the form
                            $active = $_POST['active'];
                        }
                        else
                        {
                            //set the default value
                            $active = "no";
                        }

                        //check whether the image is selected or not and set the value for image name accordingly
                        //print_r($_FILES['image']);
                        //die();

                        if(isset($_FILES['image']['name']))
                        {
                            //upload the image
                            //to upload image we need image name,source path and destination path
                            $image_name =$_FILES['image']['name'];

                            //upload image only if image is selected
                            if($image_name !="")
                            {

                                //auto rename our image
                                //get the exetention of out image(jpg, png, gif, etc) e.g. category1.jpg
                                $ext = end(explode('.',$image_name));
                                //rename the image
                                $image_name ="category_".rand(000, 999).'.'.$ext; //e.g.Category_875.jpg

                                $source_path =$_FILES['image']['tmp_name']; 

                                $destination_path ="../images/category/".$image_name;

                                //finally upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //check whether the image is uploaded or not
                                //and if the image is not uploaded then we will stop the process and redirect with danger message
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload']="<div class='danger'>Failed to upload image</div>";
                                    //redirect to add category page
                                    header('location:'.SITEURL.'admin/add-category.php');
                                    //stop the process
                                    die();   
                                }
                            }
                        }
                        else
                        {
                            //dont upload the image and set the image name as blank
                            $image_name="";
                        }

                        //2.create SQL Query to insert data into the data base
                        $sql = "INSERT INTO tbl_category SET 
                        title='$title',
                        sub_title='$sub_title',
                        description='$description',
                        image='$image_name',
                        featured='$featured',
                        active='$active'
                        ";

                        //3. execute the query and save in data base
                        $res = mysqli_query($conn, $sql);

                        //4. check whether the query is executed or not and data added or not
                        if($res==true)
                        {
                            //query executed and category added
                            $_SESSION['add'] = "<div class='success'>Category Added successfully</div>";
                            //redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }
                        else
                        {
                            //Failed to add category
                            $_SESSION['add'] = "<div class='danger'>Failed to add Category</div>";
                            //redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }

                    }
                    ob_end_flush();
                ?>

            </div>

    </div>
    
<?php include('partials/footer.php'); ?>