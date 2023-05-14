<?php
//include constants.php file here
include('../confg/constants.php');
if(isset($_GET['id'])AND isset($_GET['image_name']))
{
    //get the value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove the physical image file is available
    if($image_name != "")
    {
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);
        //if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            $_SESSION['remove'] = "<div class='error'>failed to remove category image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process
            die();
        }
    }
      //delete data from database
      $sql = "DELETE FROM tbl_category WHERE id=$id";
      //execute the query
      $res = mysqli_query($conn, $sql);
      //check whether the data is delete from database or not
      if($res==true)
      {
        //set seccess message and redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
      }
      else
      {
        //set fail message and redirect
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
      }


}
else
{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
}



?>