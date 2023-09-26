<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Product</h1>
            <br><br>
        
            <?php 
                $id=$_GET['id'];

                $sql="SELECT * FROM products WHERE id = $id";

                $res=mysqli_query($conn, $sql);

                if ($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if ($count>=1)
                    {
                        $row=mysqli_fetch_assoc($res);

                        $id = $row['ID'];
                        $prod_name=$row['Name'];
                        $prod_descr=$row['Description'];
                        $image=$row['imageFile'];
                        $price = $row['Price'];
                        $sold = $row['sold'];
                    }
                    else{
                        header('location:'.SITEURL.'admin/manage-products.php');
                    }
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>New Name: </td>
                        <td> 
                            <input type="text" name="Name" value="<?php echo $prod_name?>">
                        </td>
                    </tr>

                    <tr>
                        <td>New Category: </td>
                        <td> 
                            <?php
                                $sql="SELECT * FROM prod_types";
                                $res=mysqli_query($conn, $sql);
                                if ($res==true)
                                    {
                                        $count = mysqli_num_rows($res);
                                        if ($count>=1){
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $tid = $rows['id'];
                                                $type = $rows['type'];
                                                if($type == $prod_descr){
                                                    echo '<input type="radio" id="'.$tid.'" name="type" checked="checked" value="'.$type.'"><label for="'.$type.'">'.$type.'</label><br>';
                                                }
                                                else{
                                                    echo '<input type="radio" id="'.$tid.'" name="type" value="'.$type.'"><label for="'.$type.'">'.$type.'</label><br>';
                                                }
                                            }
                                        }
                                    }

                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image File: </td>
                        <td> 
                            <input type="file" name="image" accept="image/png, image/jpeg">
                        </td>
                        <td width = 50%>
                            (Leave blank to keep image)
                        </td>
                    </tr>
                    <tr>
                        <td>New Price: </td>
                        <td> 
                            <input type="text" name="price" value="<?php echo $price?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Sold: </td>
                        <td> 
                            <input type="checkbox" name="sold" <?php if($sold == 1){
                                echo 'checked = "checked"';
                            } ?>>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Save" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>    
    </div>
    
<?php

if(isset($_POST['submit']))
{
    
    $Name = $_POST['Name'];
    $desc = $_POST['type'];
    if ($desc == null) {
        $desc = 'Misc';
    }
    if(isset($_POST['sold'])){
        $sold = '1';
    }
    else{
        $sold = '0';
    }
    
    $price = $_POST['price'];
    $image_name = $image;

    if(isset($_FILES['image']['name']))
    {
        //upload the image
        $image_name = $_FILES['image']['name'];
        $source = $_FILES['image']['tmp_name'];
        $destination = "../images/".$image_name;
        
        //Upload the image
        $upload = move_uploaded_file($source, $destination);

        //check to see if the image is uploaded or not, and if it is not then we will stop the procces and redirect to error.
    }
    else
    {
        //don't upload anything and set the image_name cvalue as blank
        $image_name = $image;
    }
    
    if($image_name == ""){
        $sql = "UPDATE products SET Name = '$Name', sold = '$sold', Description = '$desc', price = '$price' WHERE ID = $id;";
    }
    else{
        $sql = "UPDATE products SET Name = '$Name', sold = '$sold', Description = '$desc', imageFile = '$image_name', price = '$price' WHERE ID = $id;";
    }
    
    
    $res = mysqli_query($conn, $sql);

    if ($res = TRUE)
    {
        header("location:".SITEURL.'admin/manage-products.php');
    }
    else{
        echo "Failed to Insert Data";
    }

}
?>
<section class="footer-bottom">
<?php include('partials/footer.php'); ?>
</section>
