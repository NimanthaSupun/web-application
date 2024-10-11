<?php 
include('../config/constants.php');
include('login-check.php'); 
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sportexpert</title>
    <!-- MATERIAL CDN  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet">
    <!-- STYLE SHEET  -->
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

   
    <div class="container2"> 
        
        <!-- ASIDE BAR STARTS HERE  -->
        <aside>

            <div class="top">
                <div class="logo">
                    <h2>LOGO</h2>
                </div>

                <div class="close" id="close-btn" onclick="closesidebar()">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>

            <div class="sidebar" id="sidebar">

                <a href="index.php" <?php if ($current_page == 'index.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                
                <a href="manage-admin.php" <?php if ($current_page == 'manage-admin.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Admins</h3>
                </a>
                
                <a href="manage-order.php" <?php if ($current_page == 'manage-order.php'|| $current_page == 'update-order.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                
                <a href="#" <?php if ($current_page == 'analytics.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">insights</span>
                    <h3>Analytics</h3>
                </a>
                
                <a href="#" <?php if ($current_page == 'messages.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Messages</h3>
                    <span class="message-count">99</span>
                </a>
                
                <a href="manage-products.php" <?php if ($current_page == 'manage-products.php'|| $current_page == 'update-product.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>
                
                <a href="manage-category.php" <?php if ($current_page == 'manage-category.php'|| $current_page == 'update-category.php') echo 'class="active"'; ?> >
                <span class="material-icons-sharp">category</span>
                    <h3>Categories</h3>
                </a>
                
                <a href="add-category.php" <?php if ($current_page == 'add-category.php') echo 'class="active"'; ?> >
                    <span class="material-icons-sharp">queue</span>
                    <h3>Add Category</h3>
                </a>
                
                <a href="add-product.php" <?php if ($current_page == 'add-product.php') echo 'class="active"'; ?>>
                    <span class="material-icons-sharp">add</span>
                    <h3>Add Products</h3>
                </a>
                
                <a href="logout.php" <?php if ($current_page == 'logout.php') echo 'class="active"'; ?>>
                    <span class="material-icons-sharp">logout</span>
                    <h3>Log out</h3>
                </a>
            </div>
        </aside>

        <!-- RIGHT SSECTION STARTS HERE  -->
        <div class="main-container right">

            <!-- ==== top ==== -->
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Nimantha</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="profile-default.png" alt="">
                    </div>
                </div>
            </div>
            <!-- ==== top end==== -->