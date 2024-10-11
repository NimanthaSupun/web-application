<?php 
ob_start();
include('partials/menu.php'); 
?>

            <!-- add products form starts here -->
            <div class="form-container">
                <h2>Update Order</h2>
                <p>Update the order Status </p>
                <?php 
        
                    //CHeck whether id is set or not
                    if(isset($_GET['id']))
                    {
                        //GEt the Order Details
                        $id=$_GET['id'];

                        //Get all other details based on this id
                        //SQL Query to get the order details
                        $sql = "SELECT * FROM tbl_order WHERE id=$id";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);

                        if($count==1)
                        {
                            //Detail Availble
                            $row=mysqli_fetch_assoc($res);

                            $product = $row['product'];
                            $size = $row['size'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address= $row['customer_address'];
                            $postal_code = $row['postal_code'];
                            $payment_method = $row['payment_method'];
                        }
                        else
                        {
                            //DEtail not Available/
                            //Redirect to Manage Order
                            header('location:'.SITEURL.'admin/manage-order.php');
                        }
                    }
                    else
                    {
                        //REdirect to Manage ORder PAge
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                
                ?>
                
                <form action="" method="POST">
                    <table class="update-order-tbl">
                        <tr>
                            <td>Order ID</td>
                            <td>OID<?php echo $id; ?></td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td><?php echo $product; ?></td>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <td><?php echo $size; ?></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><?php echo $price; ?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?php echo $qty; ?></td>
                        </tr>
                        <tr>
                            <td>total</td>
                            <td><?php echo $total; ?></td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td><?php echo $order_date; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td><?php echo $customer_name; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Contact</td>
                            <td><?php echo $customer_contact; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Email</td>
                            <td><?php echo $customer_email; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Address</td>
                            <td><?php echo $customer_address; ?></td>
                        </tr>
                        <tr>
                            <td>Postal Code</td>
                            <td><?php echo $postal_code; ?></td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td><?php echo $payment_method; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status" class="status-select">
                                    <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                    <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                                    <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                                    <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input class="submit update-order-btn" type="submit" name="submit" value="Update Order">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php 
                    //CHeck whether Update Button is Clicked or Not
                    if(isset($_POST['submit']))
                    {
                        //get the status 
                        $status = $_POST['status'];

                        //Update the Values
                        $sql2 = "UPDATE tbl_order SET status = '$status'  WHERE id=$id";

                        //Execute the Query
                        $res2 = mysqli_query($conn, $sql2);

                        //CHeck whether update or not
                        //And REdirect to Manage Order with Message
                        if($res2==true)
                        {
                            //Updated
                            $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-order.php');
                        }
                        else
                        {
                            //Failed to Update
                            $_SESSION['update'] = "<div class='danger'>Failed to Update Order.</div>";
                            header('location:'.SITEURL.'admin/manage-order.php');
                        }
                    }
                ?>
            </div>

<?php include('partials/footer.php'); ?>