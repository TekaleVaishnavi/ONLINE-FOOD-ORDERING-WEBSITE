<?php include('../confg/constants.php');?>
<html>
    <head>
     <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
    
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <br><br>
            <!-- login form starts here-->
              <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
               <input type="submit" name="submit" value="login" class="btn-primary"><br><br>
                
              </form>  
            <p class="text-center">Created By -<a href="VT">Vaishnavi Tekale</a></P>
      </div>
   </body>
</html>
<?php
   //check whether the submit button is clicked or not
   if(isset($_POST['submit']))
   {
    //process for login
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //execute the query
    $res = mysqli_query($conn,$sql);
    //count rows to check whether the user exist or not
    $count = mysqli_num_rows($res);
    if($count==1)
    {
       $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
       $_SESSION['user'] = $username;//to check whether the user is login or not and logout will unset it.
       //redirect to homepage
       header('location:' .SITEURL.'admin/');
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>User Name Or Password Did Not Match.</div>";
        //redirect to homepage
        header('location:' .SITEURL.'admin/login.php');
    }
   }


?>