<?php include("partials_main/menu.php");?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
  
            <?php 
            // query to display category from database
            $sql="SELECT * from dbl_category where active='Yes' AND featured='Yes'";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                    while($row=mysqli_fetch_assoc($res))
                    {

                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['img_name'];
                        ?>
                       <a href="category-foods.php">
                      <div class="box-3 float-container">
                        <?php
                        if($image_name=="")
                        {
                            echo "Image not available ";
                        }
                        else{
                            ?>
                     <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Image" class="img-responsive img-curve">
                      <?php
                        }
?>

                     <h3 class="float-text text-white"><?php echo $title;?></h3>
                      </div>
                      </a>
                        <?php
                    }
            }
            else{

                echo "Category not added ";
            }
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include("partials_main/footer.php");?>