<?php 
include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin </h1>
        <br><br>
        <?php 
        // get id 
        $id=$_GET['id'];

        // create sql query to get details
        $sql="SELECT * from dbl_admin where id=$id";
        // execute query
        $res=mysqli_query($conn,$sql);

        // check sql query
        if($res==TRUE)
        {
            $count=mysqli_num_rows($res);
            //check whether we have admin data or not 
            if($count==1)
            {
             // get details
            //   echo "updating admin";
            $row=mysqli_fetch_assoc($res);
            $full_name=$row['full_name'];
            $username=$row['username'];
            }
            else{
                //redirect to manage admin page
                header("location:".SITEURL."admin/manage_admin.php");
            }
        }
        ?>
        <form action="" method="POST">
          <table class="tbl-full">
               <tr>
               <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name?>" placeholder="Enter name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username?>" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
               </tr>
          </table>
        </form>
    </div>
</div>

<?php
    // chk whether submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo "Button clicked";
        // get values from form to update
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];

        // create sql query to update admin
        $sql="UPDATE dbl_admin SET
        full_name='$full_name',
        username='$username'
        WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);
        if($res==TRUE)
        {
              $_SESSION['update']="Admin updated successfully";
              header("location:".SITEURL."admin/manage_admin.php");
        }
        else{
            $_SESSION['update']="Failed to update admin";
              header("location:".SITEURL."admin/manage_admin.php");
        }
    }
?>

<?php include('partials/footer.php');?>
