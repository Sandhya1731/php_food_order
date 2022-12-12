<?php 
include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php if(isset($_GET['id'])){
        $id=$_GET['id'];}
        ?>

<form action ="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder="Old Password"></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php  echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
</div>
</div>

<?php 

if(isset($_POST['submit']))
{

    //get data from form 
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    $sql="SELECT * from dbl_admin where id=$id AND password='$current_password'";
    $res=mysqli_query($conn,$sql);
    if($res==TRUE)
    {
        // check data is available or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            // echo "user here";
            if($new_password==$confirm_password)
            {
                $sql2="UPDATE dbl_admin SET
                password='$new_password'
                where id=$id
                ";
               

               // execute the query
               $res2=mysqli_query($conn,$sql2);
               if($res2==TRUE)
               {
                $_SESSION['updatepassword']="Password Updated";
                header('location:'.SITEURL.'admin/manage_admin.php');
               }
               else{
                $_SESSION['updatepassword']="Could not Update Password";
                header('location:'.SITEURL.'admin/manage_admin.php');
               }
            }
            else{
            //   echo "password doent match";
            $_SESSION['notmatch']="password does not match. Try again!!";
            header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }
        else{
            // echo "user not presemt";
            $_SESSION['unavailable']="user not available";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
    }
}
?>
<?php include('partials/footer.php');?>