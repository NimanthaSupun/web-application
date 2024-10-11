<!-- // Include the database connection file -->
<?php include('partials-front/menu.php'); ?>

    </div>
</div>

<?php require_once('functions.php'); ?>
<?php

	// check for form submission
	if (isset($_POST['submit'])) {

		$errors = array();

		// check if the username and password has been entered
		if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
			$errors[] = 'Username is Missing / Invalid';
		}

		if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
			$errors[] = 'Password is Missing / Invalid';
		}

		// check if there are any errors in the form
		if (empty($errors)) {
			// save username and password into variables
			$email 		= mysqli_real_escape_string($conn, $_POST['email']);
			$password 	= mysqli_real_escape_string($conn, $_POST['password']);
			$hashed_password = sha1($password);

			// prepare database query
			$query = "SELECT * FROM user 
						WHERE email = '{$email}' 
						AND password = '{$hashed_password}' 
						LIMIT 1";

			$result_set = mysqli_query($conn, $query);

			verify_query($result_set);

			if (mysqli_num_rows($result_set) == 1) {
				// valid user found
				$user = mysqli_fetch_assoc($result_set);
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['first_name'] = $user['first_name'];
				// updating last login
				$query = "UPDATE user SET last_login = NOW() ";
				$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";

				$result_set = mysqli_query($conn, $query);

				verify_query($result_set);

				// redirect to users.php
				header('Location: index.php');
			} else {
				// user name and password invalid
				$errors[] = 'Invalid Username / Password';
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card</title>
    <link rel="stylesheet" href="nsbm.css">
    <link  href="https://fonts.googleapis.com/css2?
    family=poppins:@300;400;500;600;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-
    awesome/4.7.0/css/font-awesome.min.css">
 -->
</head>

<body>
   
<!-- account-page -->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%">

            </div>
            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <span>Login</span>
                    </div>
                    <form id="RegForm" method="post">
                        <input type="email"  name="email"  placeholder="Email">
                        <input type="password"  name="password"  placeholder="Password">
                        <button type="submit" name="submit"  class="btn">Login</button>
                        <p>Don't have account? <a href="reg.php">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- footer -->
</body>
</html>

<?php include('partials-front/footer.php'); ?>