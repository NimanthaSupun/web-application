<?php 
include('../config/constants.php');
include('login-check.php'); 
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
      
    <div class="container"> 
        
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

                <a href="index.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                
                <a href="manage-admin.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Admins</h3>
                </a>
                
                <a href="manage-order.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                
                <a href="#">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Analytics</h3>
                </a>
                
                <a href="#">
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Messages</h3>
                    <span class="message-count">99</span>
                </a>
                
                <a href="manage-products.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>
                
                <a href="manage-category.php">
                <span class="material-icons-sharp">category</span>
                    <h3>Categories</h3>
                </a>
                
                <a href="add-category.php">
                    <span class="material-icons-sharp">queue</span>
                    <h3>Add Category</h3>
                </a>
                
                <a href="add-product.php">
                    <span class="material-icons-sharp">add</span>
                    <h3>Add Products</h3>
                </a>
                
                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Log out</h3>
                </a>
            </div>
        </aside>
        