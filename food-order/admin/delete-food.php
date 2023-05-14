<?php
//include constants.php file here
include('../confg/constants.php');

if(isset($_GET['id'])AND isset($_GET['image_name']))
{
  //process to delete 
  //get id and image name
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];
  //remove the image if available
  //check whether the image is avilable or not and delete only if avilable
  if($image_name != "")
    {
        //it has image and need to remove from folder
        //get the image path
        $path = "../images/food/".$image_name;
        //remove image file from folder
        $remove = unlink($path);
        //if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            $_SESSION['upload'] = "<div class='error'>failed to remove image file.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-food.php');
            //stop the process
            die();
        }
    }
    //delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
      //execute the query
      $res = mysqli_query($conn, $sql);
      //check whether the data is delete from database or not
      if($res==true)
      {
        //set seccess message and redirect
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }
      else
      {
        //set fail message and redirect
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }
}
else
{
   $_SESSION['unauthorize'] = "<div class='error'>Unauthorised access.</div>";
   header('location:'.SITEURL.'admin/manage-food.php');
}