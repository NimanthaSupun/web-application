<?php include('partials/menu.php'); ?>

            <!-- admin table starts here -->
            <div class="form-container table-container">
                
                <div class="table">
                    <div class="table-header">
                        <h3>Admin Details</h3>
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
                        <a href="<?php echo SITEURL;?>admin/add-admin.php">
                            <input class="submit" type="button" name="submit" value="Add admin">
                        </a>
                    </div>

                    <div class="table-section">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>


                         <?php 
                            //Query to get all admin
                            $sql = "SELECT * FROM tbl_admin";
                            //execute the query
                            $res = mysqli_query($conn, $sql);

                            //Check whether the Query is Executed or Not
                            if($res==true)
                            {
                                //count Rows to check whether we have data in the database
                                $count =mysqli_num_rows($res);

                                $sn=1;//createa variable to assign the id value

                                //Check the num rows
                                if($count>0)
                                {
                                    //We have data in database
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        //using while use to get all the data from the database
                                        //while loop will run as long as we have data in database

                                        //Get individual Data
                                        $id = $rows['id'];
                                        $full_name = $rows['full_name'];
                                        $username =$rows['username'];

                                        //Display in our table
                         ?>


                                <tr>
                                    <td><?php echo $sn++?></td>
                                    <td><?php echo $full_name?></td>
                                    <td><?php echo $username?></td>
                                    
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>"><span class="material-icons-sharp edit">edit</span></a>
                                       <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>"> <span class="material-icons-sharp delete">delete</span></a>
                                    </td>
                                </tr>
                                <?php 

                                        }
                                    }else{
                                        //We do not have data in the Database
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
    
<?php include('partials/footer.php'); ?>