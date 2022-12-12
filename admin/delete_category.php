<?php
include("../config/constants.php");
if(isset($_GET['id'])AND isset($_GET['image_name']))
{
 $id=$_GET['id'];
 $image_name=$_GET['image_name'];

 if($image_name!="")
 {
    $path="../images/category/".$image_name;
    $remove=unlink($path);

    if($remove==false)
    {
        $_SESSION['remove']="Failed to remove category image";
        header('location:'.SITEURL.'admin/manage_category.php');
        die();
    }
 }

 $sql="DELETE from dbl_category where id=$id";
 $res=mysqli_query($conn,$sql);
 if($res==TRUE)
 {
     // echo "query executed successfully";
     // create session variable to display message
     $_SESSION['delete']="<div class='success'>Category deleted succesfully</div>";// div css not working 
     header('location:'.SITEURL.'admin/manage_category.php');
 }
 else{
     $_SESSION['delete']="<div class='error'>Failed to delete category</div>";
     header('location:'.SITEURL.'admin/manage_category.php');
 }

}
else{
    header('location:'.SITEURL.'admin/manage_category.php');
}
?>