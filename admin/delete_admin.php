<?php
include("../config/constants.php");
// get id of admin to be deleted 
echo $id= $_GET['id'];
// create sql query to delete
$sql= "delete from dbl_admin where id=$id";
// execute the query 
$res= mysqli_query($conn,$sql);
// chk whether query executed
if($res==TRUE)
{
    // echo "query executed successfully";
    // create session variable to display message
    $_SESSION['delete']="<div class='success'>Admin deleted succesfully</div>";// div css not working 
    header('location:'.SITEURL.'admin/manage_admin.php');
}
else{
    $_SESSION['delete']="<div class='error'>Failed to delete admin</div>";
    header('location:'.SITEURL.'admin/manage_admin.php');
}

?>