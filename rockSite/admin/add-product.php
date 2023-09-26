<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Rock Name: </td>
                    <td> 
                        <input type="text" name="Name" placeholder="Name">
                    </td>
                </tr>
                <tr>
                        <td>Category: </td>
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
                                                if ($type == "Misc") {
                                                    echo '<input type="radio" id="'.$tid.'" name="type" checked="checked" value="'.$type.'"><label for="'.$type.'">'.$type.'</label><br>';
                                                } else {
                                                    echo '<input type="radio" id="'.$tid.'" name="type" value="'.$type.'"><label for="'.$type.'">'.$type.'</label><br>';
                                                }
                                            }
                                        }
                                    }

                            ?>
                        </td>
                    </tr>
                <tr>
                    <td>Image File: </td>
                    <td> 
                        <input type="file" name="image" accept="image/png, image/jpeg">
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td> 
                        <input type="text" name="price" placeholder="Price">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<section class="footer-bottom">
<?php include('partials/footer.php'); ?>
</section>
<?php

if(isset($_POST['submit']))
{
    $Name = $_POST['Name'];
    $description = $_POST['type'];
    if ($description == null) {
        $description = 'Misc';
    }
    $image = $_POST['image'];
    $price = $_POST['price'];

    if(isset($_FILES['image']['name']))
        {
            //upload the image
            $image_name = $_FILES['image']['name'];
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/".$image_name;
            
            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check to see if the image is uploaded or not, and if it is not then we will stop the procces and redirect to error.
            if($upload == false)
            {
                die();
            }
            
        }
        else
        {
            //don't upload anything and set the image_name cvalue as blank
            $image_name = "";
        }

    $sql = "INSERT INTO `products` (`ID`, `Name`, `Description`, `imageFile`, `Price`) VALUES (NULL, '$Name', '$description', '$image_name', '$price')";

    $res = mysqli_query($conn, $sql) or die();

    if ($res = TRUE)
    {
        echo "Data Inserted";

        $sql = "SELECT * FROM maillist";
        $res = mysqli_query($conn, $sql);
        if ($res==TRUE)
        {
            //emails to mailing list
            /*$content = '<html><p>New '.$description. 's have been posted, check it out at </p><a href="'.SITEURL.'/rockSite/php/home.php"></a></html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
            $count = mysqli_num_rows($res);
            if ($count>0)
            {
                while($rows=mysqli_fetch_assoc($res))
                {
                    $email = $rows['email'];
                    mail($email,"New Products Available",$content,$headers);
                }
            }*/
        }
        header("location:".SITEURL.'admin/manage-products.php');
    }
    else{
        echo "Failed to Insert Data";
        header("location:".SITEURL.'admin/manage-products.php');
    }

}
?>