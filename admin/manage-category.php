<?php include('partials/menu.php'); ?>

            <!-- Category table starts here -->
            <div class="form-container table-container">
                
                <div class="table">
                    <div class="table-header">
                        <h3>Category Details</h3>
                        <?php
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }

                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                        ?>
                        <a href="<?php echo SITEURL;?>admin/add-category.php">
                            <input class="submit" type="button" name="submit" value="Add Category">
                        </a>
                    </div>

                    <div class="table-section">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Active</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>


                            <?php 

                                //Query to get all category from database
                                $sql = "SELECT * FROM tbl_category";

                                //Execute query
                                $res = mysqli_query($conn, $sql);

                                //count rows
                                $count = mysqli_num_rows($res);

                                //Create Serial number variable
                                $sn=1;

                                //check we have data in data base or not
                                if($count>0)
                                {
                                //we have data in data base
                                //get the data and display
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image =$row['image'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                    <?php 
                                            //check whether the image name is avaliable or not
                                            if($image!="")
                                            {
                                                //display the image
                                                ?>

                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image; ?>" >

                                                <?php
                                            }
                                            else
                                            {
                                                //display the no image found message
                                                echo "<div class='danger'>Image not found</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>"><span class="material-icons-sharp edit">edit</span></a>
                                       <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image=<?php echo $image?>"> <span class="material-icons-sharp delete">delete</span></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                else
                                {
                                    //we do not have data
                                    //we will display the message inside table
                                    ?>

                                    <tr>
                                        <td colspan="6">
                                            <div class="danger">No category Added</div>
                                        </td>
                                    </tr>

                                    <?php
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
           

    </div>
    
<?php include('partials/footer.php'); ?>