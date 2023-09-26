<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
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
                    <td>Featured Text: </td>
                    <td> 
                        <input type="text" name="text" size="60" placeholder="Text to appear when featured">
                    </td>
                </tr>
                <tr>
                    <td>Discount Percent:</td>
                    <td> 
                        <input type="text" name="discount" size="60" placeholder="Decimal between 0 and 1">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Promotion" class="btn-secondary">
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
    
    $category = $_POST['type'];
    $text = $_POST['text'];
    $discount = $_POST['discount'];

    $sql = "INSERT INTO `promotions` (`id`, `category`, `promo_text`, `percent_off`, `featured`) VALUES (NULL, '$category', '$text', '$discount', '0')";
    $res = mysqli_query($conn, $sql);

    $sql = "UPDATE `products` SET `Price` = Price*(1-$discount) WHERE `products`.`Description` = '$category';";
    $res = mysqli_query($conn, $sql);

    if ($res = TRUE)
    {
        echo "Data Inserted";
        header("location:".SITEURL.'admin/manage-promos.php');
    }
    else{
        echo "Failed to Insert Data";
        header("location:".SITEURL.'admin/manage-promos.php');
    }

}
?>