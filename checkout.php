<!-- // Include the database connection file -->
<?php include('partials-front/menu.php'); ?>

    </div>
</div>


<?php
ob_start();
    //set the time zone to sri lanka
    date_default_timezone_set('Asia/Colombo');
 
 // Retrieve values from URL query parameters
    $product_id = urldecode($_GET['product_id']);
    $qty= $_GET['quantity'];
    $size = $_GET['size'];
    $total = $_GET['total'];
    
    // Check if the "coupon" parameter is set in the URL
    if(isset($_GET['coupon'])) {
        // If the "coupon" parameter is set, retrieve its value
        $coupon = $_GET['coupon'];
    } else {
        $coupon = null;
    }

    // Fetch product details from the database based on product_id
    $query = "SELECT title, price FROM tbl_product WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $product = $row['title'];
    $price = $row['price'];
 
 ?>

    <div class="checkout-form-container">

        <form class="checkout-form" action="" method="POST">
            <h3>Checkout</h3>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required><br>

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" placeholder="Enter your contact number" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required><br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" placeholder="Enter your address" required></textarea><br>

            <label for="postal-code">Postal Code:</label>
            <input type="text" id="postal-code" name="postal-code" placeholder="Enter your postal code" required><br>

            <label for="payment-method">Select Payment Method:</label>
            <select id="payment-method" name="payment-method">
                <option value="bank-transfer" selected>Bank Transfer</option>
                <option value="cash-on-delivery">Cash on Delivery</option>
                <option value="card-payment">Card Payment</option>
            </select><br>

            <div class="payment-method" id="bank-transfer" style="display: none;">
                <!-- Bank Transfer Payment Method -->
                <h3>Bank Transfer</h3>
                <p>Total amount:$<?php echo number_format($total, 2); ?></p>
                <p>Please transfer the total amount to the following bank account:</p>
                <p>Account Number: [Insert Account Number]</p>
                <p>Bank Name: [Insert Bank Name]</p>
                <label for="payment-slip">Upload Payment Slip:</label>
                <input type="file" id="payment-slip" accept="image/*">
            </div>

            <div class="payment-method" id="cash-on-delivery" style="display: none;">
                <!-- Cash on Delivery Payment Method -->
                <h3>Cash on Delivery</h3>
                <p>Total amount:$<?php echo number_format($total, 2); ?></p>
                <p>Please prepare cash for the delivery person.</p>
                <p>The delivery person will collect the payment when delivering your order.</p>
            </div>

            <div class="payment-method" id="card-payment" style="display: none;">
                <!-- Card Payment Method -->
                <h3>Card Payment</h3>
                <p>Total amount:$<?php echo number_format($total, 2); ?></p>
                <p>Please proceed to enter your card details for payment.</p>
                <!-- Add card payment form here -->
            </div>

            <input type="submit" class="normal submit-btn" value="Place Order" name="submit">
        </form>

        <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    // Get all the details from the form
                    $customer_name = $_POST['name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $postal_code = $_POST['postal-code'];
                    $payment_method = $_POST['payment-method'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        product = '$product',
                        size = '$size',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        postal_code = $postal_code,
                        payment_method = '$payment_method'
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Product Ordered Successfully.</div>";
                        header('location: ' . SITEURL . 'thanks.php');
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order product.</div>";
                        header('location: ' . SITEURL . 'thanks.php');

                    }
                }
                ob_end_flush();
            ?>

    </div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to show the selected payment method
        function showPaymentMethod() {
            var selectedMethod = document.getElementById("payment-method").value;
            var paymentMethods = document.getElementsByClassName("payment-method");
            for (var i = 0; i < paymentMethods.length; i++) {
                if (paymentMethods[i].id === selectedMethod) {
                    paymentMethods[i].style.display = "block";
                } else {
                    paymentMethods[i].style.display = "none";
                }
            }
        }

        // Event listener for when the payment method selection changes
        document.getElementById("payment-method").addEventListener("change", showPaymentMethod);

        // Show default payment method
        showPaymentMethod();
    });


        //navbar js including seperately 
        const bar = document.getElementById('bar');
        const close = document.getElementById('close');
        const nav = document.getElementById('navbar');

        if (bar){
            bar.addEventListener('click', () =>{
                nav.classList.add('active');
            })
        }

        if (close){
            close.addEventListener('click', (event) =>{
                event.preventDefault(); // This prevents the default behavior (scrolling to the top)
                nav.classList.remove('active');
            })
        }
</script>


    
</body>
</html>


