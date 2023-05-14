<?php

//include constants.php file here
include('../confg/constants.php');
//get the id of admin to be deleted
$id = $_GET['id'];

//create sql query to delete a admin
$sql = "DELETE FROM tbl_admin Where id=$id";
//execute the query
$res = mysqli_query($conn, $sql);
//check whether the query executed successfully or not
if($res==TRUE)
{
    //QUERY EXECUTED SUCCESSFULLY AND ADMIN DELETED
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully...</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage.admin.php');
}
else{

   // echo "failed to deleted";
   $_SESSION['delete'] = "<div class='error'>Failed To Delete Admin. Try Again Latter.</div>";
   header('location:'.SITEURL.'admin/manage.admin.php');
}

?>