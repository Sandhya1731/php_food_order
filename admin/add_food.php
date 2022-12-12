<?php
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
       
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action ="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of food"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" cols="30" rows="10" placeholder="description"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
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
                    <td>
                        Category :
                    </td>
                    <td>
                        <select name="category">
                            //php code to display category from database
                           
                            <?php
                             $sql="SELECT* from dbl_category where active='Yes'";
                             $res=mysqli_query($conn,$sql);
                             $count=mysqli_num_rows($res);
                             if($count>0)
                             {
                                   while($row=mysqli_fetch_assoc($res))
                                   {
                                    $id=$row['id'];
                                    $title=$row['title'];
                                   
                                   ?>
                                   <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                   <?php
                             }
                            }
                             else{
                                     ?>
                                     <option value="0">No category food</option>
                                     <?php
                             }
                            ?>
                            
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
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
    if(isset($_FILES['image']['name']))
    {
        //upload image
        //image name ,src path ,dest path 
        $image_name=$_FILES['image']['name'];

        //auto rename the image
        //get extensions of our image 
        if($image_name!=""){
        $image_info=explode(".",$image_name);
        $ext1=end($image_info);
        //rename the image name
        $image_name="Food_Name".rand(00000,99999).".".$ext1;
        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/food/".$image_name;

        //upload image
        $upload=move_uploaded_file($source_path,$destination_path);
        //chk if image uploaded or not
        if($upload==FALSE)
        {
            $_SESSION['upload']="Failed to upload image";
            header('location:'.SITEURL.'admin/add_food.php');
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
    $sql2="INSERT INTO dbl_food SET
  title='$title',
  description='$description',
  price=$price,
  img_name='$image_name',
  category_id='$category',
  featured='$featured',
    active='$active'
    ";
// executing query ans saving data in database
    $res2=mysqli_query($conn,$sql2)or die(mysqli_error());
    // chk whether query executed or not and display aggregate message 
   if($res2==TRUE)
   {
    $_SESSION['add']="Food added successfully";
    //redirect page to manage admin
    header('location:'.SITEURL.'admin/manage_food.php');
    
   }
   else{
    //redirect to add admin
    $_SESSION['add']="Failed to add food";
    header('location:'.SITEURL.'admin/add_food.php');
    
   }
}
?>