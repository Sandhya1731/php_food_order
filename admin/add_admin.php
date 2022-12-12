<?php
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action ="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
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
<?php
include("partials/footer.php");
?>
<?php
// process the value from form and save it in database


if(isset($_POST['submit']))
{
    // echo "Button clicked";
    // get data from form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //create sql query to save data in database
    $sql="INSERT INTO dbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
// executing query ans saving data in database
    $res=mysqli_query($conn,$sql)or die(mysqli_error());
    // chk whether query executed or not and display aggregate message 
   if($res==TRUE)
   {
    $_SESSION['add']="Admin added successfully";
    //redirect page to manage admin
    header('location:'.SITEURL.'admin/manage_admin.php');
   }
   else{
    // redirect to add admin
    $_SESSION['add']="Failed to add admin";
    header('location:'.SITEURL.'admin/add_admin.php');
   }
}
?>