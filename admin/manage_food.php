<?php include("partials/menu.php")?>
    <!-- main section starts -->
    <div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1>
    <br><br>
    <!-- btn to add admin -->
    <a href="<?php echo SITEURL;?>admin/add_food.php" class="btn-primary">Add Food</a><br><br>
   <?php 
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['remove']))
    {
        echo $_SESSION['remove'];
        unset($_SESSION['remove']);
    }
        if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
   ?>
        <br><br>
    <table class="tbl-full">
<tr>
    <th>S.no</th>
    <th>Title</th>
    <th>Price</th>
    <th>Image</th>
    <th>Featured</th>
    <th>Active</th>
    <th>Action</th>
</tr>
<?php
//get all categories from sql
$sql="SELECT * from dbl_food";
$res=mysqli_query($conn,$sql);
//count rows
$count=mysqli_num_rows($res);


if($count>0)
{
    $sn=1;
while($row=mysqli_fetch_assoc($res))
{
    
    $id=$row['id'];
    $image_name=$row['img_name'];
    $price=$row['price'];
    $featured=$row['featured'];
    $active=$row['active'];
    $title=$row['title'];
    ?>
<tr>
    <td><?php echo $sn++?></td>
    <td><?php echo $title?></td>
    <td><?php echo $price?></td>
    <td>
        <?php 
    if($image_name!="")
    {
        ?>
        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" width="90px">
        <?php
    }
    else{
        echo "<div>Image not added</div>";
    }
    
    ?></td>

    <td><?php echo $featured?></td>
    <td><?php echo $active?></td>
    <td><a href="" class="btn-secondary">Update Food</a>
        <a href="<?php echo SITEURL;?>admin/delete_food.php?id=<?php echo $id;?>& image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
    </td>
</tr>
    <?php
}
}
else{
    
    ?>
    <tr>
        <td colspan="6"><div class="error">No Food added. </div></td>
    </tr>
    <?php
}
?>

    </table>
</div>
    </div>
    
    <!-- main section ends -->
   <?php include("partials/footer.php")?>