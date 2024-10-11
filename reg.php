<!-- // Include the database connection file -->
<?php include('partials-front/menu.php'); ?>

    </div>
</div>

<?php require_once('functions.php'); ?>

<?php 

	$errors = array();
	$first_name = '';
	$last_name = '';
	$email = '';
	$password = '';

	if (isset($_POST['submit'])) {
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// checking required fields
		$req_fields = array('first_name', 'last_name', 'email', 'password');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		// checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}

		// checking if email address already exists
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";

		$result_set = mysqli_query($con, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'Email address already exists';
			}
		}
		if (empty($errors)) {
			// no errors found... adding new record
			$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			// email address is already sanitized
			$hashed_password = sha1($password);

			$query = "INSERT INTO user ( ";
			$query .= "first_name, last_name, email, password, is_deleted";
			$query .= ") VALUES (";
			$query .= "'{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', 0";
			$query .= ")";

			$result = mysqli_query($con, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: login.php');
			} else {
				$errors[] = 'Failed to add the new record.';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New User</title>
	<link rel="stylesheet" href="nsbm.css">
</head>
<body>

	<header>
		<!-- <div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div> -->
	</header>

	<main>
		<?php 
			if (!empty($errors)) {
				display_errors($errors);
			}
		 ?>
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%">

            </div>
            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        </div>
                        <form action="add-user.php" method="post" class="register-form" id="RegForm">

                            <h2>Register</h2>
                            <input type="text" placeholder="First Name"  name="first_name" <?php echo 'value="' . $first_name . '"'; ?>>
                            
                            <input type="text"  placeholder="Last Name"  name="last_name" <?php echo 'value="' . $last_name . '"'; ?>>
                            
                            <input type="text"  placeholder="Emial" name="email" <?php echo 'value="' . $email . '"'; ?>>
                            
                            <input type="password"  placeholder="Password"  id="password" name="password" >
        
                            <button type="submit" name="submit" class="login">Save</button><br>

                            <a href="login.php">Login</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>	 
</main>
<style>  
    .form-container form {
       width: 100%;
       height:100%;
       display:flex;
       flex-direction:column;
       justify-content:space-around;
       position: relative;
       top:-10px;
       
    }
    .checkbox{
        width: 15px;
        height:15px;
    }
    .login{
        display: inline-block;
        background: #108adb;
        color: #fff;
        padding: 8px 30px;
        margin: 30px 0;
        transition-duration: 0.5s;
    }
    </style>
</body>
</html>