<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Food order system</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>
        <?php 
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no login message']))
    {
        echo $_SESSION['no login message'];
        unset($_SESSION['no login message']);
    }
    ?>

    <br><br>
  <!-- form start -->
<form action ="" method="POST">
           Username:<br>
                    <input type="text" name="username" placeholder="Enter username"><br><br>
                Password: <br>
                    <input type="password" name="password" placeholder="Enter Password"><br><br>
                
                        <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>

<!-- form ends -->
<br>
        <p class="text-center">Created by-Sandhya</p>
    </div>
    
</body>
</html>
<?php
// process the value from form and save it in database


if(isset($_POST['submit']))
{
    // echo "Button clicked";
    // get data from form
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //create sql query to save data in database
    $sql="SELECT * from  dbl_admin where
    username='$username' AND
    password='$password'
    ";
// executing query 
    $res=mysqli_query($conn,$sql)or die(mysqli_error());
    // chk whether query executed or not and display aggregate message 
   if($res==TRUE)
   {
  $count=mysqli_num_rows($res);

  if($count==1)
  {
    $_SESSION['login']="Login Successfully";
    $_SESSION['user']=$username;//check user is still login or not
    header('location:'.SITEURL.'admin/');
  }
  else{
    $_SESSION['login']="<div>Username or password does not match</div>";
    header('location:'.SITEURL.'admin/login.php');
  }
   }
   else{
    // redirect to add admin
    // $_SESSION['add']="Failed to add admin";
    // header('location:'.SITEURL.'admin/add_admin.php');
   }
}
?>