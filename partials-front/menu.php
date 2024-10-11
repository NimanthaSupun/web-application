<?php
 include('config/constants.php');
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sportexpert</title>
    <link rel="stylesheet" href="css/nsbm.css">
    <link  href="https://fonts.googleapis.com/css2?
    family=poppins:@300;400;500;600;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <!-- MATERIAL CDN  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="header">
    <div class="container">
        <div class="navbar">
            <div class="log">
                <a href="nsbm1.html"><img src="images/SportxpertT.png" width="125px"></a> 
            </div>
            <nav>
                <ul id="menuItems">
                    <li><a href="<?php echo SITEURL; ?>" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>shop.php" <?php if ($current_page == 'shop.php') echo 'class="active"'; ?> >Shop</a></li>
                    <li><a href="<?php echo SITEURL; ?>blog.php"<?php if ($current_page == 'blog.php') echo 'class="active"'; ?>>Blog</a></li>
                    <li><a href="<?php echo SITEURL; ?>about.php" <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>About</a></li>
                    <li><a href="<?php echo SITEURL; ?>contact.php" <?php if ($current_page == 'contact.php') echo 'class="active"'; ?>>Contact</a></li>
                    <?php
                    if(isset($_SESSION['first_name'])){
                        echo "<li class='session_name '  style='color:white;'>$_SESSION[first_name]</li> <a style='color:white;'  href='logout.php'>Log Out</a>";
                    }
                    else{
                        echo "<li ><a href='login.php'class='session_name'>Account</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <a  style="margin-left: 8px;" href="cart.php"><span class="material-icons-outlined cart-icon">local_mall</span></a>
            <img src="images/menu.png" class="menu-icon" 
            onclick="menutoggle()">
        </div>