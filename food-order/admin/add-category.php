<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1>Add Category</h1><br><br>

   <?php
           if(isset($_SESSION['add']))//cheking whether the session is set or not
           {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']);//removing session message
           }
           if(isset($_SESSION['upload']))//cheking whether the session is set or not
           {
                echo $_SESSION['upload']; //displaying session message
                unset($_SESSION['upload']);//removing session message
           }
    ?><br><br><br>  

<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" placeholder="Category Title"></td>
        </tr>
        <tr>
            <td>Select Image:</td>
            <td><input type="file" name="image"></td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td> 
            <input type="radio" name="featured" value="Yes">Yes
            <input type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td><input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
        </tr>
        <tr>
             <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
             </td>
   </table>    

</form>
         <?php
         if(isset($_POST['submit']))
         {
            //echo "clicked";
            //get the value from category form
            $title = $_POST['title'];
            //for radio input we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
             //get the value from form
             $featured = $_POST['featured'];

            }
            else
            {
              $featured = "No";
            }

            if(isset($_POST['active']))
           {
            $active = $_POST['active'];
           }
            else
            {
              $active = "No";
            }
            //check whether the image is selected or not and set the values for image name accordingly
            //print_r($_FILES['image']);

            //die();

            if(isset($_FILES['image']['name']))
            {
                  // upload the image
                  //to upload image we need image name, source path and destination path
                  $image_name = $_FILES['image']['name'];

                  //upload the image only if image is selected
                  if($image_name !="")
                  {


                  // auto rename our image
                  //get the extension of our image
                  $ext = end(explode('.' , $image_name));

                  $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                  $source_path = $_FILES['image']['tmp_name'];
                  $destination_path = "../images/category/".$image_name;
                  //finally upload image
                  $upload = move_uploaded_file($source_path,$destination_path);
                  //check whether the image is uploaded or not
                  if($upload==false)
                  {
                    //set message 
                    $_SESSION['upload'] = "<div class='error'>Failed To Upload Image.</div>";
                    //redirect to add category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                  }
                }
            }
            else
            {
                //dont upload the image
                $image_name="";
            }
          
        //create sql query to insert category into database
        $sql = "INSERT INTO tbl_category SET
                 title='$title',
                 featured='$featured',
                 image_name='$image_name',
                 active='$active'
                 ";

                 //execute the query and save in database
                 $res = mysqli_query($conn,$sql);

                 if($res==true)
                 {
                  //echo "data inserted";
                  //create a session variable to display message
                     $_SESSION['add'] = "<div class ='success'> Category Added Succesfully </div>";
                  //redirect page
                     header("location:".SITEURL.'admin/manage-category.php');
                 }
                else
                 {
                  //echo "failed to insert a data";
                  $_SESSION['add'] = "<div class = 'error'>Failed To Add Category </div>";
                  //redirect page
                  header("location:".SITEURL.'admin/add-category.php');
                 }
         }
         ?>
      
</div>
</div>

<?php include('partials/footer.php');?>