<?php
//include constant file
include("../config/constants.php");


//check whether the id and image value is set or not
if(isset($_GET['id']) && isset($_GET['image1']) && isset($_GET['image2']) && isset($_GET['image3']) && isset($_GET['image4']))
{
    //get the values to delete
    $id = $_GET['id'];
    $image1 = $_GET['image1'];
    $image2 = $_GET['image2'];
    $image3 = $_GET['image3'];
    $image4 = $_GET['image4'];


    //remove the physical image file is avaliable
    if($image1 !="")
    {
        //image avaliable so remove it
        $path = "../images/product/".$image1;

        //remove the image
        $remove = unlink($path);

        //if failed to remove image add an error message and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class='danger'>Failed to remove product image</div>";
            //redirect to manage product page
            header('location:'.SITEURL.'admin/manage-products.php');
            //stop the process
            die();
        }
    }

    if($image2 !="")
    {
        //image avaliable so remove it
        $path = "../images/product/".$image2;

        //remove the image
        $remove = unlink($path);

        //if failed to remove image add an error message and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class='danger'>Failed to remove product image</div>";
            //redirect to manage product page
            header('location:'.SITEURL.'admin/manage-products.php');
            //stop the process
            die();
        }
    }


    if($image3 !="")
    {
        //image avaliable so remove it
        $path = "../images/product/".$image3;

        //remove the image
        $remove = unlink($path);

        //if failed to remove image add an error message and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class='danger'>Failed to remove product image</div>";
            //redirect to manage product page
            header('location:'.SITEURL.'admin/manage-products.php');
            //stop the process
            die();
        }
    }

    if($image4 !="")
    {
        //image avaliable so remove it
        $path = "../images/product/".$image4;

        //remove the image
        $remove = unlink($path);

        //if failed to remove image add an error message and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class='danger'>Failed to remove product image</div>";
            //redirect to manage product page
            header('location:'.SITEURL.'admin/manage-products.php');
            //stop the process
            die();
        }
    }

    
    //Delete data from database
    //sql Query to delete data from data base
    $sql = "DELETE FROM tbl_product WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the data is deleted from the database
    if($res==true)
    {
        //set sucsess message and redirect
        $_SESSION['delete']="<div class='danger'> product Deleted Sucsessfully</div>";
        //redirect to manage product
        header('location:'.SITEURL.'admin/manage-products.php');
    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete']="<div class='danger'> Failed to delete product</div>";
        //redirect to manage product
        header('location:'.SITEURL.'admin/manage-products.php');
    }

    
}
else
{
    //redirect to manage products page
    header('location:'.SITEURL.'admin/manage-products.php');
}

?>