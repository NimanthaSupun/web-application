<!-- // Include the database connection file -->
<?php include('partials-front/menu.php'); ?>

    </div>
</div>
<?php
// Fetching the values passed through the URL
$product_id = $_GET['product_id'];
// $size = $_GET['size'];

// Get the selected size from the $_GET array
$selectedSize = isset($_GET['size']) ? $_GET['size'] : '';
// Define an array of sizes for easy iteration
$sizes = array("Small", "Medium", "Large", "XL", "XXL");

// Fetch product details from the database based on product_id
$query = "SELECT title, price, image1 FROM tbl_product WHERE id = $product_id";
$result = mysqli_query($conn, $query);

?>
        <!-- ==========coupon========== -->
        <section id="cart-add" class="section-p1">

            <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $title = $row['title'];
                    $price = $row['price'];
                    $image = $row['image1'];

                    //Default Quantity set as 1
                    $qty = 1;

                    // Assuming you have fetched the coupon code from somewhere
                    $couponCode = "sportexpert";

                    // Define shipping cost variable
                    $shippingCost = 100.00; // or fetch it from database or any other source

                    // Include the shipping cost in the JavaScript section
                    echo "<script>var shippingCost = " . json_encode($shippingCost) . ";</script>";
                
                    // Calculate subtotal
                    $subtotal = $price * $qty;

                    // Calculate total
                    $total = $subtotal + $shippingCost;

                    // Now you can use these variables as needed
                   ?>

                    <div id="coupon">

                        <div id="cart" >
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td>
                                        <?php
                                            //check whether image available or not
                                            if($image=="")
                                            {
                                                //image not available
                                                // echo "<div class='error'>Image not available</div>";
                                            }
                                            else
                                            {
                                                //image available
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image; ?>">
                                                <?php
                                            }
                                        ?>
                                        </td>
                                        <td>
                                            <select id="size" name="size">
                                                <option value="">Select Size</option>
                                                <?php
                                                // Iterate over each size and create an option tag
                                                foreach ($sizes as $size) {
                                                    // Check if the current size matches the selected size
                                                    $isSelected = ($size === $selectedSize) ? 'selected' : '';
                                                    // Output the option tag with the appropriate selected attribute
                                                    echo "<option value='$size' $isSelected>$size</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $title; ?></td>
                                        <td class="price">$<?php echo $price; ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <button class="quantity-button" onclick="decrementQuantity()">-</button>
                                            <span class="quantity-input" id="quantity"><?php echo $qty; ?></span>
                                            <button class="quantity-button" onclick="incrementQuantity()">+</button>
                                        </td>
                                        <td id="subtotal">$<?php echo $price * $qty; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="apply-coupon">
                            <h3>Apply Coupon</h3>
                            <small>Use <b>sportexpert</b> to get 10% off</small>
                            <div>
                                <input type="text" placeholder="Enter Your Coupon" id="coupon-input">
                                <button class="normal submit-btn" onclick="applyCoupon()">Apply</button>
                            </div>
                        </div>

                    </div>

                    <div class="subtotal">
                        <h3>Cart Totals</h3>
                        <table>
                            <tr>
                                <td>Cart Subtotal</td>
                                <td id="cart-subtotal">$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>

                            <tr>
                                <td>Shipping</td>
                                <td id="shipping-cost">$<?php echo number_format($shippingCost, 2); ?></td>
                            </tr>

                            <tr>
                                <td><strong>Total</strong></td>
                                <td id="total">$<?php echo number_format($total, 2); ?></td>
                            </tr>
                        </table>
                        <button class="normal submit-btn" onclick="proceedToCheckout()">Proceed to checkout</button>
                    </div>

                   <?php
                } else {
                    // Product not found, redirect to shop.php
                    header("Location: " . SITEURL . "shop.php");
                    exit(); // Ensure script execution stops after redirection
                }
            ?>
        </section>
        <script>
            // Update subtotal and total when quantity changes
            function updateSubtotal() {
                var price = parseFloat(document.querySelector('.price').textContent.replace('$', ''));
                var quantity = parseInt(document.getElementById('quantity').textContent);
                var subtotal = price * quantity;
                document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
                updateTotal();
            }

            // Increment quantity
            function incrementQuantity() {
                var quantityElement = document.getElementById('quantity');
                var quantity = parseInt(quantityElement.textContent);
                quantity++;
                quantityElement.textContent = quantity;
                updateSubtotal();
            }

            // Decrement quantity
            function decrementQuantity() {
                var quantityElement = document.getElementById('quantity');
                var quantity = parseInt(quantityElement.textContent);
                if (quantity > 1) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    updateSubtotal();
                }
            }

            // Update total
            function updateTotal() {
                var cartSubtotal = parseFloat(document.getElementById('subtotal').textContent.replace('$', ''));
                
                // Apply coupon discount if it's been applied
                if (couponApplied) {
                    cartSubtotal *= 0.9; // Apply 10% discount
                }

                document.getElementById('cart-subtotal').textContent = '$' + cartSubtotal.toFixed(2);
                
                var shippingCost = parseFloat(document.getElementById('shipping-cost').textContent.replace('$', ''));
                var total = cartSubtotal + shippingCost;
                document.getElementById('total').textContent = '$' + total.toFixed(2);
            }

            // Apply coupon discount
            var couponApplied = false; // Flag to track whether coupon has been applied
            function applyCoupon() {
                if (!couponApplied) {
                    var couponInput = document.getElementById('coupon-input').value;
                    if (couponInput === "<?php echo $couponCode; ?>") {
                        couponApplied = true;
                        updateTotal(); // Update total with discount
                    }
                }
            }
            //Create a JavaScript function proceedToCheckout() to dynamically update the URL parameters with the updated values
            function proceedToCheckout() {
                // Retrieve updated quantity
                var updatedQuantity = parseInt(document.getElementById('quantity').innerText);
                
                // Retrieve total displayed on the page
                var totalString = document.getElementById('total').innerText;

                // Extract the numerical value of total (remove the dollar sign and parse to float)
                var updatedTotal = parseFloat(totalString.replace('$', ''));

                // Retrieve product id
                var productID = "<?php echo urlencode($product_id); ?>";

                // Retrieve coupon code input value
                var couponInput = document.getElementById('coupon-input').value;

                // Retrieve selected size
                var selectedSize = document.getElementById('size').value;

                // Construct the new URL with updated values
                var url = "checkout.php?quantity=" + updatedQuantity + "&total=" + updatedTotal + "&product_id=" + productID + "&size=" + encodeURIComponent(selectedSize);

                // If the coupon code is correct, include it in the URL
                if (couponInput === "<?php echo $couponCode; ?>") {
                    url += "&coupon=" + couponInput;
                }

                // Redirect to the new URL
                window.location.href = url;
            }
        </script>
<?php include('partials-front/footer.php'); ?>
