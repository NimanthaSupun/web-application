<?php

//include constant file
include("../config/constants.php");

//check whether the id and image value is set or not
if(isset($_GET['id']) AND isset($_GET['image']))
{
    //get the values to delete
    $id = $_GET['id'];
    $image = $_GET['image'];


    //remove the physical image file is avaliable
    if($image !="")
    {
        //image avaliable so remove it
        $path = "../images/category/".$image;

        //remove the image
        $remove = unlink($path);

        //if failed to remove image add an error message and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class='danger'>Failed to remove category image</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process
            die();
        }
    }

    //Delete data from database
    //sql Query to delete data from data base
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the data is deleted from the database
    if($res==true)
    {
        //set sucsess message and redirect
        $_SESSION['delete']="<div class='danger'> Category Deleted Sucsessfully</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete']="<div class='danger'> Failed to delete Category</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    
}
else
{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>