<?php
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <form action ="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>
                        Select Image:
                    </td>
                    <td>
                    <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

    </td>
                </tr>
                <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

    </td>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
// process the value from form and save it in database


if(isset($_POST['submit']))
{
    // echo "Button clicked";
    // get data from form
    $title=$_POST['title'];
    if(isset($_POST['featured']))
    {
        $featured=$_POST['featured'];
    }
    else{
        $featured="No";
    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else{
        $active="No";
    }
    //chk whether image is selected or not
    // print_r($_FILES['image']);
    // die();
    if(isset($_FILES['image']['name']))
    {
        //upload image
        //image name ,src path ,dest path 
        $image_name=$_FILES['image']['name'];

        //auto rename the image
        //get extensions of our image 
        if($image_name!=""){
        $image_info=explode(".",$image_name);
        $ext=end($image_info);
        //rename the image name
        $image_name="food_category".rand(000,999).".".$ext;
        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/category/".$image_name;

        //upload image
        $upload=move_uploaded_file($source_path,$destination_path);
        //chk if image uploaded or not
        if($upload==FALSE)
        {
            $_SESSION['upload']="Failed to upload image";
            header('location:'.SITEURL.'admin/add_category.php');
            //stop the process
            die();
        }
    }
    }
    else{
        //dont upload image and set value as blank
       
        $image_name="";
    }
    

    //create sql query to save data in database
    $sql="INSERT INTO dbl_category SET
    title='$title',
    img_name='$image_name',
    featured='$featured',
    active='$active'
    ";
// executing query ans saving data in database
    $res=mysqli_query($conn,$sql)or die(mysqli_error());
    // chk whether query executed or not and display aggregate message 
   if($res==TRUE)
   {
    $_SESSION['add']="Category added successfully";
    //redirect page to manage admin
    header('location:'.SITEURL.'admin/manage_category.php');
   }
   else{
    // redirect to add admin
    $_SESSION['add']="Failed to add category";
    header('location:'.SITEURL.'admin/add_category.php');
   }
}
?>

<?php
include("partials/footer.php");
?>