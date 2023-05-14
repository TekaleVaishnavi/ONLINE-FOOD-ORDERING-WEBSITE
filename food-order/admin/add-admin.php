<?php include('partials/menu.php');?>

<div class="main-content">
<div class="wrapper">
    <h1>Add Admin</h1><br>

    <?php
           if(isset($_SESSION['add']))//cheking whether the session is set or not
           {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']);//removing session message
           }
    ?><br><br><br>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
             <td>Full Name:</td>
             <td><input type="text"name="full_name" placeholder="Enter Your Name"></td>
           </tr>

           <tr>
             <td>Username:</td>
             <td><input type="text"name="Username" placeholder="Your User Name"></td>
           </tr>

           <tr>
             <td>Password:</td>
             <td><input type="Password"name="Password" placeholder="Your Password"></td>
           </tr>

           <tr>
             <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
             </td>
            
           </tr>

        </table>
    </form>
</div>
</div>

<?php include('partials/footer.php');?>

<?php
//process the value from form and save it in database
//check whether the button is clicked or not

if(isset($_POST['submit']))
{
    //button clicked 
 //   echo "Button Clicked
 //get the data from form
  $full_name =$_POST['full_name'];
  $Username =$_POST['Username'];
 $Password =md5($_POST['Password']); //password encryption with MD5

 //sql query to save the data into database
 $sql = "INSERT INTO tbl_admin SET
      full_name='$full_name',
      Username='$Username',
      Password='$Password'";
 //3.executing query and saving a data into database
 $res = mysqli_query($conn,$sql) or die(mysqli_error());

 //4.check whether the data is inserted or not
 if($res==TRUE)
 {
  //echo "data inserted";
  //create a session variable to display message
  $_SESSION['add'] = "Admin Added Succesfully";
  //redirect page
  header("location:".SITEURL.'admin/manage.admin.php');
 }
 else
 {
  //echo "failed to insert a data";
  $_SESSION['add'] = "Failed To Add Admin";
  //redirect page
  header("location:".SITEURL.'admin/add-admin.php');
 }
}


?>